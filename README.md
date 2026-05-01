# Taman Mini Indonesia Indah (TMII) - Visitor Portal

**Taman Mini Indonesia Indah (TMII) Visitor Portal** adalah platform registrasi dan manajemen pengunjung resmi untuk kawasan wisata TMII. Sistem ini dirancang untuk mempermudah pendaftaran wisatawan nusantara secara digital.

## Fitur Berdasarkan Role
1. **Wisatawan**: Mendapatkan halaman sambutan eksklusif setelah registrasi berhasil.
2. **Admin**: Panel manajemen lengkap untuk memonitor kedatangan dan mengelola data wisatawan (Nama, No HP, Alamat, Tanggal Kedatangan).
3. **Portal Registrasi**: Form pendaftaran mandiri bertema pariwisata Indonesia.

## Teknologi
- **Laravel 13** & **Livewire**
- **Flux UI** (Komponen Antarmuka)
- **Tailwind CSS**
- **MySQL**

---

## Panduan Instalasi Cepat

1. **Clone & Install**
   ```bash
   git clone <repository-url>
   composer install && npm install
   ```

2. **Setup Environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Inisialisasi Database**
   ```bash
   php artisan migrate:fresh --seed
   ```

---

## Akun Login Default

| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@wisata.com` | `password` |
| **Wisatawan** | `budi@example.com` | `password` |

---

## Cheat Sheet Perintah (Shortcut)

### Pengembangan & Operasional
- **Jalankan Aplikasi**: `composer run dev`
- **Reset & Seed Database**: `php artisan migrate:fresh --seed`
- **Bersihkan Cache**: `php artisan optimize:clear`

### Perbaikan Masalah (Troubleshooting)
- **Port 8000 Terpakai**: `fuser -k 8000/tcp`
- **Port 5173 Terpakai**: `fuser -k 5173/tcp`
- **Tampilan Berantakan**: `npm run build` atau pastikan `composer run dev` jalan.
- **Error Database**: Pastikan MySQL menyala dan cek `.env`.

### Git (Kolaborasi)
- **Update Lokal**: `git pull origin main`
- **Simpan & Kirim**: `git add . && git commit -m "pesan" && git push origin main`

---

## Hak Cipta
&copy; 2026 Wisata App. Fokus pada pendataan wisatawan yang cepat dan akurat.
