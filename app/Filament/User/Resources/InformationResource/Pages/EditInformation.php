<?php

namespace App\Filament\User\Resources\InformationResource\Pages;

use App\Filament\User\Resources\InformationResource;
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
