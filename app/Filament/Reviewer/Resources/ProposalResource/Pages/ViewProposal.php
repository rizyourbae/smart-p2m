<?php

namespace App\Filament\Reviewer\Resources\ProposalResource\Pages;

use App\Filament\Reviewer\Resources\ProposalResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProposal extends ViewRecord
{
    protected static string $resource = ProposalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
