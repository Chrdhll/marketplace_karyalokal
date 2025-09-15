<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Infolists\Components\TextEntry;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Detail Pesanan')->schema([
                    Grid::make(2)->schema([
                        TextEntry::make('id')->label('ID Pesanan'),
                        TextEntry::make('status')
                            ->badge() // <-- Tampilkan sebagai badge
                            ->color(fn(string $state): string => match ($state) {
                                'pending' => 'gray',
                                'paid' => 'primary',
                                'in_progress' => 'warning',
                                'completed' => 'success',
                                'cancelled' => 'danger',
                                'dispute' => 'danger',
                            }),
                        TextEntry::make('gig.title')->label('Jasa'),
                        TextEntry::make('total_price')
                            ->label('Harga')
                            ->money('IDR'),
                        TextEntry::make('client.name')->label('Nama Klien'),
                        TextEntry::make('freelancer.name')->label('Nama Freelancer'),
                        TextEntry::make('created_at')->label('Dipesan Pada')->dateTime(),
                        TextEntry::make('midtrans_transaction_id')->label('ID Transaksi Midtrans'),
                    ]),
                ]),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Pesanan')->schema([
                    Grid::make(2)->schema([
                        TextInput::make('id')
                            ->label('ID Pesanan')
                            ->disabled(),

                        // INI FIELD YANG BISA DI-EDIT OLEH ADMIN
                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'paid' => 'Paid',
                                'in_progress' => 'In Progress',
                                'completed' => 'Completed',
                                'cancelled' => 'Cancelled',
                                'dispute' => 'Dispute',
                            ])
                            ->required(),

                        TextInput::make('gig.title')
                            ->label('Jasa')
                            ->disabled()
                            ->afterStateHydrated(fn($record, $component) => $component->state($record->gig?->title)),

                        TextInput::make('total_price')
                            ->label('Harga')
                            ->prefix('Rp')
                            ->disabled(),

                        TextInput::make('client_name')
                            ->label('Nama Klien')
                            ->disabled()
                            ->afterStateHydrated(fn($record, $component) => $component->state($record->client?->name)),

                        TextInput::make('freelancer_name')
                            ->label('Nama Freelancer')
                            ->disabled()
                            ->afterStateHydrated(fn($record, $component) => $component->state($record->freelancer?->name)),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->label('ID Pesanan'),
                TextColumn::make('gig.title')->searchable()->label('Jasa'),
                TextColumn::make('client.name')->searchable()->label('Klien'),
                TextColumn::make('freelancer.name')->searchable()->label('Freelancer'),
                TextColumn::make('total_price')
                    ->sortable()
                    ->label('Harga')
                    ->money('IDR'),
                BadgeColumn::make('status')
                    ->colors([
                        'secondary' => 'pending',
                        'primary' => 'paid',
                        'warning' => 'in_progress',
                        'success' => 'completed',
                        'danger' => 'cancelled',
                        'danger' => 'dispute',
                    ]),
                TextColumn::make('created_at')->dateTime('d M Y')->sortable()->label('Tanggal Pesan'),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'in_progress' => 'In Progress',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                        'dispute' => 'Dispute',
                    ])
            ])

            ->actions([
                Tables\Actions\ViewAction::make(),

                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
