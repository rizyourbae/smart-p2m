<?php

namespace App\Filament\User\Resources\PublicationResource\Pages;

use App\Filament\User\Resources\PublicationResource;
use Filament\Actions;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;


class ViewPublication extends ViewRecord
{
    protected static string $resource = PublicationResource::class;
    protected static ?string $title = 'Data Publikasi';
    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
            ->label('Ubah Data')
            ->icon('heroicon-o-pencil'),
        ];
    }
    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Informasi Publikasi')
                    ->schema([
                        TextEntry::make('jenis')
                            ->label('Jenis Publikasi'),

                        TextEntry::make('judul')
                            ->label('Judul'),

                        TextEntry::make('penulis')
                            ->label('Penulis'),

                        TextEntry::make('nama_jurnal')
                            ->label('Nama Jurnal')
                            ->visible(fn($record) => $record->jenis === 'Artikel'),

                        TextEntry::make('jurnal_link')
                            ->label('Link Publikasi')
                            ->url(fn($record) => $record->jurnal_link)
                            ->openUrlInNewTab()
                            ->icon('heroicon-o-eye')
                            ->formatStateUsing(fn($state) => $state ? 'Lihat' : 'Tidak Ada Dokumen')
                            ->visible(fn($record) => $record->jenis === 'Artikel'),

                        TextEntry::make('penerbit')
                            ->label('Penerbit')
                            ->visible(fn($record) => $record->jenis === 'Buku'),

                        TextEntry::make('nomor_ISBN')
                            ->label('Nomor ISBN')
                            ->visible(fn($record) => $record->jenis === 'Buku'),
                    ])
                    ->columns(2),
            ]);
    }
}
