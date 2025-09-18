<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InformationResource\Pages;
use App\Filament\Resources\InformationResource\RelationManagers;
use App\Models\Information;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;

class InformationResource extends Resource
{
    protected static ?string $model = Information::class;

    public static function getNavigationLabel(): string
    {
        return 'Pengumuman';
    }

    public static function getPluralLabel(): string
    {
        return 'Data Pengumuman';
    }

    protected static ?string $navigationGroup = 'Landing Page';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Isi Pengumuman')
                    ->required()
                    ->placeholder('Masukkan isi pengumuman'),
                TextInput::make('no_surat')
                    ->label('No. Surat')
                    ->required()
                    ->placeholder('Masukkan no. surat'),
                FileUpload::make('document')
                    ->label('Dokumen Pendukung')
                    ->disk('public')
                    ->directory('documents/information')
                    ->required()
                    ->placeholder('Unggah Dokumen'),
                PdfViewerField::make('document')
                    ->label('Dokumen')
                    ->minHeight('40svh'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('No')
                    ->rowIndex(),
                TextColumn::make('title')
                    ->label('Isi Pengumuman')
                    ->limit(20)
                    ->sortable()
                    ->searchable(),
                TextColumn::make('no_surat')
                    ->label('No. Surat')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('document')
                    ->label('Dokumen Pendukung')
                    ->url(
                        fn(Information $record): ?string =>
                        $record->document ? asset('storage/' . $record->document) : null
                    )
                    ->openUrlInNewTab()
                    ->html() // Izinkan HTML
                    ->formatStateUsing(fn() => '📄 Lihat Dokumen')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d F Y')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
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
            ->emptyStateHeading('Tidak ada data Pengumuman')
            ->emptyStateDescription('Silahkan masukkan pengumuman terbaru')
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInformation::route('/'),
            'create' => Pages\CreateInformation::route('/create'),
            'edit' => Pages\EditInformation::route('/{record}/edit'),
        ];
    }
}
