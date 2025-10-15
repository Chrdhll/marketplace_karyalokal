<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WithdrawalResource\Pages;
use App\Models\Withdrawal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

// Import yang dibutuhkan
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\Action;

class WithdrawalResource extends Resource
{
    protected static ?string $model = Withdrawal::class;
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Penarikan Dana';

    // Kita buat form ini read-only, karena admin hanya perlu mengubah status
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_name') // Gunakan nama unik
                    ->label('Freelancer')
                    ->disabled()
                    ->afterStateHydrated(function ($component, $record) {
                        // Ambil record Withdrawal, masuk ke relasi user, lalu ambil namanya
                        $component->state($record->user?->name);
                    }),
                Forms\Components\TextInput::make('amount')
                    ->label('Jumlah')
                    ->prefix('Rp')
                    ->numeric()
                    ->disabled(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processed' => 'Processed',
                        'rejected' => 'Rejected',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('admin_notes')
                    ->label('Catatan Admin (Opsional)')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('user.name')->label('Freelancer')->searchable(),
                TextColumn::make('amount')->money('IDR')->sortable()->label('Jumlah'),
                BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'processed',
                        'danger' => 'rejected',
                    ]),
                TextColumn::make('created_at')->dateTime('d M Y')->label('Tanggal Diajukan'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processed' => 'Processed',
                        'rejected' => 'Rejected',
                    ])
            ])
            ->actions([
                // Tombol "Lihat Rekening"
                Action::make('viewBankAccount')
                    ->label('Lihat Rekening')
                    ->icon('heroicon-o-credit-card')
                    ->color('gray')
                    ->modalContent(fn (Withdrawal $record): \Illuminate\View\View => 
                        view('filament.partials.bank-account-info', ['bankAccounts' => $record->user->bankAccounts])
                    )
                    ->modalSubmitAction(false) // Tombol OK tidak perlu
                    ->modalCancelActionLabel('Tutup'),
                
                Tables\Actions\EditAction::make()->label('Proses'),
            ])
            ->bulkActions([]);
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
            'index' => Pages\ListWithdrawals::route('/'),
            'create' => Pages\CreateWithdrawal::route('/create'),
            'edit' => Pages\EditWithdrawal::route('/{record}/edit'),
        ];
    }
}