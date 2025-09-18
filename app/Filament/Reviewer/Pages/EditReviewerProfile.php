<?php

namespace App\Filament\Reviewer\Pages;

use App\Models\Reviewer;
use App\Filament\Reviewer\Pages\ReviewerProfile; 
use Filament\Pages\Page;
use Filament\Forms\Get;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Filament\Forms\Components\{TextInput, Select, DatePicker, FileUpload, Section};

class EditReviewerProfile extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';
    protected static string $view = 'filament.reviewer.pages.edit-reviewer-profile';
    protected static ?string $title = 'Edit Profil Reviewer';
    // Sembunyikan dari navigasi karena diakses dari halaman profil
    protected static bool $shouldRegisterNavigation = false;

    public ?Reviewer $record = null;
    public array $data = [];

    public function mount(): void
    {
        // [PERBAIKAN] Gunakan guard 'reviewer' untuk mendapatkan record
        /** @var \App\Models\Reviewer|null $user */
        $user = Auth::guard('reviewer')->user();
        $this->record = $user;
        // [LOGIKA DISESUAIKAN] Jika record belum ada, seharusnya tidak terjadi
        // karena reviewer dibuat saat registrasi.
        // Namun, mount() tetap mengisi form dengan data yang ada.
        $this->form->fill($this->record->toArray());
    }

    /**
     * Menggabungkan getForm dan getFormSchema menjadi satu metode form()
     * yang lebih modern sesuai standar Filament 3.
     */
    public function form(Form $form): Form
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
                Section::make('Informasi Foto & Akun')
                    ->description('Unggah foto profil dan pastikan informasi email akurat.')
                    ->schema([
                        FileUpload::make('photo')
                            ->label('Foto Profil')
                            ->disk('public') // Pastikan storage link sudah dibuat
                            ->directory('reviewer-photos')
                            ->image()
                            ->imageEditor() // Fitur crop/rotate gambar
                            ->nullable()
                            ->columnSpanFull(),
                        TextInput::make('email')
                            ->email()
                            ->label('Email')
                            ->required(),
                        Select::make('status_pengguna')
                            ->label('Status Pengguna')
                            ->options([
                                'Reviewer' => 'Reviewer',
                                'Dosen & Reviewer' => 'Dosen & Reviewer',
                            ])
                            ->required(),
                        TextInput::make('sinta_id')
                            ->label('ID SINTA')
                            ->nullable(),
                    ])->columns(2),

                Section::make('Data Diri')
                    ->description('Isi informasi pribadi Anda.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('nik')
                            ->label('NIK')
                            ->nullable()
                            ->maxLength(16),
                        Select::make('jk')
                            ->label('Jenis Kelamin')
                            ->options([
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan'
                            ])->nullable(),
                        TextInput::make('tempat_lahir')
                            ->label('Tempat Lahir')
                            ->nullable(),
                        DatePicker::make('tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->nullable(),
                        TextInput::make('hp')
                            ->label('No. HP / WA')
                            ->nullable()
                            ->tel(),
                        TextInput::make('alamat')
                            ->label('Alamat Lengkap')
                            ->nullable()
                            ->columnSpanFull(),
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
                    ])->columns(2),

                Section::make('Informasi Kepegawaian & Akademik')
                    ->description('Lengkapi detail profesi dan jabatan Anda.')
                    ->schema([
                        TextInput::make('nip')
                            ->label('NIP / NIY')
                            ->nullable(),
                        TextInput::make('nidn')
                            ->label('NIDN')
                            ->nullable(),
                        Select::make('employee_type')
                            ->label('Jenis Pegawai')
                            ->options([
                                'PNS' => 'PNS',
                                'PPPK' => 'PPPK',
                                'Kontrak' => 'Kontrak',
                                'Lainnya' => 'Lainnya'
                            ])->nullable(),
                        Select::make('profession')->label('Profesi')->options([
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
                            'Analis SDMA' => 'Analis SDMA'
                        ])->nullable(),
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
                            ])->nullable(),
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
                            ])->nullable(),
                    ])->columns(2),
            ])
            ->model($this->record)
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $this->record->update($data);

        Notification::make()
            ->title('Profil berhasil diperbarui.')
            ->success()
            ->send();

        // Arahkan kembali ke halaman profil yang benar
        $this->redirect(ReviewerProfile::getUrl());
    }
}
