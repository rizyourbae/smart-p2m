<?php

namespace App\Filament\User\Resources\GuideResource\Pages;

use App\Filament\User\Resources\GuideResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGuide extends CreateRecord
{
    protected static string $resource = GuideResource::class;
}
