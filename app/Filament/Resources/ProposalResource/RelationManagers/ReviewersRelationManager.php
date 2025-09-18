<?php

namespace App\Filament\Resources\ProposalResource\RelationManagers;

use App\Models\Reviewer;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Illuminate\Support\HtmlString;
use Illuminate\Database\Eloquent\Builder;

class ReviewersRelationManager extends RelationManager
{
    protected static string $relationship = 'reviewers';
    protected static ?string $title = 'Reviewer yang Ditugaskan';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Reviewer')
                    ->searchable(),
                TextColumn::make('unit')
                    ->label('Unit Kerja'),
                TextColumn::make('study_program')
                    ->label('Program Studi'),
                TextColumn::make('scientific_field')
                    ->label('Bidang Ilmu Keahlian'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // [PEROMBAKAN TOTAL] Kita ganti AttachAction dengan Action biasa
                Action::make('assign_reviewer')
                    ->label('Pilih & Tugaskan Reviewer')
                    ->icon('heroicon-o-user-plus')
                    // [LANGKAH 1] Buat Form di dalam Modal
                    ->form([
                        Select::make('reviewer_id')
                            ->label('Pilih Calon Reviewer')
                            ->required()
                            // [LANGKAH 2] Ambil opsi reviewer yang belum ditugaskan
                            ->options(function () {
                                $proposal = $this->getOwnerRecord();
                                return Reviewer::query()
                                    ->whereDoesntHave('proposals', fn(Builder $query) => $query->where('proposals.id', $proposal->id))
                                    ->get()
                                    ->mapWithKeys(function ($reviewer) {
                                        $info = "Bidang: " . ($reviewer->scientific_field ?? '-') .
                                            " | Beban: " . $reviewer->active_reviews_count . " proposal";

                                        $htmlLabel =
                                            '<div style="display: flex; flex-direction: column;">' .
                                            '<strong>' . htmlspecialchars($reviewer->name) . '</strong>' .
                                            '<span style="font-size: 0.8rem; color: #6b7280;">' . htmlspecialchars($info) . '</span>' .
                                            '</div>';

                                        return [$reviewer->id => $htmlLabel];
                                    });
                            })
                            ->searchable()
                            ->allowHtml()
                            ->live(),
                    ])
                    // [LANGKAH 3] Definisikan apa yang terjadi saat tombol "Tugaskan" di modal diklik
                    ->action(function (array $data) {
                        // Lakukan proses 'attach' secara manual
                        $this->getOwnerRecord()->reviewers()->attach($data['reviewer_id']);

                        // Jalankan logika 'after' kita
                        $proposal = $this->getOwnerRecord();
                        if ($proposal->status === 'diajukan') {
                            $proposal->update(['status' => 'dalam_penilaian']);
                            Notification::make()
                                ->title('Status Proposal Diperbarui')
                                ->body('Status proposal ini telah otomatis diubah menjadi "Dalam Penilaian".')
                                ->success()
                                ->send();
                        }
                        Notification::make()->title('Reviewer berhasil ditugaskan.')->success()->send();
                    })
                    ->modalSubmitActionLabel('Tugaskan Reviewer'),
            ])
            ->actions([
                Tables\Actions\DetachAction::make()
                    ->label('Lepas Reviewer'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
