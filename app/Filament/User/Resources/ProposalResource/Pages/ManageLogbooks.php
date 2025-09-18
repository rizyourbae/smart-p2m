<?php

namespace App\Filament\User\Resources\ProposalResource\Pages;

use App\Filament\User\Resources\ProposalResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Form;

class ManageLogbooks extends EditRecord
{
    protected static string $resource = ProposalResource::class;
    protected static ?string $title = 'Kelola Logbook';

    // Kosongkan form utama supaya yang tampil hanya Relation Manager
    public function form(Form $form): Form
    {
        return $form->schema([]);
    }

    // Hilangkan tombol aksi form (Save/Cancel) biar tidak membingungkan
    protected function getFormActions(): array
    {
        return [];
    }

    // Tampilkan hanya Relation Manager Logbook di halaman ini
    public function getRelationManagers(): array
    {
        return [
            \App\Filament\User\Resources\ProposalResource\RelationManagers\LogbooksRelationManager::class,
        ];
    }

    // (Opsional) selesai dari sini kembalikan ke halaman detail
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('view', ['record' => $this->record]);
    }
}
