<?php

namespace App\Filament\User\Resources\ProposalResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;

class LogbooksRelationManager extends RelationManager
{
    protected static string $relationship = 'logbooks';

    protected static ?string $title = 'Logbook';

    public function form(Form $form): Form
    {
        return $form->schema([
            DatePicker::make('tanggal')
                ->label('Tanggal')
                ->native(false)
                ->displayFormat('Y-m-d')
                ->required(),

            TextInput::make('tempat')
                ->label('Tempat')
                ->maxLength(150),

            TextInput::make('nama_kegiatan')
                ->label('Nama Kegiatan')
                ->required()
                ->maxLength(200),

            Select::make('teknik')
                ->label('Teknik')
                ->options([
                    'Analisis Dokumen'   => 'Analisis Dokumen',
                    'Diskusi'            => 'Diskusi',
                    'FGD'                => 'FGD',
                    'Observasi'          => 'Observasi',
                    'Penyebaran Angket'  => 'Penyebaran Angket',
                    'Wawancara'          => 'Wawancara',
                    'Lainnya'            => 'Lainnya',
                ])
                ->searchable(),

            Textarea::make('deskripsi')
                ->label('Deskripsi Kegiatan')
                ->rows(4),

            FileUpload::make('file_path')
                ->label('Berkas / File')
                ->disk('public')
                ->directory('documents/logbook')
                ->downloadable()
                ->openable()
                ->preserveFilenames()
                ->acceptedFileTypes([
                    'application/pdf',
                    'application/msword',
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'application/vnd.ms-excel',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'image/png',
                    'image/jpeg',
                ]),

            PdfViewerField::make('file_path')
                ->label('Dokumen Logbook')
                ->columnSpan('full')
                ->minHeight('40svh')
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Logbook Pelaksanaan Bantuan')
            ->recordTitleAttribute('nama_kegiatan')
            ->columns([
                TextColumn::make('index')
                    ->label('No')
                    ->rowIndex(),

                TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('Y-m-d')
                    ->sortable(),

                TextColumn::make('tempat')
                    ->label('Tempat')
                    ->limit(30),

                TextColumn::make('kegiatan_teknik')
                    ->label('Kegiatan (Teknik)')
                    ->state(fn($record) => $record->nama_kegiatan . ($record->teknik ? ' (' . $record->teknik . ')' : ''))
                    ->wrap()
                    ->limit(60),

                TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->wrap()
                    ->limit(80),

                TextColumn::make('file_link')
                    ->label('Berkas')
                    ->state(fn($record) => $record->file_path ? '📄 Lihat berkas' : '—')
                    ->url(function ($record) {
                        if (! $record->file_path) return null;
                        $base = config('filesystems.disks.public.url');
                        return $base
                            ? rtrim($base, '/') . '/' . ltrim($record->file_path, '/')
                            : asset('storage/' . ltrim($record->file_path, '/'));
                    })
                    ->openUrlInNewTab()
                    ->badge()
                    ->color('info')
            ])
            ->defaultSort('tanggal', 'asc')
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Tambah')
                    ->icon('heroicon-m-plus-circle')
                    ->modalHeading('Tambah Logbook')
                    ->createAnother(),
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
            ->emptyStateHeading('Tidak ada data yang ditemukan')
            ->emptyStateDescription('Buat logbook untuk memulai.')
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
