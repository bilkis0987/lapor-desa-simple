<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

# 🏘️ LaporDesa

**Sistem Pengaduan dan Aspirasi Masyarakat Berbasis Web** — Aplikasi untuk memudahkan warga desa dalam menyampaikan laporan dan aspirasi terkait infrastruktur, pelayanan, dan fasilitas umum secara digital.

---

## 📋 Fitur

### 🔹 Publik (Warga)
- **Lihat Pengaduan** — Menelusuri daftar pengaduan yang telah dilaporkan
- **Buat Pengaduan** — Mengirim laporan baru dengan kategori, deskripsi, dan foto
- **Lacak Status** — Memantau progres pengaduan melalui status (submitted → verified → in_progress → resolved / rejected)
- **Detail Pengaduan** — Melihat informasi lengkap dan tanggapan admin

### 🔹 Admin (Perangkat Desa)
- **Dashboard** — Statistik ringkas jumlah pengaduan berdasarkan status dan prioritas
- **Kelola Pengaduan** — Verifikasi, proses, dan selesaikan laporan warga
- **Kategorisasi** — Atur kategori pengaduan (Jalan, Penerangan, Air Bersih, dll)
- **Komentar** — Beri tanggapan pada setiap pengaduan
- **Laporan PDF** — Ekspor laporan rekap ke format PDF

### 🔹 Keamanan
- Autentikasi multi-level (warga + admin)
- Proteksi CSRF & XSS
- Validasi input sisi server
- Middleware admin untuk akses terbatas

---

## 🏗️ Tech Stack

| Bagian          | Teknologi                              |
|-----------------|----------------------------------------|
| Framework       | Laravel 13.x                           |
| Frontend        | Blade + Tailwind CSS + Alpine.js       |
| Database        | MySQL (development), SQLite (testing)  |
| Build Tool      | Vite                                   |
| PDF Export      | barryvdh/laravel-dompdf                |

---

## ⚙️ Instalasi

```bash
# 1. Clone repositori
git clone https://github.com/bilkis0987/lapor-desa-simple.git
cd lapor-desa-simple

# 2. Install dependensi
composer install
npm install

# 3. Konfigurasi environment
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi database di .env
# DB_CONNECTION=mysql
# DB_DATABASE=lapor_desa
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Jalankan migrasi dan seeder
php artisan migrate --seed

# 6. Build aset frontend
npm run build

# 7. Jalankan aplikasi
php artisan serve
```

Akses aplikasi di `http://localhost:8000`.

---

## 🗂️ Struktur Database

| Tabel                | Deskripsi                            |
|----------------------|--------------------------------------|
| `users`              | Data admin perangkat desa            |
| `categories`         | Kategori pengaduan (7 jenis)         |
| `complaints`         | Data pengaduan warga                 |
| `complaint_comments` | Tanggapan admin pada setiap aduan    |

**Alur Status:** `submitted` → `verified` → `in_progress` → `resolved` | `rejected`

**Tingkat Prioritas:** `low` · `medium` · `high` · `urgent`

---

## 🚀 Deployment

Lihat panduan deployment lengkap di [DEPLOY.md](DEPLOY.md) atau jalankan:

```bash
bash deploy.sh
```

---

## 📄 Lisensi

Proyek ini dikembangkan menggunakan [Laravel](https://laravel.com) (lisensi MIT).
