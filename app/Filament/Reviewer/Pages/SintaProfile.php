<?php

namespace App\Filament\Reviewer\Pages;

use App\Models\Reviewer;
use Filament\Pages\Page;
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
    protected static string $view = 'filament.reviewer.pages.sinta-profile';
    protected static ?int $navigationSort = 2;
    public ?Reviewer $record = null;
    public ?\App\Models\ReviewerEducationalHistory $highestEducation = null;

    public function mount(): void
    {
        // [PERBAIKAN] Mengambil data reviewer dari user yang login di guard 'reviewer'
        /** @var \App\Models\Reviewer|null $reviewer */
        $reviewer = Auth::guard('reviewer')->user();

        // Sekarang VS Code tidak akan protes lagi saat kita melakukan assignment ini
        $this->record = $reviewer;

        if (!$this->record) {
            Notification::make()->title('Profil Reviewer tidak ditemukan!')->danger()->send();
            // Arahkan ke halaman edit profil utama reviewer
            redirect()->route('filament.reviewer.pages.edit-reviewer-profile');
            return; // Hentikan eksekusi
        }

        // Ambil data pendidikan terakhir dari reviewer
        $this->highestEducation = $this->record->educationalHistories()->latest()->first();
    }
    // Definisikan Aksi/Tombol di Header Halaman
    protected function getHeaderActions(): array
    {
        return [
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
                        Notification::make()->title('Sinkronisasi Gagal')->body('Terjadi error saat mengambil data. Pastikan SINTA ID Anda benar.')->danger()->send();
                    }
                }),

            Action::make('edit')
                ->label('Edit SINTA ID')
                ->url(EditSintaProfile::getUrl()) // <-- Pastikan halaman EditSintaProfile juga ada di panel Reviewer
                ->icon('heroicon-o-pencil-square'),
        ];
    }
}
