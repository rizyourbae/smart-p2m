<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\RequiredDocumentResource\Pages;
use App\Filament\User\Resources\RequiredDocumentResource\RelationManagers;
use App\Models\RequiredDocument;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Joaopaulolndev\FilamentPdfViewer\Forms\Components\PdfViewerField;

class RequiredDocumentResource extends Resource
{
    protected static ?string $model = RequiredDocument::class;

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

                PdfViewerField::make('documents')
                    ->label('Dokumen')
                    ->minHeight('40svh')
                    ->columnSpan('full')
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
                        fn(RequiredDocument $record): ?string =>
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
            ->emptyStateDescription('Unggah dokumen sesuai jenisnya');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('lecturer_id', Auth::user()->lecturer->id ?? null);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRequiredDocuments::route('/'),
            'create' => Pages\CreateRequiredDocument::route('/create'),
            'edit' => Pages\EditRequiredDocument::route('/{record}/edit'),
        ];
    }
}
