<?php

namespace App\Filament\Reviewer\Resources\GuideResource\Pages;

use App\Filament\Reviewer\Resources\GuideResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGuide extends EditRecord
{
    protected static string $resource = GuideResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
