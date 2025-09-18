<?php

namespace App\Filament\Reviewer\Pages;

use App\Models\Reviewer;
use Filament\Actions\Action;
use Filament\Pages\Page;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Components\{TextEntry, ImageEntry, Section};
use Filament\Infolists\Infolist;
use Illuminate\Support\Facades\Auth;
use Filament\Infolists\Components\Grid;


class ReviewerProfile extends Page implements HasInfolists
{
    use \Filament\Infolists\Concerns\InteractsWithInfolists;
    protected static string $view = 'filament.reviewer.pages.reviewer-profile';
    protected static ?string $navigationLabel = 'Profil Reviewer';
    protected static ?string $title = 'Profil Reviewer';
    protected static ?string $navigationGroup = 'Profil';

    protected static ?int $navigationSort = 1;

    public ?Reviewer $record = null; // <-- [PENTING] Tipe data diubah ke Reviewer

    public function mount(): void
    {
        // --- [INI PERBAIKAN UTAMANYA] ---
        // Gunakan guard 'reviewer' untuk mendapatkan data yang benar
        /** @var \App\Models\Reviewer|null $user */
        $user = Auth::guard('reviewer')->user();
        $this->record = $user;

        // Cek kelengkapan data. Ganti 'jk' dan 'alamat' dengan field lain jika perlu.
        if (!$this->record->nidn || !$this->record->jk || !$this->record->alamat) {
            \Filament\Notifications\Notification::make()
                ->title('Profil Anda Belum Lengkap')
                ->danger()
                ->body('Mohon lengkapi data profil Anda untuk melanjutkan.')
                ->persistent() // Agar notifikasi tidak hilang
                ->send();

            // Arahkan ke halaman edit
            redirect()->route('filament.reviewer.pages.edit-reviewer-profile');
            return;
        }
    }
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
                                TextEntry::make('name')
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

    protected function getHeaderActions(): array
    {
        return [
            Action::make('editProfile')
                ->label('Edit Profil')
                ->icon('heroicon-o-pencil')
                ->url(fn(): string => EditReviewerProfile::getUrl()), // Gunakan getUrl()
        ];
    }
}
