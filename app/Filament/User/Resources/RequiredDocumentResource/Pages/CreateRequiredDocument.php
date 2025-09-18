<?php

namespace App\Filament\User\Resources\RequiredDocumentResource\Pages;

use App\Filament\User\Resources\RequiredDocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class CreateRequiredDocument extends CreateRecord
{
    protected static string $resource = RequiredDocumentResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['lecturer_id'] = Auth::user()->lecturer->id ?? null;
        return $data;
    }
    protected static ?string $title = 'Tambah Dokumen';
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
