<?php

namespace App\Filament\User\Resources\ProposalResource\Pages;

use App\Filament\User\Resources\ProposalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditProposal extends EditRecord
{
    protected static string $resource = ProposalResource::class;

    protected static ?string $title = 'Edit Proposal';

    public function getSubheading(): ?string
    {
        return 'Mohon perbarui isian berikut untuk proposal Anda';
    }

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
            ->body('Berhasil Merubah Data');
    }
}
