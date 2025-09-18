<?php

namespace App\Filament\User\Pages;

use Filament\Pages\Page;
use App\Models\Lecturer;
use Illuminate\Support\Facades\Auth;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;

class SintaProfile extends Page
{
    protected static ?string $navigationLabel = 'Profil SINTA';
    protected static ?string $title = 'Profil SINTA';
    protected static ?string $navigationGroup = 'Profil';

    protected static string $view = 'filament.user.pages.sinta-profile';

    protected static ?int $navigationSort = 2;

    public ?Lecturer $record;
    public ?\App\Models\EducationalHistory $highestEducation = null;

    public function mount(): void
    {
        // [PERBAIKAN BUG] Mengambil data lecturer dari relasi user yang login
        $this->record = Auth::user()->lecturer;

        if (!$this->record) {
            // Logika untuk menangani jika profil lecturer belum dibuat
            // Misalnya, arahkan ke halaman edit profil utama
            Notification::make()->title('Profil Dosen belum ada!')->danger()->send();
            redirect()->route('filament.user.pages.edit-profile');
        }
        $this->highestEducation = $this->record->educationalHistories()->latest()->first();
    }

    // Definisikan Aksi/Tombol di Header Halaman
    protected function getHeaderActions(): array
    {
        return [
            // [INI TOMBOL BARUNYA]
            Action::make('sync_sinta')
                ->label('Sinkronkan Data SINTA')
                ->icon('heroicon-o-arrow-path')
                ->color('gray')
                ->requiresConfirmation()
                ->action(function () {
                    if (empty($this->record->sinta_id)) {
                        Notification::make()->title('Gagal')->body('SINTA ID Anda belum diisi.')->danger()->send();
                        return;
                    }
                    try {
                        $browser = new HttpBrowser(HttpClient::create());
                        $url = 'https://sinta.kemdiktisaintek.go.id/authors/profile/' . $this->record->sinta_id;
                        $crawler = $browser->request('GET', $url);

                        // [INI PERBAIKAN TOTALNYA]
                        // Siapkan variabel untuk menampung hasil
                        $sintaScore3Years = '0';
                        $sintaScoreOverall = '0';
                        $sintaAffiliation3Years = '0'; // <-- [TAMBAHAN]
                        $sintaAffiliationOverall = '0'; // <-- [TAMBAHAN]

                        // Ambil semua 'kotak' statistik
                        $crawler->filter('.col-4.col-lg')->each(function ($node) use (&$sintaScore3Years, &$sintaScoreOverall, &$sintaAffiliation3Years, &$sintaAffiliationOverall) {

                            $label = $node->filter('.pr-txt')->text('');
                            $value = $node->filter('.pr-num')->text('0');

                            // Gunakan PHP untuk memeriksa isi label dan simpan nilainya
                            if (str_contains($label, 'SINTA Score 3Yr')) {
                                $sintaScore3Years = $value;
                            }
                            if (str_contains($label, 'SINTA Score Overall')) {
                                $sintaScoreOverall = $value;
                            }
                            // [INI PENAMBAHANNYA] Logika untuk mengambil Affil Score
                            if (str_contains($label, 'Affil Score 3Yr')) {
                                $sintaAffiliation3Years = $value;
                            }
                            if (str_contains($label, 'Affil Score')) {
                                $sintaAffiliationOverall = $value;
                            }
                        });

                        // Update record dengan semua data yang sudah ditemukan
                        $this->record->update([
                            'sinta_score_3_years' => trim($sintaScore3Years),
                            'sinta_score_all_years' => trim($sintaScoreOverall),
                            'sinta_affiliation_3_years'   => trim($sintaAffiliation3Years), // <-- [TAMBAHAN]
                            'sinta_affiliation_all_years' => trim($sintaAffiliationOverall), // <-- [TAMBAHAN]
                            'sinta_profile_link' => $url,
                        ]);

                        Notification::make()->title('Sinkronisasi Berhasil!')->body('Data SINTA Score berhasil diperbarui.')->success()->send();

                        return redirect(static::getUrl());
                    } catch (\Exception $e) {
                        // Tampilkan error yang sebenarnya untuk debugging
                        dd('GAGAL MELAKUKAN SCRAPING:', $e);
                    }
                }),

            Action::make('edit')
                ->label('Edit SINTA ID') // Label diubah agar lebih jelas
                ->url(EditSintaProfile::getUrl())
                ->icon('heroicon-o-pencil-square'),
        ];
    }
}
