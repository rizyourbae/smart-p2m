<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditAdminProfile extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationLabel = 'Pengaturan Akun';
    public static function getPluralLabel(): string
    {
        return 'Profil';
    }
    protected static ?string $title = 'Pengaturan Akun';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static bool $shouldRegisterNavigation = true;

    protected static string $view = 'filament.pages.edit-admin-profile';

    public ?array $data = [];

    public function mount(): void
    {
        // [PERBAIKAN] Beri petunjuk tipe data untuk VS Code
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Isi form dengan data user yang sudah jelas tipenya
        $this->form->fill($user->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Personal')
                    ->description('Perbarui informasi pribadi Anda.')
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Foto Profil')
                            ->image()
                            ->avatar()
                            ->disk('public')
                            ->directory('admin-photos'),

                        TextInput::make('name')
                            ->label('Nama Lengkap')
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
                            ->requiredWith('new_password') // Wajib diisi jika password baru diisi
                            ->currentPassword(), // Validasi otomatis dari Filament

                        TextInput::make('new_password')
                            ->label('Password Baru')
                            ->password()
                            ->requiredWith('current_password')
                            ->rule(Password::default()) // Aturan kompleksitas password bawaan Laravel
                            ->confirmed(), // Harus cocok dengan field konfirmasi

                        TextInput::make('new_password_confirmation')
                            ->label('Konfirmasi Password Baru')
                            ->password()
                            ->requiredWith('new_password'),
                    ])->columns(2),
            ])
            ->statePath('data')
            ->model(Auth::user());
    }

    public function updateProfile(): void
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $data = $this->form->getState();

        // Update nama, email, dan foto
        $user->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'photo' => $data['photo'],
        ]);

        // Update password hanya jika diisi
        if (!empty($data['new_password'])) {
            $user->password = Hash::make($data['new_password']);
        }

        $user->save();

        Notification::make()
            ->title('Profil berhasil diperbarui')
            ->success()
            ->send();

        // Refresh halaman untuk menampilkan data baru
        $this->redirect(static::getUrl());
    }
}
