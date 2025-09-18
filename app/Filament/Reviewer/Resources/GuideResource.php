<?php

namespace App\Filament\Reviewer\Resources;

use App\Filament\Reviewer\Resources\GuideResource\Pages;
use App\Filament\Reviewer\Resources\GuideResource\RelationManagers;
use App\Models\Guide;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GuideResource extends Resource
{
    protected static ?string $model = Guide::class;

    protected static ?string $navigationLabel = 'Panduan';
    protected static ?string $modelLabel = 'Panduan';
    protected static ?string $pluralModelLabel = 'Panduan';
    protected static ?string $navigationGroup = 'Informasi';
    protected static ?int $navigationSort = 2;

    public static function canCreate(): bool
    {
        // User tidak boleh membuat data baru
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('No')
                    ->rowIndex(),
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Tanggal Upload')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('file')
                    ->label('File')
                    ->url(
                        fn(Guide $record): ?string =>
                        $record->file ? asset('storage/' . $record->file) : null
                    )
                    ->openUrlInNewTab()
                    ->html()
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
            'index' => Pages\ListGuides::route('/'),
        ];
    }
}
