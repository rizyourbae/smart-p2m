<?php

namespace App\Filament\Reviewer\Resources;

use App\Filament\Reviewer\Resources\ReviewerRequiredDocumentResource\Pages;
use App\Filament\Reviewer\Resources\ReviewerRequiredDocumentResource\RelationManagers;
use App\Models\Reviewer;
use App\Models\ReviewerRequiredDocument;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ReviewerRequiredDocumentResource extends Resource
{
    protected static ?string $model = ReviewerRequiredDocument::class;

    public static function getPluralLabel(): string
    {
        return 'Kelengkapan Dokumen';
    }

    public static function getNavigationLabel(): string
    {
        return 'Kelengkapan Dokumen';
    }

    protected static ?string $navigationGroup = 'Profil';

    protected static ?int $navigationSort = 4;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('type')
                    ->label('Jenis Dokumen')
                    ->options([
                        'sertifikat_dosen' => 'Sertifikat Dosen',
                        'sk_jabatan_fungsional' => 'SK Jabatan Fungsional',
                        'kartu_nidn' => 'Kartu NIDN',
                    ])
                    ->required()
                    ->disabledOn('edit'),

                FileUpload::make('documents')
                    ->label('Unggah Dokumen')
                    ->disk('public')
                    ->directory('documents/berkas')
                    ->required()
                    ->downloadable()
                    ->openable()
                    ->preserveFilenames(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('type')
                    ->label('Jenis Dokumen')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'sertifikat_dosen' => 'Sertifikat Dosen',
                        'sk_jabatan_fungsional' => 'SK Jabatan Fungsional',
                        'kartu_nidn' => 'Kartu NIDN',
                    })
                    ->sortable()
                    ->searchable(),

                TextColumn::make('documents')
                    ->label('File')
                    ->url(
                        fn(ReviewerRequiredDocument $record): ?string =>
                        $record->documents ? asset('storage/' . $record->documents) : null
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
                Tables\Actions\EditAction::make(),
            ])
            ->emptyStateHeading('Belum ada dokumen diunggah')
            ->emptyStateDescription('Mohon untuk menambahkan dokumen yang diperlukan')
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('reviewer_id', Auth::guard('reviewer')->id());
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReviewerRequiredDocuments::route('/'),
            'create' => Pages\CreateReviewerRequiredDocument::route('/create'),
            'edit' => Pages\EditReviewerRequiredDocument::route('/{record}/edit'),
        ];
    }
}
