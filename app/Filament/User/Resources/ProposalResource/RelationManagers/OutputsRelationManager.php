<?php

namespace App\Filament\User\Resources\ProposalResource\RelationManagers;

use Filament\Forms\Form;
use App\Models\ProposalOutput;
use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;

class OutputsRelationManager extends RelationManager
{
    protected static string $relationship = 'outputs';
    protected static ?string $title = 'Outputs';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('type_outputs')
                    ->label('Jenis Dokumen')
                    ->options([
                        'file_hki'               => 'HKI',
                        'file_laporan_lengkap'   => 'Laporan Riset Lengkap',
                        'file_draft_artikel'     => 'Draft Artikel',
                        'file_dummy_buku'        => 'Dummy Buku',
                        'file_doc_kemanfaatan'   => 'Dokumen Kemanfaatan',
                        'file_executive_summary' => 'Executive Summary',
                    ])
                    ->required()
                    ->disabledOn('edit'),

                FileUpload::make('documents_outputs')
                    ->label('Unggah Dokumen')
                    ->disk('public')
                    ->directory('documents/outputs')
                    ->required()
                    ->downloadable()
                    ->openable()
                    ->preserveFilenames(),

                PdfViewerField::make('documents_outputs')
                ->label('Dokumen')
                ->columnSpan('full')
                ->minHeight('40svh')
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Berkas Luaran')
            ->recordTitleAttribute('output')
            ->columns([
                TextColumn::make('index')
                    ->label('No')
                    ->rowIndex(),

                TextColumn::make('type_outputs')
                    ->label('Nama Luaran')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'file_hki'               => 'HKI',
                        'file_laporan_lengkap'   => 'Laporan Riset Lengkap',
                        'file_draft_artikel'     => 'Draft Artikel',
                        'file_dummy_buku'        => 'Dummy Buku',
                        'file_doc_kemanfaatan'   => 'Dokumen Kemanfaatan',
                        'file_executive_summary' => 'Executive Summary',
                    })
                    ->sortable()
                    ->searchable(),

                TextColumn::make('documents_outputs')
                    ->label('Berkas Terunggah')
                    ->url(
                        fn(ProposalOutput $record): ?string =>
                        $record->documents_outputs ? asset('storage/' . $record->documents_outputs) : null
                    )
                    ->formatStateUsing(fn($state) => $state ? '📄 Lihat Dokumen' : 'Tidak Ada Dokumen')
                    ->badge()               // tampil seperti tombol/badge
                    ->color('primary')
                    ->html()
                    ->openUrlInNewTab()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tombol “Kelola Outputs” di header tab
                Tables\Actions\CreateAction::make()
                    ->label('Tambah')
                    ->icon('heroicon-m-plus-circle')
                    ->modalHeading('Tambah')
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
            // Supaya tombol tetap muncul saat belum ada data
            ->emptyStateHeading('Belum ada output')
            ->emptyStateDescription('Buat Output untuk mulai menambah outputs.')
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
