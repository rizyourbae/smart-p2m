<?php

namespace App\Filament\Resources\IndependentActivityResource\Pages;

use App\Filament\Resources\IndependentActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditIndependentActivity extends EditRecord
{
    protected static string $resource = IndependentActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Sukses')
            ->body('Berhasil Merubah Data Kegiatan Mandiri');
    }
    protected static ?string $title = 'Ubah Data Informasi';
}
