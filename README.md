# Wisata App - Sistem Manajemen Wisatawan

**Wisata App** adalah platform manajemen pendaftaran wisatawan yang dirancang untuk mempermudah proses registrasi pengunjung di kawasan wisata. Sistem ini memastikan setiap pengunjung terdata dengan baik sebelum memasuki area wisata.

## Fitur Utama
1. **Registrasi Wisatawan**: Form pendaftaran mandiri bagi pengunjung (Nama, No HP, Tanggal Datang, Rombongan).
2. **Dashboard Wisatawan**: Ringkasan data kunjungan untuk verifikasi petugas loket.
3. **Manajemen Admin**: Monitoring statistik kedatangan dan pengelolaan data seluruh pengunjung.
4. **Manajemen Tugas & Inventaris**: Fitur internal untuk staf operasional kawasan wisata.

## Teknologi Utama
- **Framework**: Laravel 13
- **Frontend**: Livewire & Flux UI
- **Styling**: Tailwind CSS
- **Database**: MySQL

---

## Panduan Instalasi

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
   Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database Anda (DB_DATABASE, DB_USERNAME, DB_PASSWORD).
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Migrasi dan Seed Data**
   Gunakan perintah ini untuk mereset database dan mengisi data awal:
   ```bash
   php artisan migrate:fresh --seed
   ```

---

## Cara Menjalankan Aplikasi

Gunakan perintah satu pintu untuk menjalankan server, vite, dan antrian sekaligus:
```bash
composer run dev
```

Jika perintah di atas berjalan, Anda bisa mengakses:
- **Aplikasi**: [http://localhost:8000](http://localhost:8000)
- **Vite Dev Server**: [http://localhost:5173](http://localhost:5173)

---

## Akun Default (Hasil Seeder)

| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@wisata.com` | `password` |
| **Petugas** | `petugas@wisata.com` | `password` |
| **Wisatawan** | `budi@example.com` | `password` |

---

## Troubleshooting (Penyelesaian Masalah)

### 1. Masalah pada `composer run dev`
Jika perintah ini gagal atau macet:
- **Port 8000/5173 Terpakai**: Pastikan tidak ada aplikasi lain yang menggunakan port tersebut. Anda bisa menutup proses lama dengan:
  ```bash
  fuser -k 8000/tcp
  fuser -k 5173/tcp
  ```
- **Node Modules Bermasalah**: Hapus dan install ulang:
  ```bash
  rm -rf node_modules package-lock.json
  npm install
  ```

### 2. Error Database (SQLSTATE[HY000] [2002])
- Pastikan server database (MySQL/XAMPP) sudah menyala.
- Cek kembali kredensial di file `.env`.
- Jalankan ulang migrasi: `php artisan migrate:fresh`.

### 3. Tampilan Berantakan (CSS Tidak Muncul)
- Pastikan `npm run dev` atau `composer run dev` sedang berjalan.
- Jika di server produksi, jalankan: `npm run build`.

### 4. Membersihkan Cache Aplikasi
Jika terjadi error aneh setelah perubahan kode:
```bash
php artisan optimize:clear
php artisan view:clear
php artisan config:clear
```

---

## Hak Cipta
&copy; 2026 Wisata App. Dibuat untuk efisiensi manajemen pengunjung.
