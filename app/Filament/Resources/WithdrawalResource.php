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
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section as InfolistSection;
use Filament\Infolists\Components\Grid as InfolistGrid;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;

class WithdrawalResource extends Resource
{
    protected static ?string $model = Withdrawal::class;
    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Penarikan Dana';

    public static function getNavigationBadge(): ?string
    {
        // Hitung jumlah permintaan penarikan yang statusnya 'pending'
        return static::getModel()::where('status', 'pending')->count();
    }
    // Kita buat form ini read-only, karena admin hanya perlu mengubah status

    // app/Filament/Resources/WithdrawalResource.php

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistSection::make('Informasi Penarikan')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('user.name')->label('Freelancer'),
                        TextEntry::make('amount')->money('IDR')->label('Jumlah'),
                        TextEntry::make('created_at')->dateTime('d M Y, H:i')->label('Tanggal Diajukan'),
                        TextEntry::make('status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'pending' => 'warning',
                                'processed' => 'success',
                                'rejected' => 'danger',
                            }),
                    ]),

                InfolistSection::make('Rekening Bank Tujuan')
                    ->schema([
                    // Kita panggil view partial yang sudah kita buat
                    ViewEntry::make('bank_account')
                            ->label('')
                            ->view('filament.partials.bank-account-info')
                            ->viewData([
                                'bankAccounts' => $infolist->getRecord()->user->bankAccounts
                            ]),
                ]),

                InfolistSection::make('Catatan Admin')
                    ->schema([
                    TextEntry::make('admin_notes')->label('')->placeholder('Tidak ada catatan.'),
                ]),
            ]);
    }
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
            ->defaultSort('created_at', 'desc')
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
                Tables\Actions\ViewAction::make(),
                // Tombol "Lihat Rekening"
                Action::make('viewBankAccount')
                    ->label('Lihat Rekening')
                    ->icon('heroicon-o-credit-card')
                    ->color('secondary')
                    ->modalContent(
                        fn (Withdrawal $record): \Illuminate\View\View =>
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
