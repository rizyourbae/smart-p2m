<?php

namespace App\Filament\Reviewer\Resources;

use App\Filament\Reviewer\Resources\InformationResource\Pages;
use App\Filament\Reviewer\Resources\InformationResource\RelationManagers;
use App\Models\Information;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InformationResource extends Resource
{
    protected static ?string $model = Information::class;

    protected static ?string $navigationLabel = 'Pengumuman';
    protected static ?string $modelLabel = 'Pengumuman';
    protected static ?string $pluralModelLabel = 'Pengumuman';
    protected static ?string $navigationGroup = 'Informasi';
    protected static ?int $navigationSort = 1;

    public static function canCreate(): bool
    {
        // User tidak boleh membuat data baru
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_surat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('document')
                    ->required()
                    ->maxLength(255),
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
                    ->limit(30)
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Tanggal Pengumuman')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('document')
                    ->label('File')
                    ->url(
                        fn(Information $record): ?string =>
                        $record->document ? asset('storage/' . $record->document) : null
                    )
                    ->openUrlInNewTab()
                    ->html() // Izinkan HTML
                    ->formatStateUsing(fn() => '📄 Lihat Dokumen')
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->searchable(),

            ])
            ->filters([
                //
            ])
            ->actions([])
            ->bulkActions([]);
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
        ];
    }
}
