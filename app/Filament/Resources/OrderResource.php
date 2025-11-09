<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Order;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\OrderResource\Pages;
use Filament\Forms\Components\Grid as FormGrid;
use Filament\Forms\Components\Section as FormSection;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Grid as InfolistGrid;
use Filament\Infolists\Components\Section as InfolistSection;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;
use Barryvdh\DomPDF\Facade\Pdf;
use ZipArchive;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function getNavigationBadge(): ?string
    {
        // Hitung jumlah order yang statusnya 'pending' DAN sudah ada bukti bayar
        return static::getModel()::where('status', 'pending')
                                 ->whereNotNull('proof_of_payment')
                                 ->count();
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                InfolistSection::make('Detail Pesanan')->schema([
                    InfolistGrid::make(2)->schema([
                        TextEntry::make('id')->label('ID Pesanan'),
                        ImageEntry::make('proof_of_payment')
                        ->label('Bukti Pembayaran')
                        ->disk('public')
                        ->columnSpanFull(),
                        TextEntry::make('status')
                            ->badge() // <-- Tampilkan sebagai badge
                            ->color(fn (string $state): string => match ($state) {
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
                    ]),
                ]),
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                FormSection::make('Informasi Pesanan')->schema([
                   FormGrid::make(3)->schema([
                // ==========================================
                // KOLOM KIRI (UTAMA): BUKTI PEMBAYARAN
                // ==========================================
                FormSection::make('Bukti Pembayaran Klien')
                    ->columnSpan(2)
                    ->schema([
                        FileUpload::make('proof_of_payment')
                            ->label('') // Kosongkan label agar gambar terlihat penuh
                            ->disk('public')
                            ->disabled() // Admin hanya bisa melihat, tidak bisa mengubah
                            ->columnSpanFull(),
                    ]),

                // ==========================================
                // KOLOM KANAN (SIDEBAR): AKSI ADMIN
                // ==========================================
                FormSection::make('Aksi Admin (Verifikasi)')
                    ->columnSpan(1)
                    ->schema([
                        // INI YANG DITONJOLKAN
                        Select::make('status')
                            ->label('Ubah Status Pesanan')
                            ->options([
                                'pending' => 'Pending (Menunggu Bukti)',
                                'paid' => 'Paid (Pembayaran Diterima)',
                                'in_progress' => 'In Progress (Dikerjakan)',
                                'completed' => 'Completed (Selesai)',
                                'cancelled' => 'Cancelled (Dibatalkan)',
                                'dispute' => 'Dispute (Masalah)',
                            ])
                            ->required(),

                        // Info tambahan untuk admin
                        TextInput::make('user_name')
                            ->label('Nama Klien')
                            ->disabled()
                            ->afterStateHydrated(fn ($record, $component) => $component->state($record->client?->name)),

                        TextInput::make('freelancer_name')
                            ->label('Nama Freelancer')
                            ->disabled()
                            ->afterStateHydrated(fn ($record, $component) => $component->state($record->freelancer?->name)),

                        TextInput::make('total_price')
                            ->label('Harga')
                            ->prefix('Rp')
                            ->numeric()
                            ->disabled(),
                    ]),
            ]),
        ]),
    ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
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
                        'gray' => 'pending',
                        'primary' => 'paid',
                        'warning' => 'in_progress',
                        'success' => 'completed',
                        'danger' => 'cancelled',
                        'danger' => 'dispute',
                    ]),
                ImageColumn::make('proof_of_payment')
            ->label('Bukti Bayar')
            ->disk('public')
            ->visibility('private'),
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

                Tables\Actions\EditAction::make()->label('Proses'),

                Action::make('downloadInvoice')
                ->label('Download Nota')
                ->icon('heroicon-o-document-arrow-down')
                ->color('gray')
                ->url(fn (Order $record): string => route('order.invoice', $record->uuid))
                ->openUrlInNewTab()
                ->visible(fn (Order $record): bool => !in_array($record->status, ['pending', 'cancelled'])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),

                BulkAction::make('downloadInvoices')
                    ->label('Download Nota Terpilih (ZIP)')
                    ->icon('heroicon-o-archive-box-arrow-down')
                    ->action(function (Collection $records) {

                        // 1. Buat nama file ZIP yang unik
                        $zipFileName = 'semua-nota-' . now()->format('Y-m-d-His') . '.zip';
                        $zipPath = storage_path('app/temp/' . $zipFileName); // Simpan sementara

                        // 2. Buat file ZIP baru
                        $zip = new ZipArchive();
                        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
                            throw new \Exception("Gagal membuat file ZIP di server.");
                        }

                        // 3. Loop setiap pesanan yang dicentang
                        foreach ($records as $order) {
                            // Lewati jika pesanan belum lunas
                            if (in_array($order->status, ['pending', 'cancelled'])) {
                                continue;
                            }

                            // 4. Muat data yang dibutuhkan untuk nota
                            $order->load('gig', 'client', 'freelancer');

                            // 5. Generate PDF-nya
                            $pdf = Pdf::loadView('pdf.invoice', compact('order'));
                            $pdfContent = $pdf->output(); // Ambil konten PDF sebagai string

                            // 6. Tambahkan PDF ke file ZIP
                            $invoiceName = 'Nota-' . $order->order_number . '.pdf';
                            $zip->addFromString($invoiceName, $pdfContent);
                        }

                        // 7. Selesaikan dan tutup file ZIP
                        $zip->close();

                        // 8. Kirim file ZIP sebagai download, lalu hapus otomatis
                        return response()->download($zipPath, $zipFileName)->deleteFileAfterSend(true);
                    })
                    ->deselectRecordsAfterCompletion(), // Hilangkan centang setelah selesai
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
