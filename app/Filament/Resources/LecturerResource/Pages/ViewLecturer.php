<?php

namespace App\Filament\Resources\LecturerResource\Pages;

use App\Filament\Resources\LecturerResource;
use Filament\Actions;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\{TextEntry, ImageEntry, Section};

class ViewLecturer extends ViewRecord
{
    protected static string $resource = LecturerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->label('Edit Profil')
                ->icon('heroicon-o-pencil'),
        ];
    }
    protected static ?string $title = 'Profil Lengkap Dosen/Peneliti';
    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->record($this->record)
            ->schema([
                // [PERUBAHAN UTAMA] Bungkus dua section pertama dalam sebuah Grid
                Grid::make(3) // <-- Buat grid dengan 3 kolom virtual
                    ->schema([
                        // --- KOLOM KIRI UNTUK FOTO ---
                        Section::make('Foto Profil')
                            ->extraAttributes([
                                'class' => 'flex flex-col items-center',
                            ])
                            ->schema([
                                ImageEntry::make('photo')
                                    ->label('')
                                    ->disk('public')
                                    ->defaultImageUrl(asset('images/default-profile.png'))
                                    ->size(200) // <-- Gunakan size agar responsif
                                    ->circular(),
                            ])
                            ->columnSpan(1), // <-- Foto memakan 1 dari 3 kolom

                        // --- KOLOM KANAN UNTUK INFO UTAMA ---
                        Section::make('Informasi Umum')
                            ->schema([
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
                            ->columnSpan(2), // <-- Info umum memakan 2 dari 3 kolom
                    ]),

                // Section di bawah ini tetap full-width, tidak masuk ke dalam grid di atas
                Section::make('Informasi Kepegawaian & Akademik')
                    ->collapsible() // <-- Tambahkan ini agar bisa dilipat
                    ->schema([
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
                    ])->columns(2),
            ]);
    }
}
