# Panduan Deployment LaporDesa

## 1. Persiapan File

Di local, jalankan (sudah dilakukan):

```bash
npm run build         # build asset Vite
php artisan storage:link   # buat symlink storage
```

## 2. Upload via cPanel

### 2a. Upload file utama (pakai File Manager)

1. **Zip** folder project (kecuali `node_modules`, `.env`, `tests/`, `storage/framework/cache/data/`, `storage/logs/`)
2. Buka **cPanel → File Manager**
3. Masuk ke folder **`public_html`**
4. Buat folder baru: **`lapor_desa`** di luar `public_html` (satu level di atas)
5. Upload zip ke `public_html`, extract → isinya pindah ke `lapor_desa/`

> Atau: upload via FTP langsung ke `lapor_desa/`

### 2b. Pindahkan isi `public/` ke `public_html/`

Dari folder `lapor_desa/public/`:
- `.htaccess`
- `favicon.ico`
- `robots.txt`
- `index.php`
- folder `build/`
- folder `storage/` (symlink)

Pindahkan semua file di atas ke **`public_html/`**

### 2c. Edit `public_html/index.php`

Ubah 2 baris ini:

```php
require __DIR__.'/../lapor_desa/vendor/autoload.php';
// ...
$app = require_once __DIR__.'/../lapor_desa/bootstrap/app.php';
```

## 3. Buat Database

1. cPanel → **MySQL Database Wizard**
2. Buat database: `lapor_desa`
3. Buat user: `lapor_desa_user` + password
4. Add user to database → **ALL PRIVILEGES**

## 4. Konfigurasi `.env`

Copy file `.env.example` ke `.env` di `lapor_desa/`:

```bash
cp .env.example .env
```

Edit `.env` isi:

```
APP_NAME=LaporDesa
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domainkamu.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=lapor_desa
DB_USERNAME=lapor_desa_user
DB_PASSWORD=password_yang_kamu_buat

SESSION_DRIVER=file
SESSION_LIFETIME=120

CACHE_STORE=file
QUEUE_CONNECTION=sync
```

## 5. Generate APP_KEY & Migrasi

### Via Terminal (SSH/cPanel Terminal):

```bash
cd /home/username/lapor_desa
php artisan key:generate
php artisan migrate
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Via Cron Job (jika tidak ada terminal):

1. **Generate key** via URL: upload file `setup.php` di `public_html/`, akses via browser, hapus setelah selesai.
2. **Migrasi database** sama via setup.
3. Hapus `setup.php` setelah selesai.

## 6. Atur Izin (Permissions)

```
chmod 755 lapor_desa/storage
chmod 755 lapor_desa/bootstrap/cache
chmod 644 lapor_desa/.env
```

## 7. Final Check

Akses domain:
- ✅ `https://domainkamu.com` → Landing page
- ✅ `https://domainkamu.com/login` → Login admin
- ✅ `https://domainkamu.com/pengaduan/buat` → Buat pengaduan
- ✅ `https://domainkamu.com/pengaduan/lacak` → Lacak pengaduan
- ✅ `https://domainkamu.com/admin/dashboard` → Dashboard admin

## Troubleshooting

| Masalah | Solusi |
|---------|--------|
| 500 Server Error | Cek `lapor_desa/storage/logs/laravel.log` |
| File gambar 404 | Jalankan `php artisan storage:link` |
| Login ga bisa | Cek `.env` session driver = file |
| Blank page | Cek PHP version ≥ 8.1 via cPanel Select PHP Version |
