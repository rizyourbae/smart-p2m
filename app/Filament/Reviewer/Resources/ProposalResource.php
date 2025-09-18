<?php

namespace App\Filament\Reviewer\Resources;

use App\Filament\Reviewer\Resources\ProposalResource\Pages;
use App\Filament\Reviewer\Resources\ProposalResource\RelationManagers;
use App\Models\Proposal;
use App\Models\Review;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ProposalResource extends Resource
{
    protected static ?string $model = Proposal::class;
    protected static ?string $navigationLabel = 'Proposal';
    protected static ?string $navigationGroup = 'Reviewer';
    protected static ?string $pluralModelLabel = 'Ajuan Proposal';

    // --- [KUNCI UTAMA] ---
    // Method ini memastikan reviewer hanya melihat proposal yang ditugaskan kepadanya.
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereHas('reviewers', function (Builder $query) {
            $query->where('reviewer_id', Auth::guard('reviewer')->id());
        });
    }
    public static function canCreate(): bool
    {
        // Reviewer tidak bisa membuat proposal.
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
                TextColumn::make('judul_usulan')
                    ->label('Judul')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('klaster_bantuan')
                    ->label('Klaster')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('lecturer.nama')
                    ->label('Pengusul')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('lecturer.study_program')
                    ->label('Program Studi')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('total_nilai_proposal')
                    ->label('Skor Proposal')
                    ->state(function (Proposal $record): ?string {
                        // Cari review spesifik dari reviewer yang sedang login untuk proposal ini
                        $review = $record->reviews()
                            ->where('reviewer_id', auth('reviewer')->id())
                            ->first();

                        // Jika review dan skornya ada, tampilkan. Jika tidak, tampilkan strip.
                        return $review?->total_nilai_proposal ? number_format($review->total_nilai_proposal, 2) : '-';
                    }),
                TextColumn::make('total_nilai_presentasi')
                    ->label('Skor Presentasi')
                    ->state(function (Proposal $record): ?string {
                        // Cari review spesifik dari reviewer yang sedang login untuk proposal ini
                        $review = $record->reviews()
                            ->where('reviewer_id', auth('reviewer')->id())
                            ->first();

                        // Jika review dan skornya ada, tampilkan. Jika tidak, tampilkan strip.
                        return $review?->total_nilai_presentasi ? number_format($review->total_nilai_presentasi, 2) : '-';
                    }),
                TextColumn::make('status')
                    ->badge()
                    // [LANGKAH 1] Atur warna badge sesuai dengan semua status baru kita
                    ->color(fn(string $state): string => match ($state) {
                        'draft' => 'gray',
                        'diajukan' => 'gray',
                        'dalam_penilaian' => 'warning',
                        'menunggu_keputusan' => 'info',
                        'revisi' => 'warning',
                        'diterima' => 'success',
                        'ditolak' => 'danger',
                        default => 'gray',
                    })
                    // [LANGKAH 2] Ubah format tampilan teksnya
                    ->formatStateUsing(function (string $state): string {
                        // Ganti underscore (_) dengan spasi
                        $formattedState = str_replace('_', ' ', $state);
                        // Ubah setiap kata menjadi huruf kapital di depan
                        return ucwords($formattedState);
                    })
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tombol ini akan mengarahkan ke halaman penilaian kustom kita nanti
                Action::make('review')
                    ->label('Beri Penilaian')
                    ->icon('heroicon-o-pencil-square')
                    ->url(fn(Proposal $record): string => Pages\ReviewProposal::getUrl(['record' => $record])),
            ])
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
            'index' => Pages\ListProposals::route('/'),
            'review' => Pages\ReviewProposal::route('/{record}/review'),
        ];
    }
}
