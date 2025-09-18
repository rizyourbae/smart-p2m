<?php

namespace App\Filament\User\Resources\PublicationResource\Pages;

use App\Filament\User\Resources\PublicationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class CreatePublication extends CreateRecord
{
    protected static string $resource = PublicationResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['lecturer_id'] = Auth::user()->lecturer->id ?? null;
        return $data;
    }
    protected static ?string $title = 'Tambah Data Publikasi';
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Sukses')
            ->body('Berhasil Menambahkan Data');
    }
}
