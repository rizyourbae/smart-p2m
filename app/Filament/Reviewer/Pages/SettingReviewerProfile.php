<?php

namespace App\Filament\Reviewer\Pages;

use Filament\Pages\Page;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class SettingReviewerProfile extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationLabel = 'Pengaturan Akun';
    protected static ?string $title = 'Pengaturan Akun';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static bool $shouldRegisterNavigation = true; // Pastikan muncul di navigasi

    protected static string $view = 'filament.reviewer.pages.setting-reviewer-profile';

    public ?array $data = [];

    public function mount(): void
    {
        /** @var \App\Models\Reviewer $reviewer */
        $reviewer = Auth::guard('reviewer')->user();
        // Ambil data dari Reviewer yang sedang login
        $this->form->fill($reviewer->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Profil Reviewer')
                    ->description('Perbarui foto dan nama lengkap Anda.')
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Foto Profil')
                            ->image()->avatar()
                            ->disk('public')
                            ->directory('reviewer-photos'),

                        TextInput::make('name')
                            ->label('Nama Lengkap (dengan gelar)')
                            ->required(),
                    ]),

                Section::make('Informasi Akun')
                    ->description('Perbarui alamat email Anda.')
                    ->schema([
                        TextInput::make('email')
                            ->label('Alamat Email')
                            ->email()
                            ->required()
                            ->rule(Rule::unique('reviewers', 'email')->ignore(Auth::guard('reviewer')->id())),
                    ]),

                Section::make('Ubah Password')
                    ->description('Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.')
                    ->schema([
                        TextInput::make('current_password')
                            ->label('Password Saat Ini')
                            ->password()
                            ->revealable()
                            ->requiredWith('new_password')
                            // Cek password saat ini di guard 'reviewer'
                            ->currentPassword(),

                        TextInput::make('new_password')
                            ->label('Password Baru')
                            ->password()
                            ->requiredWith('current_password')
                            ->rule(Password::default())
                            ->revealable()
                            ->confirmed(),

                        TextInput::make('new_password_confirmation')
                            ->label('Konfirmasi Password Baru')
                            ->password()
                            ->requiredWith('new_password'),
                    ])->columns(2),
            ])
            ->statePath('data')
            ->model(Auth::guard('reviewer')->user());
    }

    public function updateProfile(): void
    {
        /** @var \App\Models\Reviewer $reviewer */ // <-- [UBAH] Petunjuk tipe data untuk Reviewer
        $reviewer = Auth::guard('reviewer')->user();
        $data = $this->form->getState();

        // Update data di tabel reviewers
        $reviewer->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'photo' => $data['photo'],
        ]);

        // Update password hanya jika diisi
        if (!empty($data['new_password'])) {
            $reviewer->password = Hash::make($data['new_password']);
        }

        $reviewer->save();

        // Login-kan kembali user untuk me-refresh sesi setelah ubah password
        Auth::guard('reviewer')->login($reviewer);

        Notification::make()
            ->title('Profil berhasil diperbarui')
            ->success()
            ->send();

        $this->redirect(static::getUrl());
    }
}
