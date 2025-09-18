<?php

namespace App\Filament\Resources;

use App\Models\Lecturer;
use App\Models\User;
use App\Filament\Resources\LecturerResource\Pages;
use App\Filament\Resources\LecturerResource\RelationManagers;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;


class LecturerResource extends Resource
{
    protected static ?string $model = Lecturer::class;

    // Pastikan ikon ini sudah sesuai dengan Heroicons yang ada
    protected static ?string $navigationLabel = 'Dosen/Peneliti'; // Label di navigasi sidebar
    public static function getPluralLabel(): string
    {
        return 'Dosen/Peneliti';
    }
    protected static ?string $navigationGroup = 'Data Master'; // Grup navigasi, sesuaikan dengan yang ada di aplikasi

    public static function form(Form $form): Form
    {
        // Definisikan data Fakultas dan Prodi secara terpusat
        $facultiesAndPrograms = [
            'FTIK' => [
                'Pendidikan Agama Islam' => 'Pendidikan Agama Islam',
                'Manajemen Pendidikan Islam' => 'Manajemen Pendidikan Islam',
                'Pendidikan Islam Anak Usia Dini' => 'Pendidikan Islam Anak Usia Dini',
                'Pendidikan Guru Madrasah Ibtidaiyah' => 'Pendidikan Guru Madrasah Ibtidaiyah',
                'Pendidikan Bahasa Arab' => 'Pendidikan Bahasa Arab',
                'Tadris Bahasa Inggris' => 'Tadris Bahasa Inggris',
                'Tadris Matematika' => 'Tadris Matematika',
                'Tadris Biologi' => 'Tadris Biologi',
                'Pendidikan Profesi Guru' => 'Pendidikan Profesi Guru',
            ],
            'FEBI' => [
                'Ekonomi Syariah' => 'Ekonomi Syariah',
                'Perbankan Syariah' => 'Perbankan Syariah',
                'Manajemen Bisnis Syariah' => 'Manajemen Bisnis Syariah',
            ],
            'FUAD' => [
                'Komunikasi Penyiaran Islam' => 'Komunikasi Penyiaran Islam',
                'Manajemen Dakwah' => 'Manajemen Dakwah',
                'Bimbingan dan Konseling Islam' => 'Bimbingan dan Konseling Islam',
                'Ilmu Al-Qur\'an dan Tafsir' => 'Ilmu Al-Qur\'an dan Tafsir',
                'Sistem Informasi' => 'Sistem Informasi (Informatika/Komputer)',
                'Ilmu Hadist' => 'Ilmu Hadist',
            ],
            'FASYA' => [
                'Hukum Ekonomi Syariah' => 'Hukum Ekonomi Syariah',
                'Hukum Keluarga' => 'Hukum Keluarga',
                'Hukum Tatanegara' => 'Hukum Tatanegara',
            ],
            'PASCASARJANA' => [
                'Magister Pendidikan Agama Islam' => 'Magister Pendidikan Agama Islam',
                'Magister Manajemen Pendidikan Islam' => 'Magister Manajemen Pendidikan Islam',
                'Magister Ekonomi Syariah' => 'Magister Ekonomi Syariah',
                'Magister Hukum Keluarga' => 'Magister Hukum Keluarga',
                'Magister Komunikasi Penyiaran Islam' => 'Magister Komunikasi Penyiaran Islam',
                'Magister Pendidikan Islam Anak Usia Dini' => 'Magister Pendidikan Islam Anak Usia Dini',
                'Magister Ilmu Al-Qur\'an dan Tafsir' => 'Magister Ilmu Al-Qur\'an dan Tafsir',
                'Doktoral Pendidikan Agama Islam' => 'Doktoral Pendidikan Agama Islam',
            ],
            'LEMBAGA' => [
                'Lembaga Penelitian dan Pengabdian kepada Masyarakat (LP2M)' => 'Lembaga Penelitian dan Pengabdian kepada Masyarakat (LP2M)',
                'Lembaga Penjaminan Mutu' => 'Lembaga Penjaminan Mutu',
            ],
            'Unit Pelaksana Teknis' => [
                'Perpustakaan' => 'Perpustakaan',
                'Pengembangan Karir' => 'Pengembangan Karir',
                'TIPD' => 'TIPD',
                'Pengembangan Bahasa' => 'Pengembangan Bahasa',
                'MA\'HAD' => 'MA\'HAD',
            ],
        ];

        $facultyOptions = array_combine(
            array_keys($facultiesAndPrograms),
            array_keys($facultiesAndPrograms)
        );

        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Foto & Akun')
                    ->description('Pastikan foto profil jelas dan informasi email akurat.')
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Foto Profil')
                            ->disk('public')
                            ->directory('documents/lecturers') // Konsisten dengan direktori ini
                            ->acceptedFileTypes(['image/*'])
                            ->image()
                            ->nullable()
                            ->columnSpan(1),
                        TextInput::make('email')
                            ->email()
                            ->label('Email')
                            ->unique(ignoreRecord: true, table: Lecturer::class) // Pastikan email unik di tabel Lecturer
                            ->required()
                            ->columnSpan(1),
                        Select::make('status_pengguna')
                            ->label('Status Pengguna')
                            ->options([
                                'Dosen' => 'Dosen',
                                'Peneliti' => 'Peneliti',
                                'Dosen & Peneliti' => 'Dosen & Peneliti',
                                // Tambahkan opsi lain jika ada, misal 'Admin', 'Reviewer'
                            ])
                            ->required()
                            ->columnSpan(1),
                        TextInput::make('sinta_id')
                            ->label('ID SINTA')
                            ->nullable()
                            ->columnSpan(1),

                        Forms\Components\Section::make('Buat Password untuk Akun Dosen Baru')
                            ->schema([
                                TextInput::make('password')
                                    ->label('Password')
                                    ->password()
                                    ->revealable()
                                    ->required()
                                    ->minLength(8)
                                    ->confirmed(), // Memastikan cocok dengan field konfirmasi
                                TextInput::make('password_confirmation')
                                    ->label('Konfirmasi Password')
                                    ->password()
                                    ->required(),
                            ])
                            ->columns(2)
                            ->visibleOn('create'), // <-- Kunci: Hanya terlihat di halaman Create
                        // --- [AKHIR KODE TAMBAHAN] ---
                    ])->columns(2),

                Forms\Components\Section::make('Data Diri')
                    ->description('Informasi pribadi dosen/peneliti.')
                    ->schema([
                        TextInput::make('nama')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('nik')
                            ->label('NIK')
                            ->nullable()
                            ->maxLength(16),
                        Select::make('jk')
                            ->label('Jenis Kelamin')
                            ->required()
                            ->options([
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan',
                            ]),
                        TextInput::make('tempat_lahir')
                            ->label('Tempat Lahir')
                            ->nullable()
                            ->maxLength(255),
                        DatePicker::make('tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->nullable(),
                        TextInput::make('hp')
                            ->label('No. HP / WA')
                            ->nullable()
                            ->tel(),
                        Select::make('unit')
                            ->label('Fakultas / Unit Kerja')
                            ->options($facultyOptions) // <-- Menggunakan array options yang sudah pasti benar
                            ->live()
                            ->afterStateUpdated(fn(Set $set) => $set('study_program', null))
                            ->searchable()
                            ->nullable(),
                        Select::make('study_program')
                            ->label('Program Studi')
                            ->options(
                                fn(Get $get): array =>
                                // Logika ini sekarang seharusnya bekerja dengan benar
                                $facultiesAndPrograms[$get('unit')] ?? []
                            )
                            ->searchable()
                            ->nullable(),
                        TextInput::make('alamat')
                            ->label('Alamat Lengkap')
                            ->nullable()
                            ->columnSpan(1),
                    ])->columns(2),

                Forms\Components\Section::make('Informasi Kepegawaian & Akademik')
                    ->description('Detail profesi dan jabatan.')
                    ->schema([
                        TextInput::make('nip')
                            ->label('NIP / NIY')
                            ->nullable()
                            ->maxLength(255),
                        TextInput::make('nidn')
                            ->label('NIDN')
                            ->required()
                            ->placeholder('Jika Bukan Dosen Silahkan Isi NIP')
                            ->maxLength(255),
                        Select::make('employee_type')
                            ->label('Jenis Pegawai')
                            ->options([
                                'PNS' => 'PNS',
                                'PPPK' => 'PPPK',
                                'Kontrak' => 'Kontrak',
                                'Lainnya' => 'Lainnya'
                            ])
                            ->nullable(),
                        Select::make('profession')
                            ->label('Profesi')
                            ->options([
                                'Dosen' => 'Dosen',
                                'Peneliti' => 'Peneliti',
                                'Profesional' => 'Profesional',
                                'Laboran' => 'Laboran',
                                'Pustakawan' => 'Pustakawan',
                                'Arsiparis' => 'Arsiparis',
                                'Perencana' => 'Perencana',
                                'Analis' => 'Analis',
                                'Pranata Komputer' => 'Pranata Komputer',
                                'Pranata Humas' => 'Pranata Humas',
                                'Pranata Keuangan' => 'Pranata Keuangan',
                                'Pengembang TP' => 'Pengembang TP',
                                'Perancang UU' => 'Perancang UU',
                                'Penerjemah' => 'Penerjemah',
                                'Analis SDMA' => 'Analis SDMA',
                            ])
                            ->nullable(),
                        Select::make('functional_position')
                            ->label('Jabatan Fungsional')
                            ->options([
                                'Asisten Ahli' => 'Asisten Ahli',
                                'Lektor' => 'Lektor',
                                'Lektor Kepala' => 'Lektor Kepala',
                                'Guru Besar' => 'Guru Besar',
                                'Pustakawan' => 'Pustakawan',
                                'Arsiparis' => 'Arsiparis',
                                'Perencana' => 'Perencana',
                                'Peneliti' => 'Peneliti',
                                'Pranata Komputer' => 'Pranata Komputer',
                                'Analis Kebijakan' => 'Analis Kebijakan',
                                'Analis Kepegawaian' => 'Analis Kepegawaian',
                                'Analis Pengelola Keuangan APBN' => 'Analis Pengelola Keuangan APBN',
                                'Analis Pengadaan Barang/Jasa Ahli Muda' => 'Analis Pengadaan Barang/Jasa Ahli Muda',
                                'Pengembang Teknologi Pembelajaran' => 'Pengembang Teknologi Pembelajaran',
                                'Perancang Peraturan Perundang-undangan' => 'Perancang Peraturan Perundang-undangan',
                                'Pranata Hubungan Masyarakat' => 'Pranata Hubungan Masyarakat',
                                'Pranata Keuangan APBN' => 'Pranata Keuangan APBN',
                                'Penerjemah' => 'Penerjemah',
                                'Analis SDMA' => 'Analis SDMA',
                            ])
                            ->nullable(),
                        Select::make('scientific_field')
                            ->label('Bidang Ilmu')
                            ->options([
                                'Adab dan Humaniora' => 'Adab dan Humaniora',
                                'Architecture' => 'Architecture',
                                'Dakwah dan Komunikasi' => 'Dakwah dan Komunikasi',
                                'Ekonomi dan Bisnis Islam' => 'Ekonomi dan Bisnis Islam',
                                'Ilmu Politik' => 'Ilmu Politik',
                                'Kedokteran dan Ilmu Kesehatan' => 'Kedokteran dan Ilmu Kesehatan',
                                'Psikologi Islam' => 'Psikologi Islam',
                                'Sains dan Teknologi' => 'Sains dan Teknologi',
                                'Studi Islam/Dirasat Islamiyah/Islamic Studies' => 'Studi Islam/Dirasat Islamiyah/Islamic Studies',
                                'Syariah dan Ilmu Hukum' => 'Syariah dan Ilmu Hukum',
                                'Tarbiyah dan Ilmu Pendidikan' => 'Tarbiyah dan Ilmu Pendidikan',
                                'Ushuluddin dan Pemikiran/Filsafat' => 'Ushuluddin dan Pemikiran/Filsafat',
                            ])
                            ->nullable(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->label('Foto')
                    ->disk('public')
                    ->height(50)
                    ->width(50)
                    ->circular()
                    ->defaultImageUrl(asset('images/default-profile.png')),
                TextColumn::make('nama')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nidn')
                    ->label('NIDN')
                    ->searchable(),
                TextColumn::make('nip')
                    ->label('NIP / NIY')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('profession')
                    ->label('Profesi')
                    ->searchable(),
                TextColumn::make('functional_position')
                    ->label('Jabatan Fungsional')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status_pengguna')
                    ->label('Status Pengguna')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Dosen' => 'info',
                        'Peneliti' => 'success',
                        'Dosen & Peneliti' => 'primary',
                        default => 'gray',
                    })
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status_pengguna')
                    ->label('Filter Status Pengguna')
                    ->options([
                        'Dosen' => 'Dosen',
                        'Peneliti' => 'Peneliti',
                        'Dosen & Peneliti' => 'Dosen & Peneliti',
                    ]),
                SelectFilter::make('profession')
                    ->label('Filter Profesi')
                    ->options([
                        'Dosen' => 'Dosen',
                        'Peneliti' => 'Peneliti',
                        'Profesional' => 'Profesional',
                        'Laboran' => 'Laboran',
                        'Pustakawan' => 'Pustakawan',
                        'Arsiparis' => 'Arsiparis',
                        'Perencana' => 'Perencana',
                        'Analis' => 'Analis',
                        'Pranata Komputer' => 'Pranata Komputer',
                        'Pranata Humas' => 'Pranata Humas',
                        'Pranata Keuangan' => 'Pranata Keuangan',
                        'Pengembang TP' => 'Pengembang TP',
                        'Perancang UU' => 'Perancang UU',
                        'Penerjemah' => 'Penerjemah',
                        'Analis SDMA' => 'Analis SDMA',
                        // ... tambahkan opsi profesi lainnya sesuai form
                    ]),
                SelectFilter::make('scientific_field')
                    ->label('Filter Bidang Ilmu')
                    ->options([
                        'Adab dan Humaniora' => 'Adab dan Humaniora',
                        'Architecture' => 'Architecture',
                        'Dakwah dan Komunikasi' => 'Dakwah dan Komunikasi',
                        'Ekonomi dan Bisnis Islam' => 'Ekonomi dan Bisnis Islam',
                        'Ilmu Politik' => 'Ilmu Politik',
                        'Kedokteran dan Ilmu Kesehatan' => 'Kedokteran dan Ilmu Kesehatan',
                        'Psikologi Islam' => 'Psikologi Islam',
                        'Sains dan Teknologi' => 'Sains dan Teknologi',
                        'Studi Islam/Dirasat Islamiyah/Islamic Studies' => 'Studi Islam/Dirasat Islamiyah/Islamic Studies',
                        'Syariah dan Ilmu Hukum' => 'Syariah dan Ilmu Hukum',
                        'Tarbiyah dan Ilmu Pendidikan' => 'Tarbiyah dan Ilmu Pendidikan',
                        'Ushuluddin dan Pemikiran/Filsafat' => 'Ushuluddin dan Pemikiran/Filsafat',
                        // ... tambahkan opsi bidang ilmu lainnya sesuai form
                    ]),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),

                    // <<< TAMBAHKAN AKSI RESET PASSWORD DI SINI
                    Tables\Actions\Action::make('resetPassword')
                        ->label('Reset Password')
                        ->icon('heroicon-o-key') // Ikon kunci
                        ->color('warning') // Warna kuning untuk indikasi hati-hati
                        ->form([
                            Forms\Components\TextInput::make('new_password')
                                ->label('Password Baru')
                                ->password()
                                ->required()
                                ->minLength(8) // Minimal 8 karakter
                                ->dehydrateStateUsing(fn(string $state): string => Hash::make($state)) // Otomatis hash password
                                ->confirmed(), // Membutuhkan konfirmasi password
                            Forms\Components\TextInput::make('new_password_confirmation')
                                ->label('Konfirmasi Password Baru')
                                ->password()
                                ->required(),
                        ])
                        ->action(function (Lecturer $record, array $data) {
                            // Temukan user yang berelasi dengan lecturer ini
                            $user = User::where('id', $record->user_id)->first();

                            if (!$user) {
                                Notification::make()
                                    ->title('Gagal mereset password.')
                                    ->body('Pengguna tidak ditemukan.')
                                    ->danger()
                                    ->send();
                                return;
                            }

                            // Update password user
                            $user->update([
                                'password' => $data['new_password'], // Password sudah di-hash oleh dehydrateStateUsing
                            ]);

                            Notification::make()
                                ->title('Password berhasil direset!')
                                ->body("Password untuk {$user->name} telah berhasil diubah.")
                                ->success()
                                ->send();
                        })
                        ->visible(fn(Lecturer $record): bool => (bool)$record->user_id), // Hanya tampilkan jika lecturer punya user_id
                    // >>> AKHIR AKSI RESET PASSWORD
                    Tables\Actions\DeleteAction::make(),
                ])
                    ->label('Opsi') // Mengubah label default jika tidak pakai ikon
                    ->icon('heroicon-m-cog-8-tooth') // Mengganti ikon
                    ->tooltip('Klik untuk melihat opsi lainnya') // Menambahkan tooltip
                    ->color('primary') // Mengubah warna tombol
                    ->button()
                    ->size('sm'), // Mengubah ukuran tombol
            ])
            ->bulkActions([]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLecturers::route('/'),
            'create' => Pages\CreateLecturer::route('/create'),
            'view' => Pages\ViewLecturer::route('/{record}'),
            'edit' => Pages\EditLecturer::route('/{record}/edit'),
        ];
    }

    // Metode untuk mengontrol hak akses (sementara dibiarkan true untuk ditampilkan)
    public static function canViewAny(): bool
    {
        return true; // Untuk sementara, semua user di panel ini bisa melihat menu ini
    }

    public static function canCreate(): bool
    {
        return false; // Untuk sementara, semua user di panel ini bisa membuat record
    }

    public static function canView(Model $record): bool
    {
        return true; // Untuk sementara, semua user di panel ini bisa melihat detail
    }

    public static function canEdit(Model $record): bool
    {
        return true; // Untuk sementara, semua user di panel ini bisa mengedit
    }

    public static function canDelete(Model $record): bool
    {
        return true; // Untuk sementara, semua user di panel ini bisa menghapus
    }
}
