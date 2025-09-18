<?php

namespace App\Filament\Reviewer\Resources\ReviewerEducationalHistoryResource\Pages;

use App\Filament\Reviewer\Resources\ReviewerEducationalHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditReviewerEducationalHistory extends EditRecord
{
    protected static string $resource = ReviewerEducationalHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected static ?string $title = 'Ubah Riwayat Pendidikan';
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Sukses')
            ->body('Berhasil Merubah Data');
    }
}
