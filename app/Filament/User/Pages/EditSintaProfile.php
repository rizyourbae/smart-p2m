<?php

namespace App\Filament\User\Pages;

use Filament\Pages\Page;
use App\Models\Lecturer;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Notifications\Notification;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class EditSintaProfile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'filament.user.pages.edit-sinta-profile';
    protected static ?string $title = 'Ubah Profil Sinta';
    protected static bool $shouldRegisterNavigation = false;
    public ?array $data = [];
    public ?Lecturer $record;

    public function mount(): void
    {
        // [PERBAIKAN BUG] Mengambil data lecturer dari relasi user yang login
        $this->record = Auth::user()->lecturer;

        if (!$this->record) {
            Notification::make()->title('Profil Dosen belum ada!')->danger()->send();
            redirect()->route('filament.user.pages.edit-profile');
            return;
        }
        $this->form->fill($this->record->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi SINTA')
                    ->description('Masukkan SINTA ID Anda di sini. Data skor dan lainnya akan ditarik secara otomatis setelah Anda melakukan sinkronisasi.')
                    ->schema([
                        TextInput::make('sinta_id')
                            ->label('ID SINTA')
                            ->helperText('Pastikan ID SINTA yang Anda masukkan benar.')
                            ->required(),

                        // Field skor sekarang hanya untuk tampilan, tidak bisa diisi manual
                        TextInput::make('sinta_score_all_years')
                            ->label('SINTA Score (All Years)')
                            ->disabled(),

                        TextInput::make('sinta_score_3_years')
                            ->label('SINTA Score (3 Years)')
                            ->disabled(),
                            
                        TextInput::make('sinta_affiliation_all_years')
                            ->label('Affiliation overall (Score)')
                            ->disabled(),

                        TextInput::make('sinta_affiliation_3_years')
                            ->label('Affiliation (3 Years)')
                            ->disabled(),
                    ])
                    ->columns(2),
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function submit(): void
    {
        // Form ini sekarang hanya menyimpan SINTA ID
        $this->record->update(
            $this->form->getState()
        );

        Notification::make()
            ->title('SINTA ID berhasil disimpan')
            ->success()
            ->send();

        // Arahkan kembali ke halaman tampilan profil SINTA
        $this->redirect(SintaProfile::getUrl());
    }
}
