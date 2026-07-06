#!/bin/bash
# ============================================
# Deploy Script LaporDesa untuk cPanel Terminal
# ============================================

echo "====================================="
echo "  DEPLOY LAPORDESA - SHARED HOSTING"
echo "====================================="

# Cek PHP
echo ""
echo "[1/5] Memeriksa PHP..."
php -v | head -1

# Generate APP_KEY
echo ""
echo "[2/5] Generate APP_KEY..."
php artisan key:generate --force

# Migrate database
echo ""
echo "[3/5] Migrasi database..."
php artisan migrate --force

# Storage link
echo ""
echo "[4/5] Membuat storage symlink..."
php artisan storage:link --force

# Optimize
echo ""
echo "[5/5] Optimasi..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo ""
echo "====================================="
echo "  DEPLOY SELESAI!"
echo "====================================="
echo "Admin: admin@desa.com / password"
echo "====================================="
