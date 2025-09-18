<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\ProposalResource\Pages;
use App\Filament\User\Resources\ProposalResource\RelationManagers;
use App\Models\Proposal;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\View;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section as InfoSection;
use Filament\Infolists\Components\Grid as InfoGrid;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\Tabs\Tab;
use Filament\Infolists\Components\ViewEntry;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Actions\ActionGroup;
use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;

class ProposalResource extends Resource
{
    protected static ?string $model = Proposal::class;
    protected static ?string $navigationGroup = 'Peneliti';
    protected static ?string $navigationLabel = 'Proposal';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Wizard::make([
                // STEP 1 — Pernyataan
                Step::make('Pernyataan Peneliti')
                    ->icon('heroicon-m-user')
                    ->description('Mohon Lengkapi')
                    ->schema([
                        TextInput::make('judul_usulan')
                            ->label('Judul Usulan')
                            ->placeholder('Masukkan Judul Usulan Proposal Anda')
                            ->required()
                            ->columnSpanFull()
                            ->validationMessages(['required' => 'Judul Tidak Boleh Kosong']),

                        TextInput::make('kata_kunci')
                            ->label('Kata Kunci / Keyword')
                            ->placeholder('Keyword Minimal 3 Kata, pisahkan dengan koma')
                            ->required()
                            ->validationMessages(['required' => 'Keyword Tidak Boleh Kosong']),

                        Select::make('pengelola_bantuan')
                            ->options(['PTKIN' => 'PTKIN', 'Pusat' => 'Pusat'])
                            ->required()
                            ->label('Pengelola Bantuan')
                            ->placeholder('Pilih Pengelola Bantuan')
                            ->validationMessages(['required' => 'Wajib dipilih']),

                        Select::make('klaster_bantuan')
                            ->options([
                                '25205 - Bantuan Pendampingan Kualitas Jurnal International  Bereputasi (BOPTN)' => '25205 - Bantuan Pendampingan Kualitas Jurnal International  Bereputasi (BOPTN)',
                                '25204 - Bantuan Pendampingan Rumah Jurnal (BOPTN)' => '25204 - Bantuan Pendampingan Rumah Jurnal (BOPTN)',
                                '25409 - Bantuan Penghargaan Penulis Artikel di Jurnal Internasional Bereputasi (BOPTN)' => '25409 - Bantuan Penghargaan Penulis Artikel di Jurnal Internasional Bereputasi (BOPTN)',
                                '25410 - Bantuan Penghargaan Penulis Buku di Penerbit Internasional Bereputasi (BOPTN)' => '25410 - Bantuan Penghargaan Penulis Buku di Penerbit Internasional Bereputasi (BOPTN)',
                                '25411 - Bantuan Penghargaan Penulis Buku di Penerbit Nasional Bereputasi (BOPTN)' => '25411 - Bantuan Penghargaan Penulis Buku di Penerbit Nasional Bereputasi (BOPTN)',
                                '25206 - Bantuan Peningkatan Kualitas Jurnal Nasional Terakreditasi (BOPTN)' => '25206 - Bantuan Peningkatan Kualitas Jurnal Nasional Terakreditasi (BOPTN)',
                                '25317 - Pengabdian  Masyarakat  Berbasis  Lembaga  Pendidikan,  Keagamaan, dan Kemasyarakatan dan Moderasi Beragama (BOPTN)' => '25317 - Pengabdian  Masyarakat  Berbasis  Lembaga  Pendidikan,  Keagamaan, dan Kemasyarakatan dan Moderasi Beragama (BOPTN)',
                                '25323 - Pengabdian kepada Masyarakat Berbasis Komunitas dan atau Masyarakat Marginal (BOPTN)' => '25323 - Pengabdian kepada Masyarakat Berbasis Komunitas dan atau Masyarakat Marginal (BOPTN)',
                                '25328 - Pengabdian kepada Masyarakat Berbasis Lingkungan, Energi terbarukan, Kebencanaan dan Kesehatan Masyarakat (BOPTN)' => '25328 - Pengabdian kepada Masyarakat Berbasis Lingkungan, Energi terbarukan, Kebencanaan dan Kesehatan Masyarakat (BOPTN)',
                                '25326 - Pengabdian kepada Masyarakat Berbasis Local Wisdom (BOPTN)' => '25326 - Pengabdian kepada Masyarakat Berbasis Local Wisdom (BOPTN)',
                                '25344 - Pengabdian kepada Masyarakat Berbasis Program Studi  (BLU)' => '25344 - Pengabdian kepada Masyarakat Berbasis Program Studi  (BLU)',
                                '25322 - Pengabdian kepada Masyarakat Berbasis Program Studi (BOPTN)' => '25322 - Pengabdian kepada Masyarakat Berbasis Program Studi (BOPTN)',
                                '25324 - Pengabdian kepada Masyarakat Berbasis Ramah Anak, Gender, dan Difabel (BOPTN)' => '25324 - Pengabdian kepada Masyarakat Berbasis Ramah Anak, Gender, dan Difabel (BOPTN)',
                                '25329 - Pengabdian kepada Masyarakat Kolaborasi Nasional Antar PT dan atau Kementerian/Lembaga (BOPTN)' => '25329 - Pengabdian kepada Masyarakat Kolaborasi Nasional Antar PT dan atau Kementerian/Lembaga (BOPTN)',
                                '25325 - Pengabdian kepada Masyarakat Lingkar Kampus (BOPTN)' => '25325 - Pengabdian kepada Masyarakat Lingkar Kampus (BOPTN)',
                                '25327 - Pengabdian Masyarakat Berbasis Dunia Usaha dan Dunia Industri (DUDI) dalam bidang Ekonomi Umat, Pangan, Produk dan Wisata Halal (BOPTN)' => '25327 - Pengabdian Masyarakat Berbasis Dunia Usaha dan Dunia Industri (DUDI) dalam bidang Ekonomi Umat, Pangan, Produk dan Wisata Halal (BOPTN)',
                            ])
                            ->required()
                            ->label('Klaster Bantuan')
                            ->columnSpanFull()
                            ->placeholder('Pilih Klaster Bantuan')
                            ->reactive()
                            ->validationMessages(['required' => 'Wajib dipilih']),

                        Select::make('bidang_ilmu')
                            ->options([
                                'Studi Islam/Dirasat Islamiyah/Islamic Studies' => 'Studi Islam/Dirasat Islamiyah/Islamic Studies',
                                'Ekonomi dan Bisnis Islam' => 'Ekonomi dan Bisnis Islam',
                                'Ushuluddin dan Pemikiran/Filsafat' => 'Ushuluddin dan Pemikiran/Filsafat',
                                'Dakwah dan Komunikasi' => 'Dakwah dan Komunikasi',
                                'Adab dan Humaniora' => 'Adab dan Humaniora',
                                'Syariah dan Ilmu Hukum' => 'Syariah dan Ilmu Hukum',
                                'Tarbiyah dan Ilmu Pendidikan' => 'Tarbiyah dan Ilmu Pendidikan',
                                'Ilmu Politik' => 'Ilmu Politik',
                                'Sains dan Teknologi' => 'Sains dan Teknologi',
                                'Kedokteran dan Ilmu Kesehatan' => 'Kedokteran dan Ilmu Kesehatan',
                                'Psikologi Islam' => 'Psikologi Islam',
                                'Lainnya' => 'Lainnya',
                            ])
                            ->required()
                            ->label('Bidang Ilmu')
                            ->placeholder('Pilih Bidang Ilmu')
                            ->validationMessages(['required' => 'Wajib dipilih']),

                        Select::make('tema')
                            ->options([
                                'Agama dan Keagamaan' => 'Agama dan Keagamaan',
                                'Energi' => 'Energi',
                                'Kedokteran dan Kesehatan' => 'Kedokteran dan Kesehatan',
                                'Kemaritiman' => 'Kemaritiman',
                                'Pangan-Pertanian' => 'Pangan-Pertanian',
                                'Pertahanan dan Keamanan' => 'Pertahanan dan Keamanan',
                                'Produksi Rekayasa Keteknikan' => 'Produksi Rekayasa Keteknikan',
                                'Sosial Humaniora' => 'Sosial Humaniora',
                                'Transportasi' => 'Transportasi',
                            ])
                            ->required()
                            ->label('Tema')
                            ->placeholder('Pilih Tema')
                            ->validationMessages(['required' => 'Wajib dipilih']),

                        Select::make('jenis_penelitian')
                            ->options([
                                'Riset Pembinaan/Kapasitas' => 'Riset Pembinaan/Kapasitas',
                                'Riset Dasar' => 'Riset Dasar',
                                'Riset Terapan' => 'Riset Terapan',
                                'Riset Pengembangan' => 'Riset Pengembangan',
                                'Kajian Aktual Strategis' => 'Kajian Aktual Strategis',
                                'Bantuan selain penelitian' => 'Bantuan selain penelitian',
                            ])
                            ->required()
                            ->label('Jenis Penelitian')
                            ->placeholder('Pilih Jenis Penelitian')
                            ->validationMessages(['required' => 'Wajib dipilih']),

                        Select::make('kontribusi_keilmuan')
                            ->options(['BerkontribuReportResi' => 'Berkontribusi', 'Tidak Berkontribusi' => 'Tidak Berkontribusi'])
                            ->required()
                            ->label('Kontribusi atas keilmuan prodi?')
                            ->placeholder('Pilih Kontribusi')
                            ->validationMessages(['required' => 'Wajib dipilih']),

                        CheckboxList::make('research_schemes')
                            ->label('Pernyataan pengusul bantuan :')
                            ->helperText('dengan ini menyatakan bahwa proposal yang diajukan sesuai dengan yang diisi')
                            ->options([
                                'proposal' => 'Proposal tidak sedang mendapatkan bantuan dari pihak manapun',
                                'biaya'    => 'Jika dibiayai oleh pihak lain, kami bersedia untuk dianulir dari proses pengelolaan bantuan diktis',
                                'bebas'    => 'Proposal bebas dari unsur plagiasi baik sebagian ataupun secara keseluruhan',
                                'diktis'   => 'Kami bersedia mengikuti aturan dan petunjuk yang berlaku dalam pengelolaan bantuan diktis',
                            ])
                            ->rules(['required', 'array', 'size:4']) // semua wajib tercentang
                            ->columnSpanFull(),
                    ])->columns(2),

                // STEP 2 — Data Peneliti
                Step::make('Data Peneliti')
                    ->icon('heroicon-m-table-cells')
                    ->description('Lengkapi Data Peneliti')
                    ->schema([
                        View::make('components.wizard.info-box')->columnSpanFull(),

                        TextInput::make('klaster_bantuan')
                            ->disabled()
                            ->dehydrated(false)
                            ->columnSpan(1),
                        TextInput::make('jumlah_min_peneliti')
                            ->label('Jumlah Minimal Peneliti')
                            ->default('2 Orang')
                            ->disabled()
                            ->dehydrated(false)
                            ->columnSpan(1),

                        Section::make('Peneliti Utama (KETUA)')
                            ->schema([
                                TextInput::make('nama_peneliti_utama')
                                    ->label('Nama')
                                    ->default(fn() => optional(Auth::user()->lecturer)->nama ?? '-')
                                    ->disabled()
                                    ->dehydrated(false),
                                TextInput::make('nip_peneliti_utama')
                                    ->label('NIP')
                                    ->default(fn() => optional(Auth::user()->lecturer)->nip ?? '-')
                                    ->disabled()
                                    ->dehydrated(false),
                                TextInput::make('nidn_peneliti_utama')
                                    ->label('NIDN')
                                    ->default(fn() => optional(Auth::user()->lecturer)->nidn ?? '-')
                                    ->disabled()
                                    ->dehydrated(false),
                                TextInput::make('unit_peneliti_utama')
                                    ->label('Unit')
                                    ->default(fn() => optional(Auth::user()->lecturer)->unit ?? '-')
                                    ->disabled()
                                    ->dehydrated(false),
                                TextInput::make('status_peneliti_utama')
                                    ->label('Status')
                                    ->default('Disetujui')
                                    ->disabled()
                                    ->dehydrated(false),
                            ])
                            ->columns(3)
                            ->columnSpanFull(),

                        Section::make('Data Peneliti')
                            ->schema([
                                Repeater::make('lecturers')
                                    ->relationship('lecturers')
                                    ->label('Peneliti')
                                    ->columns(4)
                                    ->schema([
                                        Select::make('jabatan')
                                            ->options(['Anggota' => 'Anggota'])
                                            ->required(),
                                        TextInput::make('nama_dosen')
                                            ->label('Nama Peneliti')
                                            ->required(),
                                        TextInput::make('nip')
                                            ->label('NIP')
                                            ->numeric()
                                            ->rule('digits:18')
                                            ->required(),
                                        TextInput::make('nidn')
                                            ->label('NIDN')
                                            ->numeric()
                                            ->rule('digits:10')
                                            ->required(),
                                        TextInput::make('institusi')
                                            ->label('Institusi')
                                            ->required(),
                                    ])
                                    ->addActionLabel('Tambah Peneliti')
                                    ->minItems(1),
                            ])->columnSpanFull(),

                        Section::make('Mahasiswa Anggota Peneliti')
                            ->schema([
                                Repeater::make('students')
                                    ->relationship('students')
                                    ->label('Mahasiswa')
                                    ->columns(3)
                                    ->schema([
                                        TextInput::make('nim')
                                            ->label('NIM')
                                            ->numeric()
                                            ->rule('digits:11'),
                                        TextInput::make('nama_mahasiswa')
                                            ->label('Nama Mahasiswa'),
                                        TextInput::make('program_studi')
                                            ->label('Program Studi'),
                                    ])
                                    ->addActionLabel('Tambah Mahasiswa'),
                            ])->columnSpanFull(),

                        Section::make('Anggota Peneliti dari PTU / Profesional')
                            ->schema([
                                Repeater::make('ptus')
                                    ->relationship('ptus')
                                    ->label('Peneliti PTU / Profesional')
                                    ->columns(3)
                                    ->schema([
                                        TextInput::make('nidn_nik')
                                            ->label('NIDN / NIK')
                                            ->numeric(),
                                        TextInput::make('nama_peneliti')
                                            ->label('Nama Peneliti'),
                                        TextInput::make('institusi')
                                            ->label('Institusi'),
                                    ])
                                    ->addActionLabel('Tambah Peneliti PTU / Profesional'),
                            ])->columnSpanFull(),
                    ])->columns(2),

                // STEP 3 - Substansi Proposal
                Step::make('Substansi Usulan')
                    ->icon('heroicon-m-document-text')
                    ->description('Lengkapi substansi usulan Anda')
                    ->schema([
                        View::make('components.wizard.isi-proposal')->columnSpanFull(),
                        RichEditor::make('abstrak')
                            ->label('Abstrak')
                            ->required()
                            ->columnSpanFull()
                            ->helperText('Isi ringkasan dari keseluruhan proposal Anda di sini.'),
                        Repeater::make('substansi')
                            ->label('Isian Substansi Proposal')
                            ->schema([
                                TextInput::make('judul_bagian')
                                    ->label('Judul Bagian (Contoh: Latar Belakang)')
                                    ->required(),
                                RichEditor::make('isi_bagian')
                                    ->label('Isi Bagian')
                                    ->required()
                                    ->columnSpanFull(),
                            ])
                            ->addActionLabel('Tambah Bagian Substansi')
                            ->columns(1)
                            ->collapsible() // Membuat setiap item bisa di-minimize
                            ->itemLabel(fn(array $state): ?string => $state['judul_bagian'] ?? null), // Menampilkan judul bagian di header repeater
                    ]),

                // STEP 4 — Unggah Berkas
                Step::make('Unggah Berkas')
                    ->icon('heroicon-m-document-arrow-up')
                    ->description('Lengkapi Berkas')
                    ->schema([
                        View::make('components.wizard.berkas-box')->columnSpanFull(),

                        Section::make('Dokumen Wajib & Pendukung') // Judul diubah agar lebih jelas
                            ->schema([
                                // Di dalam Repeater inilah kita letakkan validasi kustomnya
                                Repeater::make('documents')->relationship('documents')
                                    ->schema([
                                        Select::make('jenis')->options([
                                            'proposal'       => 'Proposal',
                                            'rab'            => 'RAB',
                                            'cek_similarity' => 'Hasil Cek Similarity',
                                            'pendukung'      => 'Pendukung',
                                        ])->required(),
                                        FileUpload::make('file_path')
                                            ->label('File')
                                            ->disk('public')
                                            ->directory('documents/proposal')
                                            ->downloadable()
                                            ->openable()
                                            ->required(),
                                        PdfViewerField::make('file_path')
                                            ->label('Review Dokumen')
                                            ->minHeight('40svh')
                                    ])
                                    ->addActionLabel('Tambah Dokumen')
                                    ->minItems(3)
                                    ->validationMessages([
                                        'min' => 'Minimal harus ada 3 dokumen yang diunggah (Proposal, RAB, dan Hasil Similarity).',
                                    ])
                                    ->rules([
                                        function () {
                                            return function (string $attribute, $value, \Closure $fail) {
                                                $items = collect($value);

                                                $hasProposal = $items->contains('jenis', 'proposal');
                                                $hasRab = $items->contains('jenis', 'rab');
                                                $hasSimilarity = $items->contains('jenis', 'cek_similarity');

                                                if (!$hasProposal || !$hasRab || !$hasSimilarity) {
                                                    $missing = [];
                                                    if (!$hasProposal) $missing[] = 'Proposal';
                                                    if (!$hasRab) $missing[] = 'RAB';
                                                    if (!$hasSimilarity) $missing[] = 'Hasil Similarity';

                                                    $fail('Anda wajib mengunggah dokumen berikut: ' . implode(', ', $missing) . '.');
                                                }
                                            };
                                        },
                                    ])
                                    ->columnSpanFull(),
                            ])->columnSpanFull(),
                    ])->columns(1),

                // STEP 5 — Data Jurnal
                Step::make('Data Jurnal')
                    ->icon('heroicon-m-book-open')
                    ->description('Lengkapi Data Jurnal')
                    ->schema([
                        Section::make()->schema([
                            TextInput::make('issn_jurnal')
                                ->label('ISSN Jurnal')
                                ->required(),
                            RichEditor::make('rencana_kegiatan')
                                ->label('Rencana Kegiatan Pendampingan')
                                ->required()
                                ->columnSpanFull(),
                            RichEditor::make('profil_jurnal')
                                ->label('Profil Jurnal')
                                ->required()
                                ->columnSpanFull(),
                            TextInput::make('url_website_jurnal')
                                ->label('URL Website Jurnal')
                                ->type('url')
                                ->required(),
                            TextInput::make('url_scopus')
                                ->label('URL Jurnal di Scopus / WoS / Scimago')
                                ->type('url')
                                ->required(),
                            TextInput::make('url_surat_rekomendasi')
                                ->label('URL Surat Rekomendasi Institusi')
                                ->type('url')
                                ->required(),
                            TextInput::make('total_pengajuan_dana')
                                ->label('Total Pengajuan Dana (Maksimal Rp. 100.000.000)')
                                ->numeric()
                                ->required()
                                ->minValue(0)
                                ->maxValue(100_000_000)
                                ->suffix('Rp')
                                ->step(1000),
                        ])->columns(2)->columnSpanFull(),
                    ])->columns(1),
            ])->columnSpanFull()->skippable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('No')
                    ->rowIndex(),

                TextColumn::make('created_at')
                    ->label('Periode')
                    ->date('Y')
                    ->sortable(),

                TextColumn::make('judul_usulan')
                    ->label('Judul Usulan')
                    ->limit(50)
                    ->searchable()
                    ->sortable(),

                TextColumn::make('klaster_bantuan')
                    ->label('Klaster')
                    ->limit(50)
                    ->searchable()
                    ->sortable(),

                // --- [TAMBAHKAN KOLOM INI] ---
                TextColumn::make('status')
                    ->badge()
                    // [LANGKAH 1] Atur warna badge sesuai dengan semua status baru kita
                    ->color(fn(string $state): string => match ($state) {
                        'draft' => 'gray',
                        'diajukan' => 'gray',
                        'dalam_penilaian' => 'warning',
                        'menunggu_keputusan' => 'info',
                        'revisi' => 'warning',
                        'diterima' => 'success',
                        'ditolak' => 'danger',
                        default => 'gray',
                    })
                    // [LANGKAH 2] Ubah format tampilan teksnya
                    ->formatStateUsing(function (string $state): string {
                        // Ganti underscore (_) dengan spasi
                        $formattedState = str_replace('_', ' ', $state);
                        // Ubah setiap kata menjadi huruf kapital di depan
                        return ucwords($formattedState);
                    })
                    ->searchable(),

            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(), // Saya tambahkan ViewAction sebagai contoh
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ])
                    ->label('Opsi') // Mengubah label default jika tidak pakai ikon
                    ->icon('heroicon-m-cog-8-tooth') // Mengganti ikon
                    ->tooltip('Klik untuk melihat opsi lainnya') // Menambahkan tooltip
                    ->color('primary') // Mengubah warna tombol
                    ->button()
                    ->size('sm'), // Mengubah ukuran tombol
            ])
            ->emptyStateHeading('Belum ada proposal yang diajukan')
            ->emptyStateDescription('Silahkan ajukan proposal');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            // [MODIFIKASI UTAMA] Kita bungkus semuanya dalam komponen Tabs
            Tabs::make('Tabs')
                ->tabs([
                    // TAB PERTAMA: DETAIL PROPOSAL
                    Tab::make('Rangkuman')
                        ->icon('heroicon-m-clipboard-document-list')
                        ->schema([
                            // ——— Ringkasan ———
                            InfoSection::make('Ringkasan')
                                ->schema([
                                    InfoGrid::make(1)
                                        ->schema([
                                            TextEntry::make('judul_usulan')
                                                ->label('Judul Usulan')
                                                ->inlineLabel(),
                                            TextEntry::make('lecturer.nama')
                                                ->label('Ketua Pengusul')
                                                ->inlineLabel(), // Label diubah agar lebih jelas
                                            TextEntry::make('klaster_bantuan')
                                                ->label('Klaster / Pengelola')
                                                ->inlineLabel(),
                                            TextEntry::make('created_at')
                                                ->label('Tahun Anggaran')
                                                ->date('Y')
                                                ->inlineLabel(),
                                            TextEntry::make('total_pengajuan_dana')
                                                ->label('Usulan Biaya')
                                                ->money('IDR')
                                                ->inlineLabel(),
                                            TextEntry::make('status')
                                                ->label('Status')
                                                ->badge()
                                                ->color(fn(string $state): string => match ($state) {
                                                    'draft' => 'gray',
                                                    'diajukan' => 'gray',
                                                    'dalam_penilaian' => 'warning',
                                                    'menunggu_keputusan' => 'info',
                                                    'revisi' => 'warning',
                                                    'diterima' => 'success',
                                                    'ditolak' => 'danger',
                                                    default => 'gray',
                                                })
                                                ->formatStateUsing(fn(string $state): string => ucwords(str_replace('_', ' ', $state)))
                                                ->inlineLabel(),
                                            TextEntry::make('hasil_similarity_link')
                                                ->label('Hasil Cek Similarity')
                                                ->state(fn($record) => $record->documents->firstWhere('jenis', 'cek_similarity'))
                                                ->formatStateUsing(fn($state) => $state ? '📄 Lihat Berkas' : 'Belum diunggah')
                                                ->badge()->color('info')
                                                ->url(fn($state): ?string => $state ? Storage::url($state->file_path) : null)
                                                ->openUrlInNewTab()
                                                ->inlineLabel()
                                                ->visible(fn($record) => $record->documents->where('jenis', 'cek_similarity')->isNotEmpty()),
                                            TextEntry::make('abstrak')
                                                ->label('Abstrak')
                                                ->html()
                                                ->state(fn($record) => $record->abstrak)
                                                ->columnSpanFull()
                                                ->extraAttributes([
                                                    'class' => 'text-justify',
                                                ]),
                                        ]),
                                ])
                                ->columns(1),
                            // ——— Daftar Peneliti (Dosen) ———
                            InfoSection::make('Peneliti (PTKI)')
                                ->icon('heroicon-m-user')
                                ->collapsible()
                                ->schema([
                                    // [BAGIAN 1] Tampilkan Ketua Peneliti dengan KOTAK menggunakan InfoGrid
                                    InfoGrid::make(5) // <-- [PERBAIKAN] Menggunakan InfoGrid
                                        // Tambahkan atribut CSS untuk membuat kotak
                                        ->extraAttributes([
                                            'class' => 'p-4 border border-gray-200 rounded-lg dark:border-gray-700',
                                        ])
                                        ->schema([
                                            TextEntry::make('ketua_jabatan')
                                                ->label('Jabatan')
                                                ->weight('bold')
                                                ->default('Ketua Peneliti'),
                                            TextEntry::make('lecturer.nama')
                                                ->label('Nama'),
                                            TextEntry::make('lecturer.nip')
                                                ->label('NIP'),
                                            TextEntry::make('lecturer.nidn')
                                                ->label('NIDN'),
                                            TextEntry::make('lecturer.unit')
                                                ->label('Institusi / Unit'),
                                        ]),
                                    // [BAGIAN 2] Tampilkan Anggota Peneli->weight('bold'),ti lainnya menggunakan RepeatableEntry
                                    RepeatableEntry::make('lecturers')
                                        ->label('')
                                        ->schema([
                                            TextEntry::make('jabatan')
                                                ->label('Jabatan')
                                                ->weight('bold'),
                                            TextEntry::make('nama_dosen')
                                                ->label('Nama'),
                                            TextEntry::make('nip')
                                                ->label('NIP'),
                                            TextEntry::make('nidn')
                                                ->label('NIDN'),
                                            TextEntry::make('institusi')
                                                ->label('Institusi / Unit'),
                                        ])
                                        ->columns(5),
                                ])
                                ->columns(1),

                            // ——— Daftar Mahasiswa ———
                            InfoSection::make('Mahasiswa Pembantu Peneliti')
                                ->icon('heroicon-m-academic-cap')
                                ->collapsible()
                                ->schema([
                                    RepeatableEntry::make('students')
                                        ->label('')
                                        ->state(
                                            fn($record) => $record->students
                                                ->map(fn($s) => [
                                                    'nim'   => $s->nim,
                                                    'nama_mahasiswa'  => $s->nama_mahasiswa,
                                                    'program_studi' => $s->program_studi,
                                                ])->toArray()
                                        )
                                        ->schema([
                                            TextEntry::make('nim')
                                                ->label('NIM'),
                                            TextEntry::make('nama_mahasiswa')
                                                ->label('Nama'),
                                            TextEntry::make('program_studi')
                                                ->label('Program Studi'),
                                        ])
                                        ->columns(3)
                                        ->visible(fn($record) => $record->students->isNotEmpty()),

                                    TextEntry::make('students_empty')
                                        ->label('')
                                        ->state('Belum ada data mahasiswa')
                                        ->color('gray')
                                        ->visible(fn($record) => $record->students->isEmpty()),
                                ])
                                ->columns(1),
                            // ——— PTU / Profesional ———
                            InfoSection::make('Anggota Peneliti PTU / Profesional')
                                ->icon('heroicon-m-user-plus')
                                ->collapsible()
                                ->schema([
                                    RepeatableEntry::make('ptus')
                                        ->label('')
                                        ->state(
                                            fn($record) => $record->ptus
                                                ->map(fn($p) => [
                                                    'nidn_nik'  => $p->nidn_nik,
                                                    'nama_peneliti'      => $p->nama_peneliti,
                                                    'institusi' => $p->institusi,
                                                ])->toArray()
                                        )
                                        ->schema([
                                            TextEntry::make('nidn_nik')
                                                ->label('NIDN/NIK'),
                                            TextEntry::make('nama_peneliti')
                                                ->label('Nama Peneliti'),
                                            TextEntry::make('institusi')
                                                ->label('Institusi'),
                                        ])
                                        ->columns(3)
                                        ->visible(fn($record) => $record->ptus->isNotEmpty()),

                                    TextEntry::make('ptus_empty')
                                        ->label('')
                                        ->state('Belum ada PTU / Profesional')
                                        ->color('gray')
                                        ->visible(fn($record) => $record->ptus->isEmpty()),
                                ])
                                ->columns(1),

                            // ——— Dokumen Proposal ———
                            InfoSection::make('Dokumen Proposal')
                                ->icon('heroicon-m-document-duplicate')
                                ->collapsible()
                                ->schema([
                                    InfoGrid::make(2)->schema([
                                        // Dokumen Proposal
                                        TextEntry::make('label_dokumen')
                                            ->state('Nama Berkas')
                                            ->weight('bold')
                                            ->extraAttributes(['class' => 'text-gray-600'])
                                            ->label('')
                                            ->columnSpan(1),
                                        TextEntry::make('label_file')
                                            ->state('Berkas Terunggah')
                                            ->weight('bold')
                                            ->extraAttributes(['class' => 'text-gray-600'])
                                            ->label('')
                                            ->columnSpan(1),
                                    ]),
                                    RepeatableEntry::make('documents')
                                        ->label('')
                                        ->state(
                                            fn($record) => $record->documents
                                                ->map(fn($d) => [
                                                    'jenis'     => ucfirst($d->jenis),
                                                    'file_path' => $d->file_path,
                                                ])->toArray()
                                        )
                                        ->schema([
                                            // Jenis sebagai badge
                                            TextEntry::make('jenis')
                                                ->label('')
                                                ->badge()
                                                ->color(fn($state) => match (strtolower($state)) {
                                                    'proposal' => 'info', // biru
                                                    'rab'      => 'success', // hijau
                                                    'pendukung'  => 'warning', // kuning
                                                    'cek_similarity' => 'danger', // merah
                                                    default    => 'gray',    // default jika tidak dikenali
                                                })
                                                ->formatStateUsing(fn($state) => match (strtolower($state)) {
                                                    'proposal' => 'Dokumen Proposal',
                                                    'rab'      => 'Dokumen RAB',
                                                    'pendukung'  => 'Dokumen Pendukung',
                                                    'cek_similarity' => 'Hasil Similarity',
                                                    default    => ucfirst($state),
                                                }),

                                            // File sebagai "tombol" (badge yang bisa diklik)
                                            TextEntry::make('file_path')
                                                ->label('')
                                                // Ganti teks link jadi 'Lihat Dokumen' (tidak menampilkan nama file)
                                                ->formatStateUsing(fn() => '📄 Lihat Dokumen')
                                                ->badge()               // tampil seperti tombol/badge
                                                ->color('primary')
                                                ->url(function ($state) {
                                                    if (! $state) return null;

                                                    $base = config('filesystems.disks.public.url');
                                                    return $base
                                                        ? rtrim($base, '/') . '/' . ltrim($state, '/')
                                                        : asset('storage/' . ltrim($state, '/'));
                                                })
                                                ->openUrlInNewTab(),
                                        ])
                                        ->columns(2)
                                        ->visible(fn($record) => $record->documents->isNotEmpty()),

                                    TextEntry::make('documents_empty')
                                        ->label('')
                                        ->state('Belum ada dokumen')
                                        ->color('gray')
                                        ->visible(fn($record) => $record->documents->isEmpty()),
                                ])->columns(1), // Disingkat, isinya sama persis

                            // ——— Catatan Validator (yang sudah Anda buat sebelumnya) ———
                            InfoSection::make('Catatan Validator')
                                ->icon('heroicon-m-chat-bubble-left-ellipsis')
                                ->collapsible()
                                ->schema([
                                    RepeatableEntry::make('reviews')
                                        ->label('')
                                        ->schema([
                                            TextEntry::make('catatan_validator')
                                                ->label(function ($record, Component $livewire): string {
                                                    $allReviews = $livewire->getRecord()->reviews;
                                                    $index = $allReviews->search(fn($review) => $review->is($record));
                                                    return 'Catatan Reviewer ' . ($index + 1);
                                                })
                                                ->prose()->placeholder('Tidak ada catatan.'),
                                        ])
                                        ->columns(1)
                                        ->visible(fn($record) => $record->reviews->isNotEmpty()),
                                    TextEntry::make('no_reviews_placeholder')
                                        ->label('')->hidden(fn($record) => $record->reviews->isNotEmpty())
                                        ->state('Catatan reviewer akan muncul setelah proses review dimulai.'),
                                ]),
                        ]),

                    // TAB KEDUA: DETAIL REVIEW SUBSTANSI
                    Tab::make('Review Substansi')
                        ->icon('heroicon-m-chat-bubble-left-right')
                        ->visible(fn($record) => $record->reviews()->exists()) // Tampil jika sudah ada review
                        ->schema([
                            ViewEntry::make('substance_reviews')
                                ->label('')
                                ->view('components.infolists.substance-review-view')
                        ]),
                ])->columnSpanFull(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\LogbooksRelationManager::class,
            RelationManagers\OutputsRelationManager::class,
            RelationManagers\ReportsRelationManager::class,
            RelationManagers\OutcomesRelationManager::class,
        ];
    }

    // filter proposal milik dosen login
    public static function getEloquentQuery(): Builder
    {
        $lecturerId = Auth::user()->lecturer->id ?? null;
        if (is_null($lecturerId)) {
            return parent::getEloquentQuery()->whereRaw('1 = 0');
        }
        return parent::getEloquentQuery()->where('lecturer_id', $lecturerId);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProposals::route('/'),
            'create' => Pages\CreateProposal::route('/create'),
            'edit'   => Pages\EditProposal::route('/{record}/edit'),
            'view'   => Pages\ViewProposal::route('/{record}'),
            // halaman tab
            'manageLogbooks' => Pages\ManageLogbooks::route('/{record}/logbooks'),
            'manageOutputs'  => Pages\ManageOutputs::route('/{record}/outputs'),
            'manageReports'  => Pages\ManageReports::route('/{record}/reports'),
            'manageOutcomes' => Pages\ManageOutcomes::route('/{record}/outcomes'),
        ];
    }
}
