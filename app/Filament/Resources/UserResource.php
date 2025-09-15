<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\HtmlString;
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
                Grid::make(3)->schema([
                    // KOLOM KIRI (2/3 LEBAR): INFORMASI FREELANCER (READ-ONLY)
                    Section::make('Informasi Freelancer')
                        ->columnSpan(2)
                        ->schema([
                            TextInput::make('name')->disabled(),
                            TextInput::make('email')->disabled(),
                            Textarea::make('bio')->disabled()->columnSpanFull(),
                            Placeholder::make('cv')
                                ->label('CV & Portofolio')
                                ->content(function (?User $record): HtmlString {
                                    if ($record) {
                                        $cvLink = $record->cv_file_path ? '<a href="' . Storage::url($record->cv_file_path) . '" target="_blank" class="text-primary-600 hover:underline">Lihat CV</a>' : 'Tidak ada CV';
                                        $portfolioLink = $record->portfolio ? '<a href="' . Storage::url($record->portfolio) . '" target="_blank" class="text-primary-600 hover:underline">Lihat Portofolio</a>' : 'Tidak ada Portofolio';
                                        return new HtmlString($cvLink . ' | ' . $portfolioLink);
                                    }
                                    return new HtmlString('');
                                }),
                        ]),

                    // KOLOM KANAN (1/3 LEBAR): AKSI ADMIN
                    Section::make('Aksi Admin')
                        ->columnSpan(1)
                        ->schema([
                            Select::make('profile_status')
                                ->label('Status Profil')
                                ->options([
                                    'pending' => 'Pending',
                                    'approved' => 'Approved',
                                    'rejected' => 'Rejected',
                                ])
                                ->required(),

                            Select::make('role')
                                ->options([
                                    'client' => 'Client',
                                    'freelancer' => 'Freelancer',
                                ])
                                ->required()
                                ->disabled(fn(?User $record): bool => $record && $record->id === Auth::id()),

                            // Opsional: Tambahkan field untuk catatan admin
                            Textarea::make('admin_notes')
                                ->label('Catatan Admin (Internal)')
                                ->helperText('Catatan ini hanya bisa dilihat oleh admin lain.')
                        ]),
                ]),
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
