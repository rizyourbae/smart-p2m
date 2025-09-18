<?php

namespace App\Filament\Reviewer\Resources\InformationResource\Pages;

use App\Filament\Reviewer\Resources\InformationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInformation extends EditRecord
{
    protected static string $resource = InformationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
