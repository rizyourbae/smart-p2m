<?php

namespace App\Filament\User\Resources\ProposalResource\Pages;

use App\Filament\User\Resources\ProposalResource;
use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;

class ListProposals extends ListRecords
{
    protected static string $resource = ProposalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Ajukan Proposal')
                ->icon('heroicon-o-document-plus'),
        ];
    }
    protected static ?string $title = 'Daftar Pengajuan Proposal';

    public function getSubheading(): ?string
    {
        return 'Silahkan kelola pengajuan proposal anda disini.';
    }
    public function getTabs(): array
    {
        $lecturerId = Auth::user()->lecturer->id ?? null;

        return [
            'semua' => Tab::make('Semua Proposal')
                ->badge(Proposal::query()->where('lecturer_id', $lecturerId)->count()),

            'draft' => Tab::make('Draft')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('lecturer_id', $lecturerId)->where('status', 'draft'))
                ->badge(Proposal::query()->where('lecturer_id', $lecturerId)->where('status', 'draft')->count())
                ->badgeColor('gray'),

            'dalam_proses' => Tab::make('Dalam Proses')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('lecturer_id', $lecturerId)->whereIn('status', ['diajukan', 'dalam_penilaian', 'menunggu_keputusan']))
                ->badge(Proposal::query()->where('lecturer_id', $lecturerId)->whereIn('status', ['diajukan', 'dalam_penilaian', 'menunggu_keputusan'])->count())
                ->badgeColor('warning'),

            'perlu_revisi' => Tab::make('Perlu Revisi')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('lecturer_id', $lecturerId)->where('status', 'revisi'))
                ->badge(Proposal::query()->where('lecturer_id', $lecturerId)->where('status', 'revisi')->count())
                ->badgeColor('danger'),

            'hasil_akhir' => Tab::make('Hasil Akhir')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('lecturer_id', $lecturerId)->whereIn('status', ['diterima', 'ditolak']))
                ->badge(Proposal::query()->where('lecturer_id', $lecturerId)->whereIn('status', ['diterima', 'ditolak'])->count())
                ->badgeColor('success'),
        ];
    }
}
