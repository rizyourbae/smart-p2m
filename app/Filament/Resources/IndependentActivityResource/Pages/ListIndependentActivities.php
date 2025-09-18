<?php

namespace App\Filament\Resources\IndependentActivityResource\Pages;

use App\Filament\Resources\IndependentActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;
use App\Exports\IndependentActivitiesExport; // <-- Import Export Class kita
use Maatwebsite\Excel\Facades\Excel;       // <-- Import Facade Excel

class ListIndependentActivities extends ListRecords
{
    protected static string $resource = IndependentActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Data')
                ->icon('heroicon-o-document-plus'),

            // TAMBAHKAN AKSI EKSPOR DI SINI
            Actions\Action::make('export')
                ->label('Ekspor')
                ->icon('bi-file-earmark-spreadsheet')
                ->color('success')
                ->action(function () {
                    // Panggil fungsi download dengan Export Class yang baru
                    return Excel::download(new IndependentActivitiesExport, 'kegiatan-mandiri-dosen.xlsx');
                }),
        ];
    }
    protected static ?string $title = 'Daftar Kegiatan Mandiri';
}
