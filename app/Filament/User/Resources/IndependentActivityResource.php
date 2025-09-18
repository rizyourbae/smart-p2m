<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\IndependentActivityResource\Pages;
use App\Filament\User\Resources\IndependentActivityResource\RelationManagers;
use App\Models\IndependentActivity;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;

class IndependentActivityResource extends Resource
{
    protected static ?string $model = IndependentActivity::class;
    protected static ?string $navigationGroup = 'Peneliti';
    protected static ?int $navigationSort = 2;
    public static function getPluralLabel(): string
    {
        return 'Kegiatan Mandiri';
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('jenis')
                    ->label('Jenis Kegiatan')
                    ->options([
                        'Penelitian' => 'Penelitian',
                        'Pengabdian' => 'Pengabdian',
                    ])
                    ->placeholder('Masukkan Jenis Penelitian Anda')
                    ->required(),
                TextInput::make('judul')
                    ->label('Judul')
                    ->placeholder('Masukkan Judul Kegiatan')
                    ->required(),
                TextInput::make('anggota')
                    ->label('Anggota')
                    ->placeholder('Masukkan Anggota')
                    ->required(),
                TextInput::make('tahun_pelaksanaan')
                    ->label('Tahun Pelaksanaan')
                    ->placeholder('Masukkan Tahun Pelaksanaan')
                    ->required(),
                Select::make('pelaksana_kegiatan')
                    ->label('Pelaksana Kegiatan')
                    ->options([
                        'Mandiri' => 'Mandiri',
                        'Kolaboratif' => 'Kolaboratif',
                    ])
                    ->placeholder('Masukkan Pelaksana Kegiatan')
                    ->required(),
                TextInput::make('mitra_kolaborasi')
                    ->label('Mitra Kolaborasi')
                    ->placeholder('Masukkan Mitra Kolaborasi')
                    ->required(),
                Select::make('sumber_dana')
                    ->label('Sumber Dana')
                    ->options([
                        'Mandiri' => 'Mandiri',
                        'Hibah (Non-BOPTN)' => 'Hibah (Non-BOPTN)',
                    ])
                    ->placeholder('Masukkan Sumber Dana Anda')
                    ->required(),
                TextInput::make('besaran_dana')
                    ->label('Besaran Dana')
                    ->placeholder('Masukkan Besaran Dana')
                    ->required(),
                RichEditor::make('resume')
                    ->columnSpan(2)
                    ->required()
                    ->label('Resume/Abstrak'),
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
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jenis')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Penelitian' => 'info',
                        'Pengabdian' => 'primary',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),
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
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Tidak ada data Kegiatan Mandiri')
            ->emptyStateDescription('Silahkan masukkan kegiatan yang pernah dikerjakan');
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
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('lecturer_id', Auth::user()?->lecturer?->id ?? 0);
    }
}
