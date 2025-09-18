<?php

namespace App\Filament\Reviewer\Resources\ProposalResource\Pages;

use App\Filament\Reviewer\Resources\ProposalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;

class ListProposals extends ListRecords
{
    protected static string $resource = ProposalResource::class;

    protected static ?string $title = 'Daftar Penilaian Isi Proposal';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getSubheading(): ?string
    {
        return 'Silahkan pilih proposal yang akan dinilai isinya.';
    }
    public function getTabs(): array
    {
        // Asumsi user yang login adalah reviewer itu sendiri
        $reviewerId = Auth::id();

        return [
            'semua' => Tab::make('Semua Tugas'),

            'perlu_dinilai' => Tab::make('Perlu Dinilai')
                ->modifyQueryUsing(function (Builder $query) use ($reviewerId) {
                    // Cari proposal yang punya relasi 'reviews' dimana reviewer_id adalah ID kita
                    // DAN status review-nya BUKAN 'selesai'
                    $query->whereHas('reviews', function (Builder $subQuery) use ($reviewerId) {
                        $subQuery->where('reviewer_id', $reviewerId)
                            ->where('status', '!=', 'selesai');
                    });
                })
                ->badge(
                    Proposal::whereHas('reviews', function (Builder $subQuery) use ($reviewerId) {
                        $subQuery->where('reviewer_id', $reviewerId)
                            ->where('status', '!=', 'selesai');
                    })->count()
                )
                ->badgeColor('warning'),

            'sudah_dinilai' => Tab::make('Sudah Dinilai')
                ->modifyQueryUsing(function (Builder $query) use ($reviewerId) {
                    // Cari proposal yang punya relasi 'reviews' dimana reviewer_id adalah ID kita
                    // DAN status review-nya ADALAH 'selesai'
                    $query->whereHas('reviews', function (Builder $subQuery) use ($reviewerId) {
                        $subQuery->where('reviewer_id', $reviewerId)
                            ->where('status', 'selesai');
                    });
                })
                ->badge(
                    Proposal::whereHas('reviews', function (Builder $subQuery) use ($reviewerId) {
                        $subQuery->where('reviewer_id', $reviewerId)
                            ->where('status', 'selesai');
                    })->count()
                )
                ->badgeColor('success'),
        ];
    }
}
