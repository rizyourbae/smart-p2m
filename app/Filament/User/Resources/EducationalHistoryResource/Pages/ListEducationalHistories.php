<?php

namespace App\Filament\User\Resources\EducationalHistoryResource\Pages;

use App\Filament\User\Resources\EducationalHistoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEducationalHistories extends ListRecords
{
    protected static string $resource = EducationalHistoryResource::class;
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
