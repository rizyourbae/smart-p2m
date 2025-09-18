<?php

namespace App\Filament\User\Resources\RequiredDocumentResource\Pages;

use App\Filament\User\Resources\RequiredDocumentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRequiredDocuments extends ListRecords
{
    protected static string $resource = RequiredDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->icon('heroicon-o-document-plus')
            ->label('Tambah'),
        ];
    }
        public function getSubheading(): ?string
    {
        return 'Silahkan lengkapi dokumen anda';
    }
}
