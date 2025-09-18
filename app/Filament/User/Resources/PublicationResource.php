<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\PublicationResource\Pages;
use App\Models\Publication;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\ActionGroup;

class PublicationResource extends Resource
{
    protected static ?string $model = Publication::class;
    protected static ?string $navigationGroup = 'Peneliti';
    public static function getPluralLabel(): string
    {
        return 'Daftar Publikasi';
    }
    public static function getNavigationLabel(): string
    {
        return 'Publikasi';
    }
    protected static ?int $navigationSort = 1;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('jenis')
                    ->label('Jenis Publikasi')
                    ->options([
                        'Artikel' => 'Artikel',
                        'Buku' => 'Buku',
                    ])
                    ->required()
                    ->live(),
                TextInput::make('judul')
                    ->label('Judul')
                    ->required(),

                TextInput::make('penulis')
                    ->required(),
                // Grid dinamis berdasarkan jenis
                Grid::make()
                    ->schema(function (Forms\Get $get) {
                        return match ($get('jenis')) {
                            'Artikel' => [
                                TextInput::make('nama_jurnal')
                                    ->required(),
                                TextInput::make('jurnal_link')
                                    ->label('Link Jurnal')
                                    ->url()
                                    ->required(),
                            ],
                            'Buku' => [
                                TextInput::make('nomor_ISBN')
                                    ->required(),
                                TextInput::make('penerbit')
                                    ->required(),
                            ],
                            default => [],
                        };
                    }),
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
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->openUrlInNewTab(false),
                TextColumn::make('jenis')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Artikel' => 'info',
                        'Buku' => 'success',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nama_jurnal')
                    ->url(fn(?Publication $record): ?string => $record?->jurnal_link)
                    ->openUrlInNewTab()
                    ->searchable()
                    ->visible(fn(?Publication $record): bool => $record?->jenis === 'Artikel'),
                TextColumn::make('penerbit')
                    ->visible(fn($record) => $record?->jenis === 'Buku'),
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
            ->emptyStateHeading('Tidak ada data Publikasi')
            ->emptyStateDescription('Silahkan masukkan publikasi yang pernah dikerjakan');
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('lecturer_id', Auth::user()?->lecturer?->id ?? 0);
    }
}
