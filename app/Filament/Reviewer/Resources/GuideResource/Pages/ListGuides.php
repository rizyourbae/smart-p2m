<?php

namespace App\Filament\Reviewer\Resources\GuideResource\Pages;

use App\Filament\Reviewer\Resources\GuideResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGuides extends ListRecords
{
    protected static string $resource = GuideResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
