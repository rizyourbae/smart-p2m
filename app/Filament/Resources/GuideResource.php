<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuideResource\Pages;
use App\Filament\Resources\GuideResource\RelationManagers;
use App\Models\Guide;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;

class GuideResource extends Resource
{
    protected static ?string $model = Guide::class;

    public static function getNavigationLabel(): string
    {
        return 'Panduan';
    }

    public static function getPluralLabel(): string
    {
        return 'Panduan';
    }

    protected static ?string $navigationGroup = 'Landing Page';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Panduan')
                    ->required()
                    ->placeholder('Masukkan isi panduan'),
                FileUpload::make('file')
                    ->label('Dokumen Panduan')
                    ->disk('public')
                    ->directory('documents/panduan')
                    ->required()
                    ->placeholder('Unggah Dokumen'),
                PdfViewerField::make('file')
                    ->label('Dokumen')
                    ->minHeight('40svh')
                    ->columnSpan('full'),
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
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Tanggal Upload')
                    ->dateTime('d F Y')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('file')
                    ->label('File')
                    ->url(
                        fn(Guide $record): ?string =>
                        $record->file ? asset('storage/' . $record->file) : null
                    )
                    ->openUrlInNewTab()
                    ->html() // Izinkan HTML
                    ->formatStateUsing(fn() => '📄 Lihat Dokumen')
                    ->sortable()
                    ->badge()
                    ->color('info'),
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
            ->emptyStateHeading('Tidak ada data Panduan')
            ->emptyStateDescription('Silahkan masukkan panduan terbaru')
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
            'index' => Pages\ListGuides::route('/'),
            'create' => Pages\CreateGuide::route('/create'),
            'edit' => Pages\EditGuide::route('/{record}/edit'),
        ];
    }
}
