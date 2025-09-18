<?php

namespace App\Filament\User\Resources\ProposalResource\Pages;

use App\Filament\User\Resources\ProposalResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Exception;

class CreateProposal extends CreateRecord
{
    protected static string $resource = ProposalResource::class;
    protected static ?string $title = 'Ajukan Proposal Baru';
    public function getSubheading(): ?string
    {
        return 'Mohon lengkapi isian berikut untuk ajuan proposal';
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
            ->body('Berhasil Menambahkan Data');
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $lecturerId = Auth::user()->lecturer->id ?? null;
        if (! $lecturerId) {
            throw new Exception('Profil dosen (Lecturer) belum ada. Lengkapi dulu sebelum mengajukan.');
        }

        $data['lecturer_id'] = $lecturerId;
        $data['status'] = 'diajukan';

        return $data;
    }

}
