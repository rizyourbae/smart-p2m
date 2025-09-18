<?php

namespace App\Filament\User\Resources\ProposalResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use App\Models\ProposalOutcomes;
use App\Filament\User\Resources\ProposalResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Filament\Support\Enums\Size;

class OutcomesRelationManager extends RelationManager
{
    protected static string $relationship = 'outcomes';
    protected static ?string $title = 'Outcomes';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('jenis_outcomes')
                    ->label('Jenis Publikasi')
                    ->options([
                        'Artikel Jurnal' => 'Artikel Jurnal',
                        'Buku'           => 'Buku',
                    ])
                    ->required()
                    ->live(),
                TextInput::make('judul_outcomes')
                    ->label('Judul')
                    ->required(),
                // Grid dinamis berdasarkan jenis
                Grid::make()
                    ->schema(function (Forms\Get $get) {
                        return match ($get('jenis_outcomes')) {
                            'Artikel Jurnal' => [
                                TextInput::make('nama_jurnal_fix')
                                    ->label('Nama Jurnal')
                                    ->required(),
                                TextInput::make('volume_jurnal_fix')
                                    ->label('Volume - Nomor Terbitan')
                                    ->required(),
                                TextInput::make('link_jurnal_fix')
                                    ->label('URL Artikel/Jurnal')
                                    ->url()
                                    ->required(),
                            ],
                            'Buku' => [
                                TextInput::make('nomor_isbn_fix')
                                    ->label('Nomor ISBN')
                                    ->required(),
                                TextInput::make('penerbit_buku')
                                    ->label('Penerbit')
                                    ->required(),
                                TextInput::make('tahun_terbit_buku')
                                    ->label('Tahun Terbit')
                                    ->required(),
                            ],
                            default => [],
                        };
                    }),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Publikasi Artikel/Buku')
            ->recordTitleAttribute('hasil_luaran')
            ->columns([
                TextColumn::make('index')
                    ->label('No')
                    ->rowIndex(),

                TextColumn::make('jenis_outcomes')
                    ->label('Jenis')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Artikel Jurnal' => 'info',
                        'Buku' => 'success',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('judul_outcomes')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->openUrlInNewTab(false),
                TextColumn::make('nama_jurnal_fix')
                    ->label('Link Jurnal')
                    ->url(fn(?ProposalOutcomes $record): ?string => $record?->link_jurnal_fix)
                    ->openUrlInNewTab()
                    ->searchable(),
                TextColumn::make('penerbit_buku')
                    ->label('Penerbit')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tombol “Kelola Outcomes” di header tab
                Tables\Actions\CreateAction::make()
                    ->label('Tambah')
                    ->icon('heroicon-m-plus-circle')
                    ->modalHeading('Tambah')
                    ->createAnother(),
            ])
            // Supaya tombol tetap muncul saat belum ada data
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
                    ->size('sm'),
            ])
            ->emptyStateHeading('Belum ada outcomes')
            ->emptyStateDescription('Buat outcomes untuk mulai menambah outcomes.')
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
