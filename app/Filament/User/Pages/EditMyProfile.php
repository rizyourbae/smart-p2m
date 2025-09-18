<?php

namespace App\Filament\User\Pages;

use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditMyProfile extends Page implements HasForms
{
    use InteractsWithForms;

    // --- Konfigurasi Navigasi ---
    protected static ?string $navigationLabel = 'Pengaturan Akun';
    protected static ?string $title = 'Pengaturan Akun';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static bool $shouldRegisterNavigation = true;

    protected static string $view = 'filament.user.pages.edit-my-profile';

    public ?array $data = [];

    public function mount(): void
    {
        // Ambil data dari User dan Lecturer yang sedang login
        $user = Auth::user();
        $lecturer = $user->lecturer;

        // Isi form dengan data gabungan
        $this->form->fill([
            'name' => $lecturer?->nama,
            'photo' => $lecturer?->photo,
            'email' => $user->email,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Profil Dosen')
                    ->description('Perbarui informasi pribadi anda.')
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Foto Profil')
                            ->image()->avatar()
                            ->disk('public')
                            ->directory('lecturer-photos'),

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
                            ->rule(
                                Rule::unique('users', 'email')
                                    ->ignore(Auth::id())
                            ),
                    ]),

                Section::make('Ubah Password')
                    ->description('Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.')
                    ->schema([
                        TextInput::make('current_password')
                            ->label('Password Saat Ini')
                            ->password()
                            ->revealable()
                            ->requiredWith('new_password')
                            ->currentPassword(),

                        TextInput::make('new_password')
                            ->label('Password Baru')
                            ->password()
                            ->revealable()
                            ->requiredWith('current_password')
                            ->rule(Password::default())
                            ->confirmed(),

                        TextInput::make('new_password_confirmation')
                            ->label('Konfirmasi Password Baru')
                            ->password()
                            ->requiredWith('new_password'),
                    ])->columns(2),
            ])
            ->statePath('data');
    }

    public function updateProfile(): void
    {
        /** @var \App\Models\User $user */ // <-- [INI PERBAIKANNYA] Petunjuk untuk VS Code
        $user = Auth::user();
        $lecturer = $user->lecturer;
        $data = $this->form->getState();


        // Update data di tabel lecturers
        $lecturer->update([
            'nama' => $data['name'],
            'photo' => $data['photo'],
        ]);

        // Update data di tabel users
        $user->email = $data['email'];

        // Update password hanya jika diisi
        if (!empty($data['new_password'])) {
            $user->password = Hash::make($data['new_password']);
        }

        $user->save();

        Auth::login($user);

        Notification::make()
            ->title('Profil berhasil diperbarui')
            ->success()
            ->send();

        // Refresh halaman untuk menampilkan data baru
        $this->redirect(static::getUrl());
    }
}
