<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ProposalResource;
use App\Models\Proposal;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;

class ProposalsNeedingAction extends BaseWidget
{
    // Judul yang akan tampil di atas tabel widget
    protected static ?string $heading = 'Proposal Perlu Tindakan Segera';

    // Atur urutan, angka lebih besar akan tampil di bawah
    protected static ?int $sort = 2;

    // Atur agar widget memakan lebar penuh
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            // [KUNCI #1] Query untuk mengambil data
            ->query(
                Proposal::query()
                    // Hanya ambil proposal yang butuh tindakan Admin
                    ->whereIn('status', ['diajukan', 'menunggu_keputusan'])
                    // Urutkan dari yang paling baru
                    ->latest()
            )
            ->columns([
                TextColumn::make('judul_usulan')
                    ->label('Judul Usulan')
                    ->limit(50)
                    ->wrap(),

                TextColumn::make('lecturer.nama')
                    ->label('Pengusul'),

                // Gunakan logika status yang sama seperti di tabel utama agar konsisten
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'diajukan' => 'gray',
                        'dalam_penilaian' => 'warning',
                        'menunggu_keputusan' => 'info',
                        'revisi' => 'warning',
                        'diterima' => 'success',
                        'ditolak' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => ucwords(str_replace('_', ' ', $state))),

                TextColumn::make('created_at')
                    ->label('Diajukan pada')
                    ->since() // Tampilkan format "x days ago" agar lebih dinamis
                    ->sortable(),
            ])
            // [KUNCI #2] Tombol aksi untuk setiap baris
            ->actions([
                Action::make('view_details')
                    ->label('Lihat Detail')
                    ->icon('heroicon-o-arrow-right-circle')
                    // Arahkan ke halaman edit proposal
                    ->url(fn(Proposal $record): string => ProposalResource::getUrl('edit', ['record' => $record])),
            ])
            // Sembunyikan header dan fitur paginasi agar lebih ringkas
            ->striped()
            ->paginated(false)
            ->defaultSort('created_at', 'desc');
    }
}
