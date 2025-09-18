<?php

namespace App\Filament\Reviewer\Widgets;

use App\Filament\Reviewer\Resources\ProposalResource;
use App\Models\Proposal;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;

class ReviewerTasks extends BaseWidget
{
    protected static ?string $heading = 'Daftar Tugas Penilaian';
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            // Query proposal yang punya review untuk kita & belum selesai
            ->query(
                Proposal::query()
                    ->whereHas(
                        'reviews',
                        fn(Builder $query) =>
                        $query->where('reviewer_id', Auth::id())
                            ->where('status', '!=', 'selesai')
                    )
            )
            ->columns([
                TextColumn::make('judul_usulan')
                    ->label('Judul Proposal')
                    ->limit(60)
                    ->wrap(),

                TextColumn::make('klaster_bantuan')
                    ->label('Klaster'),

                // Tampilkan tahapan review kita saat ini untuk proposal tsb
                TextColumn::make('reviews.tahapan_review')
                    ->label('Tahapan Anda Saat Ini')
                    ->badge(),
            ])
            ->actions([
                Action::make('start_review')
                    ->label('Lanjutkan Penilaian')
                    ->icon('heroicon-o-arrow-right-circle')
                    // Arahkan ke halaman penilaian proposal
                    ->url(fn(Proposal $record): string =>
                    ProposalResource::getUrl('review', ['record' => $record])),
            ])
            ->paginated(false);
    }
}
