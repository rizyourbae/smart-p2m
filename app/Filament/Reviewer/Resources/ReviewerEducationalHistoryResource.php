<?php

namespace App\Filament\Reviewer\Resources;

use App\Filament\Reviewer\Resources\ReviewerEducationalHistoryResource\Pages;
use App\Filament\Reviewer\Resources\ReviewerEducationalHistoryResource\RelationManagers;
use App\Models\ReviewerEducationalHistory;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ReviewerEducationalHistoryResource extends Resource
{
    protected static ?string $model = ReviewerEducationalHistory::class;
    // --- [KUNCI KEAMANAN] ---
    // Method ini memastikan reviewer hanya bisa melihat dan mengelola datanya sendiri
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('reviewer_id', Auth::guard('reviewer')->id());
    }
    public static function getPluralLabel(): string
    {
        return 'Riwayat Pendidikan';
    }
    public static function getNavigationLabel(): string
    {
        return 'Riwayat Pendidikan';
    }
    protected static ?string $navigationGroup = 'Profil';
    protected static ?int $navigationSort = 3;

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
                        fn(ReviewerEducationalHistory $record): ?string =>
                        $record->dokumen_ijazah ? asset('storage/' . $record->dokumen_ijazah) : null
                    )
                    ->formatStateUsing(fn($state) => $state ? '📄 Lihat Dokumen' : 'Tidak Ada Dokumen')
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
            ->emptyStateHeading('Belum ada riwayat pendidikan')
            ->emptyStateDescription('Mohon untuk menambahkan riwayat pendidikan Anda')
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
            'index' => Pages\ListReviewerEducationalHistories::route('/'),
            'create' => Pages\CreateReviewerEducationalHistory::route('/create'),
            'edit' => Pages\EditReviewerEducationalHistory::route('/{record}/edit'),
        ];
    }
}
