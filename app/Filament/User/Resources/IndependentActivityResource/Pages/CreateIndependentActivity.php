<?php

namespace App\Filament\User\Resources\IndependentActivityResource\Pages;

use App\Filament\User\Resources\IndependentActivityResource;
use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateIndependentActivity extends CreateRecord
{
    protected static string $resource = IndependentActivityResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['lecturer_id'] = Auth::user()->lecturer->id ?? null;
        return $data;
    }
    protected static ?string $title = 'Tambah Kegiatan Mandiri';
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
