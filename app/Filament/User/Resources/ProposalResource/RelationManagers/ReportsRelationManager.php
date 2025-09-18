<?php

namespace App\Filament\User\Resources\ProposalResource\RelationManagers;

use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section as InfolistSection;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;
use Joaopaulolndev\FilamentPdfViewer\Infolists\Components\PdfViewerEntry;

class ReportsRelationManager extends RelationManager
{
    protected static string $relationship = 'reports';

    protected static ?string $title = 'Laporan & Keuangan';

    public function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('Laporan')
                ->tabs([
                    Tabs\Tab::make('Laporan Antara / Progress')
                        ->schema([
                            Select::make('report_type')
                                ->label('Jenis Dokumen')
                                ->options([
                                    'laporan_antara'  => 'Laporan Antara',
                                ])
                                ->required()
                                ->disabledOn('edit')
                                ->required()
                                ->validationMessages(['required' => 'Judul Tidak Boleh Kosong']),

                            FileUpload::make('file_path')
                                ->label('Berkas Tersimpan')
                                ->disk('public')
                                ->directory('documents/laporan/progress')
                                ->downloadable()
                                ->openable()
                                ->preserveFilenames()
                                ->acceptedFileTypes([
                                    'application/pdf',
                                    'image/png',
                                    'image/jpeg'
                                ]),

                            PdfViewerField::make('file_path')
                                ->label('Dokumen')
                                ->minHeight('40svh'),
                        ]),

                    Tabs\Tab::make('Laporan Keuangan Sementara')
                        ->schema([

                            Select::make('report_type')
                                ->label('Jenis Dokumen')
                                ->options([
                                    'laporan_keuangan_sementara'  => 'Laporan Keuangan Sementara',
                                ])
                                ->required()
                                ->disabledOn('edit')
                                ->validationMessages(messages: ['required' => 'Wajib Dipilih']),

                            FileUpload::make('file_path_2')
                                ->label('Laporan Keuangan Sementara')
                                ->disk('public')
                                ->directory('documents/laporan/keuangan')
                                ->downloadable()
                                ->openable()
                                ->required()
                                ->validationMessages(['required' => 'Tidak Boleh Kosong'])
                                ->preserveFilenames()
                                ->acceptedFileTypes([
                                    'application/pdf',
                                    'image/png',
                                    'image/jpeg'
                                ]),

                            PdfViewerField::make('file_path_2')
                                ->label('Dokumen')
                                ->minHeight('40svh'),
                        ]),

                    Tabs\Tab::make('Laporan Akhir')
                        ->schema([
                            // First file upload
                            FileUpload::make('file_path_3')
                                ->label('Laporan Keuangan')
                                ->disk('public')
                                ->directory('documents/laporan/final')
                                ->downloadable()
                                ->openable()
                                ->preserveFilenames()
                                ->acceptedFileTypes(['application/pdf', 'image/png', 'image/jpeg'])
                                ->required()
                                ->validationMessages(['required' => 'Tidak Boleh Kosong']),

                            PdfViewerField::make('file_path_3')
                                ->label('Dokumen Laporan Keuangan')
                                ->minHeight('40svh'),

                            // First file upload
                            FileUpload::make('file_path_4')
                                ->label('Laporan Akademik')
                                ->disk('public')
                                ->directory('documents/laporan/final')
                                ->downloadable()
                                ->openable()
                                ->preserveFilenames()
                                ->acceptedFileTypes(['application/pdf', 'image/png', 'image/jpeg'])
                                ->required()
                                ->validationMessages(['required' => 'Tidak Boleh Kosong']),

                            PdfViewerField::make('file_path_4')
                                ->label('Dokumen Laporan Akademik')
                                ->minHeight('40svh')
                        ])
                ])
                ->columnSpanFull(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Berkas Laporan Kegiatan')
            ->recordTitleAttribute('reports')
            ->columns([

                TextColumn::make('total_pengajuan_dana')
                    ->label('Usulan Biaya')
                    ->money('IDR')
                    ->tooltip('Klik baris ini untuk melihat detail.')
                    ->sortable()
                    ->state(function (Model $record): ?float {
                        // $record adalah ProposalReport
                        // Ambil dari relasi proposal
                        return $record->proposal?->total_pengajuan_dana ?? 0;
                    }),

                TextColumn::make('rekomendasi_biaya') // Beri nama unik
                    ->label('Biaya Disetujui')
                    ->money('IDR')
                    ->tooltip('Klik baris ini untuk melihat detail.')
                    ->state(function (Model $record): ?float {
                        return $record->proposal?->reviews()->first()?->rekomendasi_biaya ?? 0;
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah')
                    ->icon('heroicon-m-plus-circle')
                    ->modalHeading('Tambah')
                    ->createAnother(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                ActionGroup::make([
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
            ->emptyStateHeading('Tidak ada data yang ditemukan')
            ->emptyStateDescription('Buat Laporan untuk memulai.');
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->record($infolist->getRecord())
            ->schema([
                InfolistSection::make('Laporan Antara / Progress')
                    ->schema([
                        TextEntry::make('file_path')
                            ->label('Berkas Laporan Antara')
                            ->badge()
                            ->url(fn($record) => $record->file_path ? Storage::url($record->file_path) : null, true)
                            ->formatStateUsing(fn($state) => $state ? '📄 UnduhLaporan' : 'Belum diunggah'),

                        PdfViewerEntry::make('file_path')
                            ->label('')
                            ->minHeight('40svh'),
                    ]),

                InfolistSection::make('Laporan Keuangan')
                    ->schema([
                        TextEntry::make('usulan_biaya')
                            ->label('Usulan Biaya Awal')
                            ->money('IDR')
                            ->state(function (Model $record): ?float {
                                // $record adalah ProposalReport
                                // Ambil dari relasi proposal
                                return $record->proposal?->total_pengajuan_dana ?? 0;
                            }),
                        TextEntry::make('rekomendasi_biaya')
                            ->label('Biaya Disetujui Reviewer')
                            ->money('IDR')
                            ->state(function (Model $record): ?float {
                                return $record->proposal?->reviews()->first()?->rekomendasi_biaya ?? 0;
                            }),
                        TextEntry::make('file_path_2')
                            ->label('Berkas Laporan Keuangan Sementara')
                            ->badge()
                            ->url(fn($record) => $record->file_path_2 ? Storage::url($record->file_path_2) : null, true)
                            ->formatStateUsing(fn($state) => $state ? '📄 Unduh/Lihat Laporan' : 'Belum diunggah'),
                    ])->columns(2),

                InfolistSection::make('Laporan Akhir')
                    ->schema([
                        TextEntry::make('file_path_4')
                            ->label('Berkas Laporan Akademik Final')
                            ->badge()
                            ->url(fn($record) => $record->file_path_4 ? Storage::url($record->file_path_4) : null, true)
                            ->formatStateUsing(fn($state) => $state ? '📄 Unduh' : 'Belum diunggah'),
                        PdfViewerEntry::make('file_path_4')
                            ->label('')
                            ->minHeight('40svh')
                            ->ColumnSpanFull(),
                        TextEntry::make('file_path_3')
                            ->label('Berkas Laporan Keuangan Final')
                            ->badge()
                            ->url(fn($record) => $record->file_path_3 ? Storage::url($record->file_path_3) : null, true)
                            ->formatStateUsing(fn($state) => $state ? '📄 Unduh Laporan' : 'Belum diunggah'),
                        PdfViewerEntry::make('file_path_3')
                            ->label('')
                            ->minHeight('40svh')
                            ->ColumnSpanFull(),
                    ])->columns(2),
            ]);
    }
}
