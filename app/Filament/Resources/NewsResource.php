<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\News;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    public static function getNavigationLabel(): string
    {
        return 'Berita';
    }

    public static function getPluralLabel(): string
    {
        return 'Data Berita';
    }

    protected static ?string $navigationGroup = 'Landing Page';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Judul Berita')
                    ->required()
                    ->placeholder('Masukkan judul berita'),

                TextInput::make('category')
                    ->label('Kategori')
                    ->required()
                    ->placeholder('Masukkan kategori berita'),

                TextInput::make('author')
                    ->label('Penulis')
                    ->required()
                    ->placeholder('Masukkan nama penulis'),

                FileUpload::make('image')
                    ->label('Gambar Berita')
                    ->disk('public')
                    ->directory('documents/berita')
                    ->required(),

                RichEditor::make('content')
                    ->columnSpan(2)
                    ->required()
                    ->label('Isi Berita'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Gambar Berita')
                    ->width(100)
                    ->height(100)
                    ->circular()
                    ->toggleable(),
                TextColumn::make('title')
                    ->label('Judul Berita')
                    ->limit(20)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('author')
                    ->label('Penulis')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d F Y - H:i')
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
            ->emptyStateHeading('Tidak ada data Berita')
            ->emptyStateDescription('Silahkan masukkan berita terbaru')
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
