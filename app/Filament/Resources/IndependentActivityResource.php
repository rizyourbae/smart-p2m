<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IndependentActivityResource\Pages;
use App\Filament\Resources\IndependentActivityResource\RelationManagers;
use App\Models\IndependentActivity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

// --- Imports untuk Tabel ---
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

// --- Imports untuk Form ---
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\ActionGroup;

class IndependentActivityResource extends Resource
{
    protected static ?string $model = IndependentActivity::class;

    // --- Pengaturan Tampilan Navigasi ---
    protected static ?string $navigationLabel = 'Kegiatan Mandiri';
    protected static ?string $modelLabel = 'Kegiatan Mandiri Dosen';
    protected static ?string $pluralModelLabel = 'Kegiatan Mandiri Dosen';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?int $navigationSort = 2; // Urutan setelah Publikasi

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Kegiatan')
                    ->schema([
                        Select::make('lecturer_id')
                            ->relationship('lecturer', 'nama')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->label('Pilih Dosen'),

                        TextInput::make('tahun_pelaksanaan')
                            ->label('Tahun Pelaksanaan')
                            ->numeric()
                            ->required(),

                        TextInput::make('jenis')
                            ->label('Jenis Kegiatan')
                            ->helperText('Contoh: Pengabdian, Penelitian, Seminar, dll.')
                            ->required(),

                        Textarea::make('judul')
                            ->label('Judul Kegiatan')
                            ->required()
                            ->columnSpanFull(),

                        Textarea::make('anggota')
                            ->label('Anggota Terlibat')
                            ->helperText('Jika anggota lebih dari satu, pisahkan dengan koma.')
                            ->columnSpanFull(),

                        Textarea::make('resume')
                            ->label('Resume Singkat Kegiatan')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Detail Pelaksanaan & Pendanaan')
                    ->schema([
                        TextInput::make('pelaksana_kegiatan')
                            ->label('Unit Pelaksana Kegiatan'),
                        TextInput::make('mitra_kolaborasi')
                            ->label('Mitra Kolaborasi'),
                        TextInput::make('sumber_dana')
                            ->label('Sumber Dana'),
                        TextInput::make('besaran_dana')
                            ->label('Besaran Dana')
                            ->numeric()
                            ->prefix('Rp'),
                    ])->columns(2),
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
                    ->label('Judul Kegiatan')
                    ->searchable()
                    ->wrap(),

                TextColumn::make('lecturer.nama')
                    ->label('Nama Dosen')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jenis')
                    ->label('Jenis')
                    ->badge()
                    ->searchable(),

                TextColumn::make('tahun_pelaksanaan')
                    ->label('Tahun')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('jenis')
                    ->options([
                        'Pengabdian' => 'Pengabdian',
                        'Penelitian' => 'Penelitian',
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
            'index' => Pages\ListIndependentActivities::route('/'),
            'create' => Pages\CreateIndependentActivity::route('/create'),
            'edit' => Pages\EditIndependentActivity::route('/{record}/edit'),
            'view' => Pages\ViewIndependentActivity::route('/{record}'),
        ];
    }
}
