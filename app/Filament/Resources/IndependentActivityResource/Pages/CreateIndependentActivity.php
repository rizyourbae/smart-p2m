<?php

namespace App\Filament\Resources\IndependentActivityResource\Pages;

use App\Filament\Resources\IndependentActivityResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateIndependentActivity extends CreateRecord
{
    protected static string $resource = IndependentActivityResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Sukses')
            ->body('Berhasil Menambahkan Data Kegiatan Mandiri');
    }
    protected static ?string $title = 'Tambah Data Informasi';
}
