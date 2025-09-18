<?php

namespace App\Filament\Resources\ProposalResource\Pages;

use App\Models\Proposal;
use App\Filament\Resources\ProposalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;

class EditProposal extends EditRecord
{
    protected static string $resource = ProposalResource::class;

    // --- KODE UNTUK MENGAKTIFKAN TABS (Sudah Benar) ---
    public function getRelationTabsVisible(): bool
    {
        return true;
    }

    public function getFormTabLabel(): ?string
    {
        return 'Detail Usulan';
    }
    // --- AKHIR KODE TABS ---

    // --- KODE UNTUK MENGATUR TOMBOL ---
    protected function getHeaderActions(): array
    {
        // Kita mulai dengan array kosong untuk menampung semua tombol
        $actions = [];

        // LOGIKA #1: Tampilkan Grup Aksi Keputusan HANYA JIKA statusnya 'menunggu_keputusan'
        if ($this->record && $this->record->status === 'menunggu_keputusan') {
            $actions[] = Actions\ActionGroup::make([
                Actions\Action::make('terima_proposal')
                    ->label('Terima Proposal')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Proposal $record) {
                        $record->update(['status' => 'diterima']);
                        $userToNotify = $record->lecturer->user;
                        if ($userToNotify) {
                            Notification::make()->title('Selamat! Proposal Anda Diterima')
                                ->success()
                                ->sendToDatabase($userToNotify);
                        }
                        Notification::make()->title('Proposal berhasil diterima')
                            ->success()
                            ->send();
                    }),

                Actions\Action::make('tolak_proposal')
                    ->label('Tolak Proposal')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->form([
                        Textarea::make('alasan_penolakan')->label('Alasan Penolakan')->required(),
                    ])
                    ->action(function (Proposal $record, array $data) {
                        $record->update(['status' => 'ditolak', 'catatan_keputusan' => $data['alasan_penolakan']]);
                        $userToNotify = $record->lecturer->user;
                        //dd('User yang akan dikirimi notifikasi:', $userToNotify);
                        if ($userToNotify) {
                            Notification::make()->title('Proposal Anda Ditolak')->body($data['alasan_penolakan'])
                                ->danger()
                                ->sendToDatabase($userToNotify);
                        }
                        Notification::make()->title('Proposal berhasil ditolak')
                            ->success()
                            ->send();
                    }),

                Actions\Action::make('minta_revisi')
                    ->label('Kembalikan untuk Revisi')
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->form([
                        Textarea::make('catatan_revisi')->label('Catatan Revisi')->required(),
                    ])
                    ->action(function (Proposal $record, array $data) {
                        $record->update(['status' => 'revisi', 'catatan_keputusan' => $data['catatan_revisi']]);
                        $userToNotify = $record->lecturer->user;
                        if ($userToNotify) {
                            Notification::make()->title('Proposal Anda Memerlukan Revisi')->body($data['catatan_revisi'])
                                ->warning()
                                ->sendToDatabase($userToNotify);
                        }
                        Notification::make()
                            ->title('Proposal berhasil dikembalikan untuk revisi')
                            ->success()
                            ->send();
                    }),
            ])
                ->button()->icon('heroicon-m-cog-8-tooth')->label('Aksi Keputusan')->dropdown(true);
        }

        // LOGIKA #2: Tampilkan Tombol Batalkan HANYA JIKA statusnya 'diterima' atau 'ditolak'
        if ($this->record && in_array($this->record->status, ['diterima', 'ditolak'])) {
            $actions[] = Actions\Action::make('batalkan_keputusan')
                ->label('Batalkan Keputusan')
                ->icon('heroicon-o-arrow-uturn-left')
                ->color('gray')
                ->requiresConfirmation()
                ->modalHeading('Batalkan Keputusan Final?')
                ->modalDescription('Proposal ini akan dikembalikan ke status "Menunggu Keputusan". Lanjutkan?')
                ->action(function (Proposal $record) {
                    $record->update(['status' => 'menunggu_keputusan']);
                    Notification::make()
                        ->title('Keputusan Dibatalkan')
                        ->body('Proposal telah dikembalikan ke tahap menunggu keputusan.')
                        ->info()
                        ->send();
                });
        }

        // Tombol-tombol lain yang selalu ada
        $actions[] = Actions\ViewAction::make()
            ->label('Detail Proposal');
        $actions[] = Actions\DeleteAction::make()
            ->label('Hapus Ajuan');

        return $actions;
    }

    protected function getFormActions(): array
    {
        // Tetap dikosongkan untuk menghapus tombol bawah
        return [];
    }
    // --- AKHIR KODE TOMBOL ---
}
