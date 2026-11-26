#!/bin/bash
# =============================================================
# Script Instalasi Otomatis - Imagirupa Art Market
# =============================================================
# Cara pakai: bash install.sh
# =============================================================

echo "========================================"
echo "  Imagirupa Art Market - Auto Installer "
echo "========================================"

# 1. Copy .env
if [ ! -f .env ]; then
    cp .env.example .env
    echo "[✓] File .env dibuat"
fi

# 2. Install composer dependencies
echo "[*] Menginstall Composer dependencies..."
composer install --no-interaction --prefer-dist

# 3. Generate APP_KEY
echo "[*] Generate APP_KEY..."
php artisan key:generate

# 4. Prompt DB config
echo ""
echo "Masukkan konfigurasi database MySQL:"
read -p "DB_DATABASE [imagirupa_db]: " DB_DATABASE
DB_DATABASE=${DB_DATABASE:-imagirupa_db}
read -p "DB_USERNAME [root]: " DB_USERNAME
DB_USERNAME=${DB_USERNAME:-root}
read -p "DB_PASSWORD [kosongkan jika tidak ada]: " DB_PASSWORD

# Update .env
sed -i "s/DB_DATABASE=.*/DB_DATABASE=${DB_DATABASE}/" .env
sed -i "s/DB_USERNAME=.*/DB_USERNAME=${DB_USERNAME}/" .env
sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=${DB_PASSWORD}/" .env

echo "[✓] Konfigurasi database disimpan"

# 5. Migrate & seed
echo "[*] Menjalankan migration & seeder..."
php artisan migrate --seed --force

# 6. Storage link
php artisan storage:link 2>/dev/null || true

# 7. Clear cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo ""
echo "========================================"
echo "  ✅ Instalasi Selesai!"
echo "========================================"
echo ""
echo "Jalankan: php artisan serve"
echo "Buka    : http://localhost:8000"
echo ""
echo "Login Demo:"
echo "  Admin    : admin@imagirupa.com / password"
echo "  Seniman  : andi@imagirupa.com  / password"
echo "  Pelanggan: budi@gmail.com      / password"
echo "========================================"
