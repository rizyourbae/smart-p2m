<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProposalResource\Pages;
use App\Filament\Resources\ProposalResource\RelationManagers;
use App\Models\Proposal;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section as InfoSection;
use Filament\Infolists\Components\Grid as InfoGrid;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Actions\ActionGroup;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\Tabs\Tab;
use Filament\Infolists\Components\ViewEntry;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class ProposalResource extends Resource
{
    protected static ?string $model = Proposal::class;
    protected static ?string $navigationLabel = 'Proposal';
    protected static ?string $modelLabel = 'Ajuan Proposal';
    protected static ?string $pluralModelLabel = 'Ajuan Proposal';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?int $navigationSort = 3;
    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return true;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('No')
                    ->rowIndex(),
                TextColumn::make('judul_usulan')
                    ->label('Judul Usulan')
                    ->limit(40)
                    ->wrap()
                    ->searchable(),
                // Tampilkan nama dosen yang mengajukan
                TextColumn::make('lecturer.nama')
                    ->label('Pengusul')
                    ->searchable()
                    ->sortable(),
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
                TextColumn::make('created_at')
                    ->label('Tanggal Pengajuan')
                    ->dateTime('d F Y')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'Diajukan' => 'Diajukan',
                        'Sedang Direview' => 'Sedang Direview',
                        'Disetujui' => 'Disetujui',
                        'Ditolak' => 'Ditolak',
                    ])
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make()
                        ->label('Detail Proposal'),
                    Tables\Actions\EditAction::make()
                        ->label('Tunjuk Reviewer'),
                    Tables\Actions\DeleteAction::make()
                        ->label('Hapus'),
                ])
                    ->label('Opsi') // Mengubah label default jika tidak pakai ikon
                    ->icon('bi-gear-fill') // Mengganti ikon
                    ->tooltip('Klik untuk melihat opsi lainnya') // Menambahkan tooltip
                    ->color('primary') // Mengubah warna tombol
                    ->button()
                    ->size('sm'), // Mengubah ukuran tombol
            ])
            ->emptyStateHeading('Belum ada proposal yang sudah dinilai')
            ->emptyStateDescription('Silahkan ajukan proposal yang dinilai');
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
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
                                                ->label('Pengaju')
                                                ->inlineLabel(),
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
                                                ->formatStateUsing(fn($state) => $state ? '📄 Lihat Berkas Similarity' : 'Belum diunggah')
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
                                ->schema([
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
                                    RepeatableEntry::make('lecturers')
                                        ->label('')
                                        ->state(
                                            fn($record): mixed => $record->lecturers
                                                ->map(fn($l) => [
                                                    'jabatan'    => $l->jabatan,
                                                    'nama_dosen' => $l->nama_dosen,
                                                    'nip'        => $l->nip,
                                                    'nidn'       => $l->nidn,
                                                    'institusi'  => $l->institusi,
                                                ])->toArray()
                                        )
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
                                        ->columns(5)
                                        ->visible(fn($record) => $record->lecturers->isNotEmpty()),

                                    TextEntry::make('lecturers_empty')
                                        ->label('')
                                        ->state('Belum ada anggota peneliti')
                                        ->color('gray')
                                        ->visible(fn($record) => $record->lecturers->isEmpty()),
                                ])
                                ->columns(1),

                            // ——— Daftar Mahasiswa ———
                            InfoSection::make('Mahasiswa Pembantu Peneliti')
                                ->icon('heroicon-m-academic-cap')
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
                                ])->columns(1),

                            // ——— Catatan Reviewer (placeholder) ———
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
            RelationManagers\ReviewersRelationManager::class,
            RelationManagers\ReviewsRelationManager::class,
        ];
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProposals::route('/'),
            'view'   => Pages\ViewProposal::route('/{record}'),
            'edit' => Pages\EditProposal::route('/{record}/edit'),
        ];
    }
}
