<?php

namespace App\Filament\User\Pages;

use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Components\{TextEntry, ImageEntry, Section};
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Grid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Profile extends Page implements HasInfolists
{
    use \Filament\Infolists\Concerns\InteractsWithInfolists;

    protected static string $view = 'filament.user.pages.profile';
    protected static ?string $navigationLabel = 'Profil Peneliti';
    protected static ?string $title = 'Profil Peneliti';
    protected static ?string $navigationGroup = 'Profil';

    protected static ?int $navigationSort = 1;

    /**
     * @var \App\Models\Lecturer|null $record
     */
    public ?Model $record = null; // Data model Lecturer yang akan ditampilkan

    public function mount(): void
    {
        // Dapatkan record Lecturer yang berelasi dengan user yang sedang login
        $this->record = Auth::user()->lecturer;

        // Jika user belum memiliki record Lecturer atau data penting kosong, arahkan ke halaman edit
        // Anda bisa sesuaikan kondisi 'belum lengkap' di sini
        // Misalnya, jika 'nidn' atau 'jk' wajib diisi
        if (!$this->record || !$this->record->nidn || !$this->record->jk || !$this->record->alamat) {
            \Filament\Notifications\Notification::make()
                ->title('Data profil belum lengkap!')
                ->danger()
                ->body('Silakan lengkapi data profil Anda terlebih dahulu.')
                ->send();
            redirect()->route('filament.user.pages.edit-profile');
            return;
        }
    }

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

    protected function getHeaderActions(): array
    {
        return [
            Action::make('editProfile')
                ->label('Edit Profil')
                ->icon('heroicon-o-pencil')
                ->url(fn(): string => route('filament.user.pages.edit-profile')),
        ];
    }
}
