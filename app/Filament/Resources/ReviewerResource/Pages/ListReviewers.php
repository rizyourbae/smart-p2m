<?php

namespace App\Filament\Resources\ReviewerResource\Pages;

use App\Filament\Resources\ReviewerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReviewers extends ListRecords
{
    protected static string $resource = ReviewerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->label('Tambah')
            ->icon('heroicon-o-document-plus'),
        ];
    }
    protected static ?string $title = 'Daftar Reviewer';
}
