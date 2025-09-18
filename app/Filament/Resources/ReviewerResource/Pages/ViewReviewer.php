<?php

namespace App\Filament\Resources\ReviewerResource\Pages;

use App\Filament\Resources\ReviewerResource;
use Filament\Actions\EditAction;
use Filament\Infolists\Components\Grid;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\{TextEntry, ImageEntry, Section};

class ViewReviewer extends ViewRecord
{
    protected static string $resource = ReviewerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->label('Edit Profil')
                ->icon('heroicon-o-pencil'),
        ];
    }
    protected static ?string $title = 'Profil Lengkap Reviewer';
    public function infolist(Infolist $infolist): Infolist
    {
        // Asumsi $this->record adalah model Reviewer yang datanya ingin ditampilkan
        return $infolist
            ->record($this->record)
            ->schema([
                // [MODIFIKASI UTAMA] Gunakan Grid untuk layout 2 kolom
                Grid::make(3)
                    ->schema([
                        // --- KOLOM KIRI: FOTO PROFIL ---
                        Section::make('Foto Profil')
                            ->extraAttributes([
                                'class' => 'flex flex-col items-center',
                            ])
                            ->schema([
                                ImageEntry::make('photo')
                                    ->label('')
                                    ->disk('public')
                                    ->defaultImageUrl(asset('images/default-profile.png'))
                                    ->size(200)
                                    ->circular(),
                            ])
                            ->columnSpan(1),

                        // --- KOLOM KANAN: INFORMASI UMUM ---
                        Section::make('Informasi Umum')
                            ->schema([
                                // Sesuaikan field ini dengan yang ada di tabel 'reviewers' Anda
                                TextEntry::make('nama')
                                    ->label('Nama Lengkap'),
                                TextEntry::make('email')
                                    ->label('Email'),
                                TextEntry::make('status_pengguna')
                                    ->label('Status Pengguna'),
                                TextEntry::make('nik')
                                    ->label('NIK'),
                                TextEntry::make('jk')
                                    ->label('Jenis Kelamin'),
                                TextEntry::make('tempat_lahir')
                                    ->label('Tempat Lahir'),
                                TextEntry::make(
                                    'tanggal_lahir'
                                )->label('Tanggal Lahir')
                                    ->date('d F Y'),
                                TextEntry::make('hp')
                                    ->label('No. HP / WA'),
                                TextEntry::make('alamat')
                                    ->label('Alamat Lengkap')
                                    ->columnSpanFull(),
                            ])
                            ->columns(2)
                            ->columnSpan(2),
                    ]),

                // --- BAGIAN BAWAH: INFORMASI AKADEMIK (FULL-WIDTH) ---
                Section::make('Informasi Akademik & Kepegawaian')
                    ->collapsible()
                    ->schema([
                        // Sesuaikan field ini dengan yang ada di tabel 'reviewers' Anda
                        TextEntry::make('nip')
                            ->label('NIP'),
                        TextEntry::make('nidn')
                            ->label('NIDN'),
                        TextEntry::make('sinta_id')
                            ->label('SINTA ID'),
                        TextEntry::make('employee_type')
                            ->label('Jenis Pegawai'),
                        TextEntry::make('profession')
                            ->label('Profesi'),
                        TextEntry::make('functional_position')
                            ->label('Jabatan Fungsional'),
                        TextEntry::make('scientific_field')
                            ->label('Bidang Ilmu'),
                        TextEntry::make('unit')
                            ->label('Unit Kerja'),
                        TextEntry::make('study_program')
                            ->label('Program Studi'),
                    ])
                    ->columns(2),
            ]);
    }
}
