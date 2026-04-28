# Sistem Celry

**Sistem Celry** dirancang sebagai platform manajemen karyawan yang fokus pada efisiensi operasional perusahaan melalui tiga fungsi CRUD utama:
1. **Manajemen User**: Mengelola data identitas dan hak akses akun.
2. **Manajemen Pekerjaan**: Pembagian tugas serta monitoring progres kerja staf secara sistematis.
3. **Manajemen Inventaris Kantor**: Mendata aset perusahaan yang digunakan oleh karyawan.

## Alur Sistem
- **Admin**: Memiliki kendali penuh terhadap seluruh database dan audit organisasi.
- **Pegawai (Celry-Pegawai)**: Berfungsi sebagai staf manajemen yang menginput data operasional dan memperbarui status pekerjaan harian.

## Teknologi Utama
- **Framework**: Laravel 13
- **Frontend**: Livewire & Flux UI
- **Styling**: Tailwind CSS
- **Database**: MySQL (Direkomendasikan) atau SQLite

## Instalasi

1. **Clone Repository**
   ```bash
   git clone <repository-url>
   cd chrly-pegawai
   ```

2. **Install Dependensi**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment**
   Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database Anda.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Migrasi dan Seed Data**
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Jalankan Aplikasi**
   ```bash
   npm run dev
   # Di terminal lain
   php artisan serve
   ```

## Akun Default (Seeder)
Gunakan kredensial berikut untuk mencoba sistem:

- **Admin**
  - Email: `admin@celry.com`
  - Password: `password`
- **Pegawai**
  - Email: `pegawai@celry.com`
  - Password: `password`

## Desain
Aplikasi ini menggunakan tema modern dengan antarmuka yang bersih dan fungsional, memanfaatkan komponen Flux UI untuk pengalaman pengguna yang responsif.
