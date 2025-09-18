<?php

namespace App\Filament\User\Resources\ProposalResource\Pages;

use App\Filament\User\Resources\ProposalResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Forms\Form;
use Filament\Actions;

class ViewProposal extends ViewRecord
{
    protected static string $resource = ProposalResource::class;

    protected static ?string $title = 'Detail Usulan';

    public function getSubheading(): ?string
    {
        return 'Berikut adalah informasi terkait usulan tersebut :';
    }

    // Eager load biar Summary nggak N+1
    protected function getRecordQuery()
    {
        return parent::getRecordQuery()
            ->with(['lecturer', 'lecturers', 'students', 'ptus', 'documents', 'logbooks', 'outcomes']);
    }
    protected function getHeaderActions(): array
    {
        $record = $this->record; // current proposal

        return [
            Actions\ActionGroup::make([
                Actions\Action::make('kelolaLogbook')
                    ->label('Logbook')
                    ->icon('heroicon-m-book-open')
                    ->url(fn() => ProposalResource::getUrl('manageLogbooks', ['record' => $record])),
                // opsional: kalau kamu punya halaman penuh Outputs
                Actions\Action::make('kelolaOutputs')
                    ->label('Outputs')
                    ->icon('heroicon-m-queue-list')
                    ->url(fn() => ProposalResource::getUrl('manageOutputs', ['record' => $record])),
                Actions\Action::make('kelolaReports')
                    ->label('Laporan & Keuangan')
                    ->icon('heroicon-m-document-currency-dollar')
                    ->url(fn() => ProposalResource::getUrl('manageReports', ['record' => $record])),
                Actions\Action::make('kelolaOutcomes')
                    ->label('Outcomes')
                    ->icon('heroicon-m-document')
                    ->url(fn() => ProposalResource::getUrl('manageOutcomes', ['record' => $record])),
            ])
                ->label('Kelola Proposal')
                ->icon('heroicon-m-list-bullet')
                ->color('info')
                ->button(),
        ];
    }
}
