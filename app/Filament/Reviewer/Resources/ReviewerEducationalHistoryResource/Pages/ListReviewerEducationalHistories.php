<?php

namespace App\Filament\Reviewer\Resources\ReviewerEducationalHistoryResource\Pages;

use App\Filament\Reviewer\Resources\ReviewerEducationalHistoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReviewerEducationalHistories extends ListRecords
{
    protected static string $resource = ReviewerEducationalHistoryResource::class;

    protected static ?string $title = 'Daftar Riwayat Pendidikan';
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
        return 'Silakan kelola riwayat pendidikan anda.';
    }
}
