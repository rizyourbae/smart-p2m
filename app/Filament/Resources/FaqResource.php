<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Filament\Resources\FaqResource\RelationManagers;
use App\Models\Faq;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;

class FaqResource extends Resource
{
    protected static ?string $model = Faq::class;

    public static function getNavigationLabel(): string
    {
        return 'FAQ';
    }

    public static function getPluralLabel(): string
    {
        return 'Data FAQ';
    }

    protected static ?string $navigationGroup = 'Landing Page';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('question')
                    ->label('Pertanyaan')
                    ->required()
                    ->columnSpan(2)
                    ->placeholder('Masukkan pertanyaan'),
                RichEditor::make('answer')
                    ->label('Jawaban')
                    ->required()
                    ->columnSpan(2)
                    ->placeholder('Masukkan jawaban'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('No')
                    ->rowIndex(),
                TextColumn::make('question')
                    ->label('Pertanyaan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('answer')
                    ->label('Jawaban')
                    ->searchable()
                    ->limit(50)
                    ->sortable()
                    ->formatStateUsing(fn($state) => strip_tags($state)),
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
            ->emptyStateHeading('Tidak ada data')
            ->emptyStateDescription('Silahkan masukkan FAQ baru')
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
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}
