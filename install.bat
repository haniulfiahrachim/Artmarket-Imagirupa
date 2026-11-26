@echo off
echo ========================================
echo   Imagirupa Art Market - Auto Installer
echo ========================================

:: 1. Copy .env
if not exist .env (
    copy .env.example .env
    echo [OK] File .env dibuat
)

:: 2. Install Composer dependencies
echo [*] Menginstall Composer dependencies...
composer install --no-interaction --prefer-dist

:: 3. Generate APP_KEY
echo [*] Generate APP_KEY...
php artisan key:generate

:: 4. Informasi konfigurasi
echo.
echo ========================================
echo  PENTING: Edit file .env terlebih dahulu
echo  Sesuaikan DB_DATABASE, DB_USERNAME, DB_PASSWORD
echo  dengan konfigurasi MySQL Anda.
echo.
echo  Contoh untuk XAMPP default:
echo    DB_DATABASE=imagirupa_db
echo    DB_USERNAME=root
echo    DB_PASSWORD=
echo ========================================
echo.

set /p LANJUT=Sudah edit .env? (y/n): 
if /i "%LANJUT%"=="y" goto MIGRATE

:MIGRATE
:: 5. Migrate & seed
echo [*] Menjalankan migration dan seeder...
php artisan migrate --seed --force

:: 6. Storage link
php artisan storage:link

:: 7. Clear cache
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo.
echo ========================================
echo   INSTALASI SELESAI!
echo ========================================
echo.
echo Jalankan: php artisan serve
echo Buka    : http://localhost:8000
echo.
echo Login Demo:
echo   Admin    : admin@imagirupa.com / password
echo   Seniman  : andi@imagirupa.com  / password
echo   Pelanggan: budi@gmail.com      / password
echo ========================================
pause
