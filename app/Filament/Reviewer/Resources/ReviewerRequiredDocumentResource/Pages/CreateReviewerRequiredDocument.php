<?php

namespace App\Filament\Reviewer\Resources\ReviewerRequiredDocumentResource\Pages;

use App\Filament\Reviewer\Resources\ReviewerRequiredDocumentResource;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\CreateRecord;

class CreateReviewerRequiredDocument extends CreateRecord
{
    protected static string $resource = ReviewerRequiredDocumentResource::class;
    protected static ?string $title = 'Tambah Dokumen';
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Ambil ID reviewer yang sedang login
        $reviewerId = Auth::guard('reviewer')->id();

        // Tambahkan ID tersebut ke dalam data form
        $data['reviewer_id'] = $reviewerId;

        return $data;
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Sukses')
            ->body('Berhasil Menambahkan Dokumen Pendukung');
    }
}
