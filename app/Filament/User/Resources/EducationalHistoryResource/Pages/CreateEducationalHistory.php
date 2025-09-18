<?php

namespace App\Filament\User\Resources\EducationalHistoryResource\Pages;

use App\Filament\User\Resources\EducationalHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateEducationalHistory extends CreateRecord
{
    protected static string $resource = EducationalHistoryResource::class;
    protected static ?string $title = 'Tambah Riwayat Pendidikan';
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Sukses')
            ->body('Berhasil Menambahkan Riwayat Pendidikan');
    }
}
