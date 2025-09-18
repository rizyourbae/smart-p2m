<?php

namespace App\Filament\Reviewer\Resources\ReviewerRequiredDocumentResource\Pages;

use App\Filament\Reviewer\Resources\ReviewerRequiredDocumentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditReviewerRequiredDocument extends EditRecord
{
    protected static string $resource = ReviewerRequiredDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected static ?string $title = 'Ubah Dokumen';
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Sukses')
            ->body('Berhasil Merubah Data Berita');
    }
}
