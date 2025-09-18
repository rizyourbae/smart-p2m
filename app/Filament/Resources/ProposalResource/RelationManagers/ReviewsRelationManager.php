<?php

namespace App\Filament\Resources\ProposalResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use App\Models\Review;
use Filament\Notifications\Notification;

class ReviewsRelationManager extends RelationManager
{
    protected static string $relationship = 'reviews';
    protected static ?string $title = 'Hasil Penilaian Reviewer';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('reviewer_id')
            ->columns([
                TextColumn::make('reviewer.name')
                    ->label('Nama Reviewer'),
                TextColumn::make('tahapan_review')
                    ->label('Tahapan Saat Ini')
                    ->badge()
                    ->color('success'),
                TextColumn::make('total_nilai_proposal')
                    ->label('Total Skor Proposal')
                    ->sortable(),
                TextColumn::make('total_nilai_presentasi')
                    ->label('Total Skor Presentasi')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge(),
            ])
            ->filters([])
            ->headerActions([])
            ->actions([
                // Tombol untuk melihat detail review (bisa dibuat nanti)
                // Tables\Actions\ViewAction::make(),

                // --- [INI TOMBOL KUNCINYA] ---
                // AKSI PERTAMA: DARI PROPOSAL KE PRESENTASI
                Action::make('advance_to_presentation')
                    ->label('Lanjutkan ke Presentasi')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Review $record) {
                        $record->update(['tahapan_review' => 'presentasi']);
                        Notification::make()
                            ->title('Status berhasil diubah')
                            ->body('Reviewer sekarang bisa memulai tahap Penilaian Presentasi.')
                            ->success()
                            ->send();
                    })
                    // Tombol ini hanya muncul jika tahapannya 'proposal' DAN skor sudah diisi.
                    ->visible(fn(Review $record): bool => $record->tahapan_review === 'proposal' && !is_null($record->total_nilai_proposal)),

                // AKSI KEDUA: DARI PRESENTASI KE LUARAN
                Action::make('advance_to_outputs')
                    ->label('Lanjutkan ke Penilaian Luaran')
                    ->icon('heroicon-o-arrow-up-on-square')
                    ->color('info')
                    ->requiresConfirmation()
                    ->action(function (Review $record) {
                        $record->update(['tahapan_review' => 'luaran']);
                        Notification::make()
                            ->title('Status berhasil diubah ke Penilaian Luaran')
                            ->success()
                            ->send();
                    })
                    // Tombol ini hanya muncul jika tahapannya 'presentasi' DAN skor sudah diisi.
                    ->visible(fn(Review $record): bool => $record->tahapan_review === 'presentasi' && !is_null($record->total_nilai_presentasi)),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
