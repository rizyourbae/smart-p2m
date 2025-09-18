<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PublicationResource\Pages;
use App\Filament\Resources\PublicationResource\RelationManagers;
use App\Models\Publication;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\ActionGroup;

class PublicationResource extends Resource
{
    protected static ?string $model = Publication::class;
    protected static ?string $navigationLabel = 'Publikasi';
    protected static ?string $modelLabel = 'Publikasi Dosen';
    protected static ?string $pluralModelLabel = 'Publikasi Dosen';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Utama')
                    ->schema([
                        Select::make('lecturer_id')
                            // DIUBAH DI SINI: dari 'name' menjadi 'nama'
                            ->relationship('lecturer', 'nama')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->label('Pilih Dosen'),

                        Radio::make('jenis')
                            ->label('Jenis Publikasi')
                            ->options([
                                'Artikel' => 'Artikel',
                                'Buku' => 'Buku',
                            ])
                            ->required()
                            ->live(),

                        Textarea::make('judul')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('penulis')
                            ->helperText('Jika penulis lebih dari satu, pisahkan dengan koma.'),
                    ])->columns(2),

                Section::make('Detail Artikel')
                    ->schema([
                        TextInput::make('nama_jurnal'),
                        TextInput::make('jurnal_link')
                            ->label('Link Artikel/Jurnal')
                            ->url(),
                    ])
                    ->visible(fn($get) => $get('jenis') === 'Artikel'),

                Section::make('Detail Buku')
                    ->schema([
                        TextInput::make('nomor_ISBN')
                            ->label('Nomor ISBN'),
                        TextInput::make('penerbit'),
                    ])
                    ->visible(fn($get) => $get('jenis') === 'Buku'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('No')
                    ->rowIndex(),

                TextColumn::make('judul')
                    ->label('Judul Publikasi')
                    ->searchable()
                    ->wrap(),

                TextColumn::make('jenis')
                    ->label('Jenis')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Artikel' => 'primary',
                        'Buku' => 'success',
                        default => 'gray',
                    })
                    ->searchable(),

                // DIUBAH DI SINI: dari 'lecturer.name' menjadi 'lecturer.nama'
                TextColumn::make('lecturer.nama')
                    ->label('Nama Dosen')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nama_jurnal')
                    ->label('Jurnal')
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: false),

                TextColumn::make('penerbit')
                    ->label('Penerbit')
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('jenis')
                    ->options([
                        'Artikel' => 'Artikel',
                        'Buku' => 'Buku',
                    ])
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                ])
                    ->label('Opsi') // Mengubah label default jika tidak pakai ikon
                    ->icon('heroicon-m-cog-8-tooth') // Mengganti ikon
                    ->tooltip('Klik untuk melihat opsi lainnya') // Menambahkan tooltip
                    ->color('primary') // Mengubah warna tombol
                    ->button()
                    ->size('sm'), // Mengubah ukuran tombol
            ])
            ->emptyStateHeading('Tidak ada data Publikasi')
            ->emptyStateDescription('Silahkan masukkan publikasi yang pernah dikerjakan')
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
            'index' => Pages\ListPublications::route('/'),
            'create' => Pages\CreatePublication::route('/create'),
            'edit' => Pages\EditPublication::route('/{record}/edit'),
            'view' => Pages\ViewPublication::route('/{record}'),
        ];
    }
}
