<?php

namespace App\Filament\Resources\PublicationResource\Pages;

use App\Filament\Resources\PublicationResource;
use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Exports\PublicationsExport; // <-- Import Export Class kita
use Maatwebsite\Excel\Facades\Excel; // <-- Import Facade Excel

class ListPublications extends ListRecords
{
    protected static string $resource = PublicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Data')
                ->icon('heroicon-o-document-plus'),

            // TAMBAHKAN AKSI EKSPOR MANUAL DI SINI
            Actions\Action::make('export')
                ->label('Ekspor')
                ->icon('bi-file-earmark-spreadsheet')
                ->color('success')
                ->action(function () {
                    // Panggil fungsi download dari maatwebsite/excel
                    return Excel::download(new PublicationsExport, 'publikasi-dosen.xlsx');
                }),
        ];
    }
}
