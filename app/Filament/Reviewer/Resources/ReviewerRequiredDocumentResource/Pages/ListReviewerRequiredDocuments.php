<?php

namespace App\Filament\Reviewer\Resources\ReviewerRequiredDocumentResource\Pages;

use App\Filament\Reviewer\Resources\ReviewerRequiredDocumentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReviewerRequiredDocuments extends ListRecords
{
    protected static string $resource = ReviewerRequiredDocumentResource::class;
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
