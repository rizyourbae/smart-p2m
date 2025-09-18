<?php

namespace App\Filament\Resources\ProposalResource\Pages;

use App\Models\Proposal;
use App\Filament\Resources\ProposalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListProposals extends ListRecords
{
    protected static string $resource = ProposalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    // --- [INI BAGIAN UTAMANYA] ---
    // Tambahkan method ini untuk membuat tab
    public function getTabs(): array
    {
        return [
            'semua' => Tab::make('Semua Proposal')
                ->badge(Proposal::query()->count()),

            'proposal_masuk' => Tab::make('Proposal Masuk')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', 'diajukan'))
                ->badge(Proposal::query()->where('status', 'diajukan')->count())
                ->badgeColor('gray'),

            'dalam_proses' => Tab::make('Dalam Proses')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereIn('status', ['dalam_penilaian', 'menunggu_keputusan', 'revisi']))
                ->badge(Proposal::query()->whereIn('status', ['dalam_penilaian', 'menunggu_keputusan', 'revisi'])->count())
                ->badgeColor('warning'),

            'keputusan_final' => Tab::make('Keputusan Final')
                ->modifyQueryUsing(fn(Builder $query) => $query->whereIn('status', ['diterima', 'ditolak']))
                ->badge(Proposal::query()->whereIn('status', ['diterima', 'ditolak'])->count())
                ->badgeColor('success'),
        ];
    }
}
