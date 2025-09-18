<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\EducationalHistoryResource\Pages;
use App\Filament\User\Resources\EducationalHistoryResource\RelationManagers;
use App\Models\EducationalHistory;
use App\Models\Lecturer;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;

class EducationalHistoryResource extends Resource
{
    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('lecturer_id', Auth::user()?->lecturer?->id ?? 0);
    }
    protected static ?string $model = EducationalHistory::class;

    protected static ?int $navigationSort = 3;

    public static function getPluralLabel(): string
    {
        return 'Riwayat Pendidikan';
    }
    public static function getNavigationLabel(): string
    {
        return 'Riwayat Pendidikan';
    }
    protected static ?string $navigationGroup = 'Profil';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('jenjang')
                    ->label('Jenjang Pendidikan')
                    ->options([
                        'S1' => 'S1',
                        'S2' => 'S2',
                        'S3' => 'S3',
                    ])
                    ->placeholder('Pilih jenjang pendidikan')
                    ->required(),
                TextInput::make('program_studi')
                    ->label('Program Studi')
                    ->required()
                    ->placeholder('Masukkan program studi'),
                TextInput::make('institusi')
                    ->label('Institusi')
                    ->required()
                    ->placeholder('Masukkan institusi'),
                TextInput::make('tahun_masuk')
                    ->label('Tahun Masuk')
                    ->required()
                    ->placeholder('Masukkan tahun masuk'),
                TextInput::make('tahun_lulus')
                    ->label('Tahun Lulus')
                    ->required()
                    ->placeholder('Masukkan tahun lulus'),
                TextInput::make('ipk')
                    ->label('IPK')
                    ->required()
                    ->placeholder('Masukkan IPK'),
                FileUpload::make('dokumen_ijazah')
                    ->label('Dokumen Ijazah')
                    ->disk('public')
                    ->directory('documents/ijazah')
                    ->required()
                    ->placeholder('Unggah Dokumen Ijazah'),
                PdfViewerField::make('dokumen_ijazah')
                    ->label('Dokumen')
                    ->minHeight('40svh'),
                // Hidden input untuk relasi lecturer_id
                Forms\Components\Hidden::make('lecturer_id')
                    ->default(fn() => Auth::user()?->lecturer?->id ?? null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jenjang')
                    ->label('Jenjang')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('program_studi')
                    ->label('Program Studi')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('institusi')
                    ->label('Institusi')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tahun_masuk')
                    ->label('Tahun Masuk')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tahun_lulus')
                    ->label('Tahun Lulus')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('ipk')
                    ->label('IPK')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('dokumen_ijazah')
                    ->label('Ijazah')
                    ->url(
                        fn(EducationalHistory $record): ?string =>
                        $record->dokumen_ijazah ? asset('storage/' . $record->dokumen_ijazah) : null
                    )
                    ->formatStateUsing(fn($state) => $state ? '📄Lihat Dokumen' : 'Tidak Ada Dokumen')
                    ->html()
                    ->openUrlInNewTab()
                    ->sortable()
                    ->badge()
                    ->color('success')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
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
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('Belum ada riwayat pendidikan')
            ->emptyStateDescription('Mohon untuk menambahkan riwayat pendidikan Anda');
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
            'index' => Pages\ListEducationalHistories::route('/'),
            'create' => Pages\CreateEducationalHistory::route('/create'),
            'edit' => Pages\EditEducationalHistory::route('/{record}/edit'),
        ];
    }
}
