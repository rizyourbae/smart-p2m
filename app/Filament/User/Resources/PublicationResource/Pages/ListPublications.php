<?php

namespace App\Filament\User\Resources\PublicationResource\Pages;

use App\Filament\User\Resources\PublicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;
use Filament\Resources\Components\Tab; // <-- 1. Import class Tab
use Illuminate\Database\Eloquent\Builder; // <-- 2. Import class Builder
use Illuminate\Support\Facades\Auth; // <-- 3. Import Auth

class ListPublications extends ListRecords
{
    protected static string $resource = PublicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon('heroicon-o-document-plus')
                ->label('Tambah'),
        ];
    }
    protected static ?string $title = 'Daftar Publikasi Peneliti';
    public function getSubheading(): ?string
    {
        return 'Silahkan kelola data publikasi Anda di sini';
    }
    public function getTabs(): array
    {
        // Ambil ID dosen yang sedang login untuk akurasi penghitungan badge
        $lecturerId = Auth::user()?->lecturer?->id;

        return [
            'Semua' => Tab::make(), // Tab untuk menampilkan semua publikasi

            'Artikel' => Tab::make()
                // Filter query untuk menampilkan hanya jenis 'Artikel'
                ->modifyQueryUsing(fn(Builder $query) => $query->where('jenis', 'Artikel'))
                // Tambahkan badge dengan jumlah record yang sesuai
                ->badge(
                    // Pastikan query untuk badge juga difilter berdasarkan dosen
                    static::getModel()::query()
                        ->where('lecturer_id', $lecturerId)
                        ->where('jenis', 'Artikel')
                        ->count()
                )
                ->badgeColor('info'), // Warna badge disesuaikan dengan warna di tabel

            'Buku' => Tab::make()
                // Filter query untuk menampilkan hanya jenis 'Buku'
                ->modifyQueryUsing(fn(Builder $query) => $query->where('jenis', 'Buku'))
                // Tambahkan badge dengan jumlah record yang sesuai
                ->badge(
                    static::getModel()::query()
                        ->where('lecturer_id', $lecturerId)
                        ->where('jenis', 'Buku')
                        ->count()
                )
                ->badgeColor('success'), // Warna badge disesuaikan dengan warna di tabel
        ];
    }
}
