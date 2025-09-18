<?php

namespace App\Filament\User\Resources\InformationResource\Pages;

use App\Filament\User\Resources\InformationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInformation extends ListRecords
{
    protected static string $resource = InformationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
