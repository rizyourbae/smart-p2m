<?php

namespace App\Filament\User\Resources\IndependentActivityResource\Pages;

use App\Filament\User\Resources\IndependentActivityResource;
use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab; // <-- 1. Import class Tab
use Illuminate\Database\Eloquent\Builder; // <-- 2. Import class Builder
use Illuminate\Support\Facades\Auth; // <-- 3. Import Auth

class ListIndependentActivities extends ListRecords
{
    protected static string $resource = IndependentActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->label('Tambah')
            ->icon('heroicon-o-document-plus'),
        ];
    }
    protected static ?string $title = 'Daftar Kegiatan Mandiri';
    public function getSubheading(): ?string
    {
        return 'Silahkan kelola data kegiatan yang dilakukan secara mandiri maupun non-BOPTN';
    }

    public function getTabs(): array
    {
        // Ambil ID dosen yang sedang login
        $lecturerId = Auth::user()?->lecturer?->id;

        return [
            'Semua' => Tab::make(), // Tab untuk menampilkan semua data

            'Penelitian' => Tab::make()
                // Menambahkan query 'where' untuk memfilter hanya jenis 'Penelitian'
                ->modifyQueryUsing(fn (Builder $query) => $query->where('jenis', 'Penelitian'))
                // Menambahkan badge dengan jumlah record yang sesuai
                ->badge(
                    // Pastikan query untuk badge juga difilter berdasarkan dosen
                    static::getModel()::query()
                        ->where('lecturer_id', $lecturerId)
                        ->where('jenis', 'Penelitian')
                        ->count()
                )
                ->badgeColor('info'),

            'Pengabdian' => Tab::make()
                // Menambahkan query 'where' untuk memfilter hanya jenis 'Pengabdian'
                ->modifyQueryUsing(fn (Builder $query) => $query->where('jenis', 'Pengabdian'))
                // Menambahkan badge dengan jumlah record yang sesuai
                ->badge(
                    static::getModel()::query()
                        ->where('lecturer_id', $lecturerId)
                        ->where('jenis', 'Pengabdian')
                        ->count()
                )
                ->badgeColor('primary'),
        ];
    }
}
