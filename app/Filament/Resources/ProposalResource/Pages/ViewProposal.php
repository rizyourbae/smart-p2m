<?php

namespace App\Filament\Resources\ProposalResource\Pages;

use App\Filament\Resources\ProposalResource;
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

}
