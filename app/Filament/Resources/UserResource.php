<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('role', 'freelancer');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('role', 'freelancer')
            ->where('profile_status', 'pending')
            ->count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn($state) => Hash::make($state))
                    ->dehydrated(fn($state) => filled($state))
                    ->required(fn(string $context): bool => $context === 'create')
                    ->visibleOn('create'),
                Forms\Components\Select::make('role')
                    ->options([
                        'admin' => 'admin',
                        'client' => 'client',
                        'freelancer' => 'freelancer',
                    ])
                    ->required(),
                Forms\Components\FileUpload::make('profile_picture_path')
                    ->label('Foto Profil')
                    ->disk('public')
                    ->directory('profile-pictures')
                    ->image()
                    ->imageEditor()
                    ->default(null),
                Forms\Components\TextInput::make('headline')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Textarea::make('bio')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('portfolio')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('cv_file_path')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('location')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\TextInput::make('company_name')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Select::make('profile_status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Freelancer')
                    ->sortable()
                    ->description(fn($record) => $record->headline)
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role'),
                Tables\Columns\ImageColumn::make('profile_picture_path')
                    ->label('Foto')
                    ->disk('public')
                    ->visibility('public')
                    ->circular(),
                Tables\Columns\TextColumn::make('headline')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\BadgeColumn::make('profile_status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('profile_status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])

            ])
            ->actions([
                Tables\Actions\EditAction::make(),

                Action::make('Lihat Cv')
                    ->url(fn($record) => Storage::url($record->cv_file_path))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-document-text')
                    ->color('gray')
                    // Tombol hanya muncul jika user sudah upload CV
                    ->visible(fn($record) => $record->cv_file_path),

                Action::make('Lihat Portofolio')
                    ->url(fn($record) => Storage::url($record->portfolio))
                    ->openUrlInNewTab()
                    ->icon('heroicon-o-presentation-chart-line')
                    ->color('gray')
                    // Tombol hanya muncul jika user sudah upload portofolio
                    ->visible(fn($record) => $record->portfolio),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
