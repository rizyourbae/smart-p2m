<?php

namespace App\Filament\User\Resources\IndependentActivityResource\Pages;

use App\Filament\User\Resources\IndependentActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\EditAction;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;

class ViewIndependentActivity extends ViewRecord
{
    protected static string $resource = IndependentActivityResource::class;
    protected static ?string $title = 'Data Kegiatan';
    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
            ->label('Edit Kegiatan')
            ->icon('heroicon-o-pencil'),
        ];
    }
    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Kegiatan')
                    ->schema([
                        TextEntry::make('jenis')
                            ->label('Jenis Kegiatan'),
                        TextEntry::make('judul')
                            ->label('Judul Kegiatan'),
                        TextEntry::make('anggota')
                            ->label('Anggota'),
                        TextEntry::make('tahun_pelaksanaan')
                            ->label('Tahun Pelaksanaan'),
                        TextEntry::make('pelaksana_kegiatan')
                            ->label('Pelaksana Kegiatan'),
                        TextEntry::make('mitra_kolaborasi')
                            ->label('Mitra Kolaborasi'),
                        TextEntry::make('sumber_dana')
                            ->label('Sumber Dana'),
                        TextEntry::make('besaran_dana')
                            ->label('Besaran Dana'),
                        TextEntry::make('resume')
                            ->label('Resume/Abstrak')
                            ->columnSpan(2)
                            ->formatStateUsing(fn($state) => strip_tags($state)),
                    ])->columns(2),
            ]);
    }
}
