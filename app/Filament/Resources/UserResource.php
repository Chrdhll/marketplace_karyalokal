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
use Filament\Forms\Set;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Moderasi Freelancer';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where(function ($query) {
            $query->where('role', 'freelancer')
                ->orWhereHas('freelancerProfile');
        });
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::whereHas('freelancerProfile', function ($query) {
            $query->where('profile_status', 'pending');
        })->count();
    }

     public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(3)->schema([
                    // KOLOM KIRI: INFORMASI FREELANCER (READ-ONLY)
                    Section::make('Informasi Freelancer')
                        ->columnSpan(2)
                        ->schema([
                            TextInput::make('name')->disabled(),
                            TextInput::make('email')->disabled(),
                            Textarea::make('freelancerProfile.bio') // <-- Gunakan notasi titik
                            ->label('Bio')
                            ->disabled()
                            ->columnSpanFull(),

                            Placeholder::make('dokumen_link')
                                ->label('CV & Portofolio')
                                ->content(function (?User $record): HtmlString {
                                    if (!$record || !$record->freelancerProfile) return new HtmlString('');
                                    
                                    $cvLink = $record->freelancerProfile->cv_file_path 
                                        ? '<a href="' . Storage::url($record->freelancerProfile->cv_file_path) . '" target="_blank" class="text-primary-600 hover:underline">Lihat CV</a>' 
                                        : 'Tidak ada CV';
                                    
                                    $portfolioLink = $record->freelancerProfile->portfolio 
                                        ? '<a href="' . Storage::url($record->freelancerProfile->portfolio) . '" target="_blank" class="text-primary-600 hover:underline">Lihat Portofolio</a>' 
                                        : 'Tidak ada Portofolio';

                                    return new HtmlString($cvLink . ' | ' . $portfolioLink);
                                }),
                        ]),

                    // KOLOM KANAN: AKSI ADMIN
                    Section::make('Aksi Admin')
                        ->columnSpan(1)
                        ->schema([
                            Select::make('freelancerProfile.profile_status')
                                ->label('Status Profil')
                                ->options([
                                    'pending' => 'Pending',
                                    'approved' => 'Approved',
                                    'rejected' => 'Rejected',
                                ])
                                ->required(),

                            Select::make('role')
                                ->options(['client' => 'Client', 'freelancer' => 'Freelancer'])
                                ->required()
                                 ->disabled(),
                        ]),
                ]),
            ]);
    }

     public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                ImageColumn::make('profile_picture_path')->label('Foto')->circular(),
                TextColumn::make('name')
                    ->label('Nama')
                    ->description(fn(User $record): string => $record->freelancerProfile?->headline ?? '')
                    ->searchable(),
                TextColumn::make('email')->searchable(),
                TextColumn::make('role')->sortable(),
                BadgeColumn::make('freelancerProfile.profile_status')
                    ->label('Status Profil')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->sortable(),
            ])
            ->filters([
                // Filter berdasarkan status profil di relasi
                SelectFilter::make('freelancerProfile')
                    ->relationship('freelancerProfile', 'profile_status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->label('Status Profil'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
