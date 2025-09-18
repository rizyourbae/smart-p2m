<?php

namespace App\Filament\User\Resources\PublicationResource\Pages;

use App\Filament\User\Resources\PublicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListArtikel extends ListRecords
{
    protected static string $resource = PublicationResource::class;
    public function getFilteredTableQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getFilteredTableQuery()->where('jenis', 'Artikel');
    }

    protected static ?string $title = 'Artikel';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Data Peneliti';
    protected static ?string $navigationLabel = 'Artikel';
}
