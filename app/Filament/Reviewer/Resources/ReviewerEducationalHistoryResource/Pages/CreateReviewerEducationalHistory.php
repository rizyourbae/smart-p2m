<?php

namespace App\Filament\Reviewer\Resources\ReviewerEducationalHistoryResource\Pages;

use App\Filament\Reviewer\Resources\ReviewerEducationalHistoryResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class CreateReviewerEducationalHistory extends CreateRecord
{
    protected static string $resource = ReviewerEducationalHistoryResource::class;
    protected static ?string $title = 'Tambah Riwayat Pendidikan';
    // --- [2] TAMBAHKAN METHOD INI ---
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
            ->body('Berhasil Menambahkan Riwayat Pendidikan');
    }
}
