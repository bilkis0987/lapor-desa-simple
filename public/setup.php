<?php
/**
 * LaporDesa - Web Installer (HAPUS SETELAH DIGUNAKAN!)
 * 
 * Cara pakai:
 * 1. Upload file ini ke public_html/
 * 2. Akses: https://domainkamu.com/setup.php
 * 3. HAPUS file ini setelah selesai!
 */

$projectDir = __DIR__ . '/../lapor_desa';
chdir($projectDir);

echo "<h1>LaporDesa Setup</h1>";
echo "<pre>";

if (!isset($_GET['step'])) {
    echo "Pilih langkah:\n\n";
    echo "<a href='?step=key'>1. Generate APP_KEY</a>\n";
    echo "<a href='?step=migrate'>2. Migrate Database</a>\n";
    echo "<a href='?step=storage'>3. Storage Link</a>\n";
    echo "<a href='?step=all'>4. Semua (KEY + MIGRATE + STORAGE)</a>\n";
    echo "\n⚠️  HAPUS file ini setelah selesai!";
    exit;
}

$step = $_GET['step'];

if ($step === 'key' || $step === 'all') {
    echo "[1] Generate APP_KEY...\n";
    passthru('php artisan key:generate --force 2>&1');
    echo "\n";
}

if ($step === 'migrate' || $step === 'all') {
    echo "[2] Migrate database...\n";
    passthru('php artisan migrate --force 2>&1');
    echo "\n";
}

if ($step === 'storage' || $step === 'all') {
    echo "[3] Storage link...\n";
    passthru('php artisan storage:link --force 2>&1');
    echo "\n";
}

echo "✅ Selesai!\n";
echo "⚠️  HAPUS file ini dari server!\n";
echo "</pre>";
echo "<p><a href='?step=all'>Jalankan Semua</a></p>";
