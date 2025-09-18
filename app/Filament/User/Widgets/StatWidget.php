<?php

namespace App\Filament\User\Widgets;

use App\Models\Publication;
use App\Models\IndependentActivity;
use App\Models\Proposal;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatWidget extends BaseWidget
{
    protected static ?int $sort = 2;
    protected function getStats(): array
    {
        // 1. Ambil model Lecturer yang terhubung dengan User yang sedang login
        $lecturer = Auth::user()->lecturer;

        // 2. Safety check: Jika user tidak punya relasi ke data dosen, jangan tampilkan apa-apa
        if (!$lecturer) {
            return [];
        }

        // 3. Sekarang, semua hitungan akan difilter berdasarkan ID dosen ini
        return [
            Stat::make('Proposal Perlu Revisi', Proposal::where('lecturer_id', $lecturer->id)->where('status', 'revisi')->count())
                ->description('Proposal yang dikembalikan & butuh tindakan Anda')
                ->descriptionIcon('heroicon-m-arrow-uturn-left', IconPosition::Before)
                // Beri warna mencolok agar langsung terlihat
                ->color('danger'),

            Stat::make('Proposal Dalam Proses', Proposal::where('lecturer_id', $lecturer->id)->whereIn('status', ['diajukan', 'dalam_penilaian', 'menunggu_keputusan'])->count())
                ->description('Proposal Anda yang sedang aktif berjalan')
                ->descriptionIcon('heroicon-m-clock', IconPosition::Before)
                ->color('warning'),

            Stat::make('Proposal Diterima', Proposal::where('lecturer_id', $lecturer->id)->where('status', 'diterima')->count())
                ->description('Jumlah proposal Anda yang berhasil disetujui')
                ->descriptionIcon('heroicon-m-trophy', IconPosition::Before) // Ikon piala untuk pencapaian
                ->color('success'),

            Stat::make('PUBLIKASI SAYA', Publication::where('lecturer_id', $lecturer->id)->count())
                ->description('Jumlah publikasi pribadi Anda')
                ->descriptionIcon('heroicon-m-document-text', IconPosition::Before)
                ->color('info'),

            Stat::make('KEGIATAN MANDIRI SAYA', IndependentActivity::where('lecturer_id', $lecturer->id)->count())
                ->description('Jumlah kegiatan mandiri pribadi Anda')
                ->descriptionIcon('heroicon-m-sparkles', IconPosition::Before) // Ganti ikon agar bervariasi
                ->color('success'),

            Stat::make('PROPOSAL SAYA', Proposal::where('lecturer_id', $lecturer->id)->count())
                ->description('Jumlah pengajuan proposal pribadi Anda')
                ->descriptionIcon('heroicon-m-clipboard-document-list', IconPosition::Before) // Ganti ikon agar bervariasi
                ->color('warning')
        ];
    }
}
