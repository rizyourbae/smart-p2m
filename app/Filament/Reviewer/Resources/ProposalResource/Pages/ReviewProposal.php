<?php

namespace App\Filament\Reviewer\Resources\ProposalResource\Pages;

use App\Filament\Reviewer\Resources\ProposalResource;
use App\Models\Proposal;
use App\Models\Review;
use Filament\Resources\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Form;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Section as FormSection;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Actions as FormActions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\View;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class ReviewProposal extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = ProposalResource::class;
    protected static string $view = 'filament.reviewer.resources.proposal-resource.pages.review-proposal';
    protected static ?string $title = 'Formulir Penilaian Proposal';

    public Proposal $record;
    public ?Review $reviewRecord = null;
    public ?array $data = [];

    public function mount(Proposal $record): void
    {
        $this->record = $record;

        // [KUNCI #1] Cari atau buat record review SPESIFIK untuk proposal DAN reviewer ini
        $this->reviewRecord = Review::firstOrCreate(
            [
                'proposal_id' => $this->record->id,
                'reviewer_id' => Auth::guard('reviewer')->id(),
            ]
        );

        $this->form->fill($this->reviewRecord->toArray());
    }

    public function form(Form $form): Form
    {
        // [LANGKAH 1] Kita siapkan "cangkang" tabs-nya di sini
        $proposalTabs = [
            // --- TAB INDUK #1: PENILAIAN PROPOSAL (Selalu Tampil) ---
            Tab::make('Penilaian Proposal')
                ->icon('heroicon-o-document-text')
                ->schema([
                    $this->buildProposalSummarySection(),
                    Tabs::make('Sub Penilaian Proposal')
                        ->tabs([
                            // SUB-TAB #1.1
                            Tab::make('Review Isian (Fill-In)')
                                ->icon('heroicon-o-chat-bubble-left-right')
                                ->schema([
                                    $this->buildSubstanceReviewSection(),
                                ]),
                            // SUB-TAB #1.2
                            Tab::make('Penilaian Usulan')
                                ->icon('heroicon-o-table-cells')
                                ->schema([
                                    $this->buildProposalScoreSection(),
                                    FormActions::make([
                                        Action::make('saveProposalReview')
                                            ->label('Simpan Penilaian Proposal')
                                            ->action('saveProposalReview'),
                                    ])->alignEnd(),
                                ]),
                        ]),
                ]),
        ];

        // [LANGKAH 2] Kita hanya tambahkan Tab Presentasi JIKA KONDISI TERPENUHI
        if (in_array($this->reviewRecord->tahapan_review, ['presentasi', 'luaran', 'selesai'])) {
            $proposalTabs[] = Tab::make('Penilaian Presentasi')
                ->icon('heroicon-o-presentation-chart-bar')
                ->schema([
                    $this->buildPresentationScoreSection(),
                    FormActions::make([
                        Action::make('savePresentationReview')
                            ->label('Simpan Penilaian Presentasi & Lanjutkan')
                            ->action('savePresentationReview'),
                    ])->alignEnd(),
                ]);
        }

        // [LANGKAH 3] Kita hanya tambahkan Tab Luaran JIKA KONDISI TERPENUHI
        if (in_array($this->reviewRecord->tahapan_review, ['luaran', 'selesai'])) {
            $proposalTabs[] = Tab::make('Penilaian Luaran')
                ->icon('heroicon-o-arrow-up-on-square')
                ->schema([
                    Grid::make(3)->schema([
                        Grid::make(1)->schema([
                            $this->buildLogbooksSummarySection(),
                            $this->buildOutputsSummarySection(),
                            $this->buildReportsSummarySection(),
                            $this->buildOutcomesSummarySection(),
                        ])->columnSpan(2),
                        Grid::make(1)->schema([
                            $this->buildProposalInfoSection(),
                        ])->columnSpan(1),
                    ]),
                    FormSection::make('Komentar Umum (Min. 300 karakter)')
                        ->schema([
                            RichEditor::make('komentar_luaran')->label('')->columnSpanFull(),
                        ]),
                    FormActions::make([
                        Action::make('finalizeReview')->label('Simpan & Finalisasi Penilaian')->action('finalizeReview')->color('success'),
                    ])->alignEnd(),
                ]);
        }

        // [LANGKAH 4] Terakhir, kita bangun form-nya dengan tabs yang sudah disaring
        return $form
            ->statePath('data')
            ->model($this->reviewRecord)
            ->schema([
                Tabs::make('Tahapan Penilaian')
                    ->tabs($proposalTabs) // <-- Gunakan array $proposalTabs yang sudah kita siapkan
                    ->columnSpanFull(),
            ]);
    }

    // --- Method-method Helper untuk Merapikan Kode ---
    protected function buildProposalSummarySection(): FormSection
    {
        return FormSection::make('Ringkasan Usulan')
            ->schema([
                // Gunakan Placeholder untuk menampilkan data dari model Proposal ($this->record)
                Placeholder::make('judul_usulan')
                    ->label('Judul Usulan')
                    ->content($this->record->judul_usulan),

                Placeholder::make('klaster_bantuan')
                    ->label('Klaster')
                    ->content($this->record->klaster_bantuan),

                Placeholder::make('total_pengajuan_dana')
                    ->label('Usulan Biaya')
                    ->content('Rp ' . number_format($this->record->total_pengajuan_dana, 0, ',', '.')),

                //Untuk status, kita ambil dari record review karena lebih relevan
                Placeholder::make('status_review')
                    ->label('Status Review')
                    ->content($this->reviewRecord->status),


                Placeholder::make('berkas_terlampir')
                    ->label('Lampiran Berkas')
                    ->content(function (): HtmlString { // <-- [UBAH] Pastikan return type adalah HtmlString
                        $buttonsHtml = '';

                        // Cari dokumen 'proposal'
                        $proposalDoc = $this->record->documents->firstWhere('jenis', 'proposal');
                        if ($proposalDoc && $proposalDoc->file_path) {
                            $buttonsHtml .= Blade::render('<x-filament::button tag="a" href="' . Storage::url($proposalDoc->file_path) . '" target="_blank" size="sm" icon="heroicon-o-document-arrow-down" color="info">Lihat Proposal</x-filament::button>');
                        }

                        // Cari dokumen 'rab'
                        $rabDoc = $this->record->documents->firstWhere('jenis', 'rab');
                        if ($rabDoc && $rabDoc->file_path) {
                            $buttonsHtml .= Blade::render('<x-filament::button tag="a" href="' . Storage::url($rabDoc->file_path) . '" target="_blank" size="sm" icon="heroicon-o-document-arrow-down" color="info">Lihat RAB</x-filament::button>');
                        }

                        // [INI KUNCINYA] Bungkus outputnya dengan HtmlString
                        return new HtmlString($buttonsHtml ?: '<span class="text-sm text-gray-500">Tidak ada berkas.</span>');
                    }),
            ])
            ->columns(2); // Atur layout menjadi 2 kolom
    }

    protected function buildSubstanceReviewSection(): FormSection
    {
        // 1. Buat komponen untuk Abstrak (statis)
        $fields = [
            Placeholder::make('abstrak_display')
                ->label('')
                ->content(function (): HtmlString {
                    $record = $this->record;
                    $heading = '<h3 class="text-base font-semibold leading-6 text-gray-900 dark:text-white mb-2">Abstrak</h3>';
                    $content = '<div class="prose prose-sm dark:prose-invert max-w-none">' . ($record->abstrak ?? '<p class="text-gray-500">Belum diisi.</p>') . '</div>';
                    return new HtmlString($heading . $content);
                })->columnSpanFull(),
            RichEditor::make('komentar_substansi.abstrak')
                ->label('Komentar Anda untuk bagian: Abstrak')
                ->columnSpanFull(),
        ];

        // 2. Lakukan perulangan untuk substansi dinamis
        $substanceData = $this->record->substansi ?? [];
        foreach ($substanceData as $index => $section) {
            $judulBagian = $section['judul_bagian'] ?? 'Tanpa Judul';
            $isiBagian = $section['isi_bagian'] ?? '<p class="text-gray-500">Kosong.</p>';

            $fields[] = Placeholder::make("substance_display_{$index}")
                ->label('')
                ->content(new HtmlString('<h3 class="text-base font-semibold leading-6 text-gray-900 dark:text-white mb-2">' . htmlspecialchars($judulBagian) . '</h3>' . '<div class="prose prose-sm dark:prose-invert max-w-none">' . $isiBagian . '</div>'))
                ->columnSpanFull();
            $fields[] = RichEditor::make("komentar_substansi.{$index}.komentar")
                ->label("Komentar Anda untuk bagian: " . htmlspecialchars($judulBagian))
                ->columnSpanFull();

            // [PERUBAIKAN] Baris Hidden::make(...) dihapus dari sini.
        }

        // 3. Kembalikan semua field dalam satu Section
        return FormSection::make('Review Isian Substansi')->schema($fields);
    }

    protected function buildProposalScoreSection(): FormSection
    {
        // Definisikan aspek penilaian di sini
        $aspekPenilaian = [
            'latar_belakang'       => '1. Latar Belakang Masalah (Bobot: 10)',
            'rumusan_masalah'      => '2. Rumusan Masalah dan Tujuan (Bobot: 10)',
            'originalitas'         => '3. Originalitas, Urgensi, dan Manfaat (Bobot: 15)',
            'kontribusi_akademik'  => '4. Kontribusi Akademik (Bobot: 15)',
            'ketepatan_metode'     => '5. Ketepatan Penggunaan Metode, & Teori (Bobot: 10)',
            'penggunaan_referensi' => '6. Penggunaan Referensi (Bobot: 10)',
            'kajian_riset'         => '7. Kajian Hasil Riset Sebelumnya yang Berkaitan (Bobot: 10)',
            'keutuhan_gagasan'     => '8. Keutuhan Gagasan (Bobot: 10)',
            'biaya_waktu'          => '9. Alokasi Biaya dan Waktu (Bobot: 10)',

        ];
        $formSkor = [];
        foreach ($aspekPenilaian as $key => $label) {
            $formSkor[] = Select::make("skor_proposal.{$key}")
                ->label($label)
                ->options(range(1, 5))
                ->required();
        }

        return FormSection::make('Skor Penilaian')
            ->schema([
                Grid::make(3)
                    ->schema($formSkor),
                RichEditor::make('komentar_proposal')
                    ->label('Komentar Umum Proposal'),

                Textarea::make('catatan_validator')
                    ->label('Catatan Validator (Ringkasan untuk Peneliti)')
                    ->helperText('Catatan singkat ini akan ditampilkan kepada peneliti. Contoh: "Lanjut ke tahap berikutnya, judul perlu direvisi".')
                    ->rows(3)
                    ->required(), // Jadikan wajib diisi
            ]);
    }

    protected function getPresentationAssessmentCriteria(): array
    {
        return [
            'keutuhan_gagasan' => [
                'label' => '1. Keutuhan Gagasan',
                'weight' => 40,
            ],
            'kontribusi_akademik' => [
                'label' => '2. Kontribusi Akademik (Akademik & Aplikatif) dan Unsur Kebaruan',
                'weight' => 30,
            ],
            'kelayakan_publikasi' => [
                'label' => '3. Kelayakan Publikasi (Sesuai Tagihan Klaster Bantuan)',
                'weight' => 20,
            ],
            'rasionalisasi_anggaran' => [
                'label' => '4. Rasionalisasi Anggaran',
                'weight' => 10,
            ],
        ];
    }

    protected function buildPresentationScoreSection(): FormSection
    {
        $assessmentCriteria = $this->getPresentationAssessmentCriteria();
        $scoreFields = [];

        // Buat field form secara dinamis dari "sumber kebenaran"
        foreach ($assessmentCriteria as $key => $criteria) {
            $scoreFields[] = Select::make("skor_presentasi.{$key}")
                ->label("{$criteria['label']} (Bobot: {$criteria['weight']})")
                ->options(range(1, 5))
                ->required();
        }
        return FormSection::make('Formulir Penilaian Presentasi')
            ->schema([
                // --- [INI PENAMBAHANNYA] ---
                Grid::make(2)
                    ->schema($scoreFields),
                Grid::make(2)
                    ->schema([
                        // Field untuk MENAMPILKAN total pengajuan dana dari Dosen
                        Placeholder::make('total_pengajuan_dana')
                            ->label('Usulan Anggaran Awal')
                            ->content('Rp ' . number_format($this->record->total_pengajuan_dana, 0, ',', '.')),

                        // Field untuk reviewer MENGISI rekomendasi biaya
                        TextInput::make('rekomendasi_biaya')
                            ->label('Rekomendasi Anggaran yang Disetujui')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->helperText('Masukkan nominal yang Anda setujui.'),
                    ]),
                // --- [AKHIR PENAMBAHAN] ---
                RichEditor::make('komentar_presentasi')
                    ->label('Komentar Umum Presentasi')
                    ->columnSpanFull(),
            ]);
    }

    protected function buildLogbooksSummarySection(): Actions
    {
        // Kita ganti dari Placeholder menjadi Actions
        return Actions::make([
            Action::make('view_logbook')
                ->label('Lihat Logbook Lengkap')
                ->icon('heroicon-o-table-cells')
                ->color('gray')
                // Aksi ini tidak melakukan submit, hanya membuka modal
                ->action(null)
                // Konten modal akan diisi oleh file view kustom
                ->modalContent(
                    // Arahkan ke file view yang akan kita buat
                    View::make('filament.reviewer.resources.proposal-resource.pages.logbook-table')
                        // Kirim data logbooks ke dalam view tersebut
                        ->viewData([
                            'logbooks' => $this->record->logbooks,
                        ])
                )
                // Hilangkan tombol-tombol default di modal (OK/Cancel)
                ->modalCancelAction(false)
                ->modalSubmitAction(false),
        ])->label('Ringkasan Logbook'); // <-- Beri label untuk keseluruhan komponen
    }

    protected function buildOutputsSummarySection(): FormSection
    {
        $outputs = $this->record->outputs;
        $content = '';

        if ($outputs->isEmpty()) {
            $content = '<span class="text-sm text-gray-500">Peneliti belum mengunggah output.</span>';
        } else {
            $buttonsHtml = '';
            foreach ($outputs as $output) {
                $url = $output->documents_outputs ? Storage::url($output->documents_outputs) : '#';
                $label = match ($output->type_outputs) {
                    'file_laporan_lengkap'   => 'Laporan Riset Lengkap',
                    'file_executive_summary' => 'Executive Summary',
                    // Tambahkan case lain sesuai kebutuhan
                    default => ucfirst(str_replace(['file_', '_'], ['', ' '], $output->type_outputs))
                };
                $buttonsHtml .= Blade::render('<div class="py-1"><x-filament::button tag="a" href="' . $url . '" target="_blank" size="sm" color="gray">' . $label . '</x-filament::button></div>');
            }
            $content = $buttonsHtml;
        }

        return FormSection::make('Berkas Luaran Terunggah')->schema([
            Placeholder::make('outputs_summary')->label('')->content(new HtmlString($content)),
        ]);
    }

    protected function buildReportsSummarySection(): FormSection
    {
        $reports = $this->record->reports;
        $content = '';

        if ($reports->isEmpty()) {
            $content = '<span class="text-sm text-gray-500">Peneliti belum mengunggah laporan.</span>';
        } else {
            $buttonsHtml = '';
            // Contoh untuk menampilkan laporan keuangan
            foreach ($reports as $report) {
                if ($report->file_path_2) { // Laporan Keuangan Sementara
                    $buttonsHtml .= Blade::render('<div class="py-1"><x-filament::button tag="a" href="' . Storage::url($report->file_path_2) . '" target="_blank" size="sm" color="gray">Laporan Keuangan Sementara</x-filament::button></div>');
                }
                if ($report->file_path_3) { // Laporan Keuangan Final
                    $buttonsHtml .= Blade::render('<div class="py-1"><x-filament::button tag="a" href="' . Storage::url($report->file_path_3) . '" target="_blank" size="sm" color="gray">Laporan Keuangan Final</x-filament::button></div>');
                }
                if ($report->file_path_4) { // Laporan Akademik Final
                    $buttonsHtml .= Blade::render('<div class="py-1"><x-filament::button tag="a" href="' . Storage::url($report->file_path_4) . '" target="_blank" size="sm" color="gray">Laporan Akademik Final</x-filament::button></div>');
                }
            }
            $content = $buttonsHtml;
        }

        return FormSection::make('Laporan Keuangan dan Akademik')->schema([
            Placeholder::make('reports_summary')->label('')->content(new HtmlString($content)),
        ]);
    }

    protected function buildOutcomesSummarySection(): FormSection
    {
        $outcomes = $this->record->outcomes;
        $content = '';

        if ($outcomes->isEmpty()) {
            $content = '<span class="text-sm text-gray-500 dark:text-gray-400">Peneliti belum mengisi outcomes.</span>';
        } else {
            $html = '<div class="space-y-4">';

            foreach ($outcomes as $outcome) {
                $html .= '<div class="p-4 border border-gray-200 rounded-lg dark:border-gray-700 dark:bg-gray-800/50 space-y-2">';

                // [PERBAIKAN] Sesuaikan pengecekan dengan data Anda
                $badgeColor = $outcome->jenis_outcomes === 'Artikel Jurnal' ? 'info' : 'success';

                $html .= Blade::render('<x-filament::badge color="' . $badgeColor . '">' . htmlspecialchars($outcome->jenis_outcomes) . '</x-filament::badge>');
                $html .= '<h4 class="font-bold text-md text-gray-900 dark:text-white">' . htmlspecialchars($outcome->judul_outcomes) . '</h4>';

                // [PERBAIKAN] Sesuaikan kondisi if dengan data Anda
                if ($outcome->jenis_outcomes === 'Artikel Jurnal') {
                    $html .= '<div class="pt-2">' . Blade::render('<x-filament::button tag="a" href="' . $outcome->link_jurnal_fix . '" target="_blank" size="sm" icon="heroicon-o-link">Buka Artikel</x-filament::button>') . '</div>';
                } else {
                    $html .= '<div class="text-sm text-gray-600 dark:text-gray-400 space-y-1">';
                    if (!empty($outcome->penerbit_buku)) {
                        $html .= '<p><span class="font-medium text-gray-800 dark:text-gray-300">Penerbit:</span> ' . htmlspecialchars($outcome->penerbit_buku) . '</p>';
                    }
                    if (!empty($outcome->tahun_terbit_buku)) {
                        $html .= '<p><span class="font-medium text-gray-800 dark:text-gray-300">Tahun:</span> ' . htmlspecialchars($outcome->tahun_terbit_buku) . '</p>';
                    }
                    if (!empty($outcome->isbn)) {
                        $html .= '<p><span class="font-medium text-gray-800 dark:text-gray-300">ISBN:</span> ' . htmlspecialchars($outcome->isbn) . '</p>';
                    }
                    $html .= '</div>';
                }

                $html .= '</div>';
            }
            $html .= '</div>';
            $content = $html;
        }

        return FormSection::make('Publikasi / Outcomes')
            ->collapsible()
            ->schema([
                Placeholder::make('outcomes_summary')->label('')->content(new HtmlString($content)),
            ]);
    }

    protected function buildProposalInfoSection(): FormSection
    {
        return FormSection::make('Informasi Bantuan')
            ->schema([
                Placeholder::make('klaster')
                    ->label('Klaster')
                    ->content($this->record->klaster_bantuan),

                Placeholder::make('judul')
                    ->label('Judul')
                    ->content($this->record->judul_usulan),

                Placeholder::make('pengusul')
                    ->label('Pengusul')
                    ->content($this->record->lecturer->nama),

                Placeholder::make('unit')
                    ->label('Unit Kerja')
                    ->content($this->record->lecturer->unit), // Bisa diisi statis atau dari data lain

                    Placeholder::make('study_program')
                    ->label('Program Studi')
                    ->content($this->record->lecturer->study_program), // Bisa diisi statis atau dari data lain

                Placeholder::make('anggaran_disetujui')
                    ->label('Anggaran Disetujui')
                    ->content('Rp ' . number_format($this->reviewRecord->rekomendasi_biaya ?? 0, 0, ',', '.')),
            ]);
    }

    // --- Method Aksi untuk Setiap Tombol Simpan ---
    public function saveProposalReview(): void
    {
        // 1. Ambil semua data dari form
        $data = $this->form->getState();

        // [LOGIKA BARU DITAMBAHKAN DI SINI]
        // Ambil data komentar yang disubmit dan data substansi asli
        $komentarSubstansi = $data['komentar_substansi'] ?? [];
        $substansiAsli = $this->record->substansi ?? [];

        // Loop melalui komentar dan suntikkan 'judul_asli'
        foreach ($komentarSubstansi as $index => &$komentar) {
            // Pastikan ini adalah entri substansi (berdasarkan index numerik), bukan abstrak
            if (is_numeric($index) && isset($substansiAsli[$index])) {
                // Ambil judul asli dari proposal dan masukkan ke array komentar
                $komentar['judul_asli'] = $substansiAsli[$index]['judul_bagian'] ?? null;
            }
        }
        // [AKHIR LOGIKA BARU]

        // 2. Hitung total skor proposal (logika ini tetap sama)
        $proposalScores = $data['skor_proposal'] ?? [];
        $weights = [
            'latar_belakang'      => 10,
            'rumusan_masalah'     => 10,
            'originalitas'        => 15,
            'kontribusi_akademik' => 15,
            'ketepatan_metode'    => 10,
            'penggunaan_referensi' => 10,
            'kajian_riset'        => 10,
            'keutuhan_gagasan'    => 10,
            'biaya_waktu'         => 10,
        ];
        $totalScore = 0;
        foreach ($weights as $key => $weight) {
            $totalScore += ($proposalScores[$key] ?? 0) * $weight;
        }

        // 3. Siapkan semua data yang akan diupdate
        $updateData = [
            // [PERUBAIKAN] Gunakan data komentar yang sudah kita perbaiki
            'komentar_substansi'   => $komentarSubstansi,
            'skor_proposal'        => $proposalScores,
            'komentar_proposal'    => $data['komentar_proposal'],
            'catatan_validator'    => $data['catatan_validator'],
            'total_nilai_proposal' => $totalScore,
        ];

        // 4. Lakukan update ke database
        $this->reviewRecord->update($updateData);

        Notification::make()
            ->title('Penilaian Proposal berhasil disimpan dan dikirim ke Admin.')
            ->success()
            ->send();

        // 5. Redirect
        $this->redirect(ProposalResource::getUrl('index'));
    }
    public function savePresentationReview(): void
    {
        $data = $this->form->getState();
        $scores = $data['skor_presentasi'] ?? [];
        $assessmentCriteria = $this->getPresentationAssessmentCriteria(); // Ambil dari "sumber kebenaran" yang sama

        $totalScore = 0;
        // Lakukan perulangan menggunakan konfigurasi yang sama untuk menghitung
        foreach ($assessmentCriteria as $key => $criteria) {
            $totalScore += ($scores[$key] ?? 0) * $criteria['weight'];
        }
        // --- [AKHIR LOGIKA PERHITUNGAN] ---

        $this->reviewRecord
            ->update([
                'skor_presentasi' => $scores, // Simpan skor individual sebagai JSON
                'komentar_presentasi' => $data['komentar_presentasi'],
                'rekomendasi_biaya'      => $data['rekomendasi_biaya'],
                'total_nilai_presentasi' => $totalScore, // Simpan total skor yang sudah dihitung
            ]);
        Notification::make()
            ->title('Penilaian Presentasi Disimpan. Tahap selanjutnya: Penilaian Luaran.')
            ->success()
            ->send();
        $this->form->fill($this->reviewRecord->fresh()->toArray());
        // Arahkan kembali ke daftar proposal
        $this->redirect(ProposalResource::getUrl('index'));
    }
    public function finalizeReview(): void
    {
        $data = $this->form->getState();
        $this->reviewRecord->update([
            'komentar_luaran' => $data['komentar_luaran'],
            'status' => 'selesai', // Tandai review selesai
            'tahapan_review' => 'selesai', // Update tahapan juga
        ]);
        Notification::make()
            ->title('Semua penilaian telah difinalisasi!')
            ->success()
            ->send();
        $this->redirect(ProposalResource::getUrl('index'));
    }
}
