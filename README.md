# 🎨 Imagirupa Art Market

**Sistem Informasi E-Commerce Art Market Imagirupa Berbasis Web**

Platform marketplace karya seni digital dan fisik untuk komunitas Imagirupa di Pontianak, dibangun dengan **Laravel 10** + **Bootstrap 5** + **MySQL**.

---

## 🔑 Akun Demo (Setelah Seeding)

| Role       | Email                   | Password   |
|------------|-------------------------|------------|
| Admin      | admin@imagirupa.com     | password   |
| Seniman 1  | andi@imagirupa.com      | password   |
| Seniman 2  | dewi@imagirupa.com      | password   |
| Pelanggan  | budi@gmail.com          | password   |

---

## ⚙️ Cara Instalasi (XAMPP / Lokal)

### 1. Persiapan

Pastikan sudah terinstall:
- **PHP >= 8.1**
- **Composer**
- **MySQL** (XAMPP / MariaDB)
- **Node.js** (opsional)

### 2. Clone / Ekstrak Project

```bash
# Ekstrak ZIP ke folder htdocs (XAMPP) atau www (Laragon)
# Contoh: C:\xampp\htdocs\imagirupa
```

### 3. Install Dependencies

```bash
cd imagirupa
composer install
```

### 4. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env` sesuai konfigurasi database Anda:

```env
APP_NAME="Imagirupa Art Market"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=imagirupa_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Buat Database

Buka **phpMyAdmin** atau MySQL CLI dan buat database:

```sql
CREATE DATABASE imagirupa_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 6. Jalankan Migration & Seeder

```bash
php artisan migrate --seed
```

### 7. Buat Symlink Storage

```bash
php artisan storage:link
```

### 8. Jalankan Server

```bash
php artisan serve
```

Akses di browser: **http://localhost:8000**

---

## 📁 Struktur Folder Penting

```
imagirupa/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          ← Controller Admin
│   │   │   ├── Seniman/        ← Controller Seniman
│   │   │   ├── Pelanggan/      ← Controller Pelanggan
│   │   │   ├── AuthController.php
│   │   │   ├── ChatController.php
│   │   │   └── GalleryController.php
│   │   └── Middleware/
│   │       └── RoleMiddleware.php  ← RBAC Middleware
│   └── Models/
│       ├── User.php
│       ├── Profile.php
│       ├── Karya.php
│       ├── Pesanan.php
│       ├── Pembayaran.php
│       └── Chat.php
├── database/
│   ├── migrations/             ← Skema database
│   └── seeders/
│       └── DatabaseSeeder.php  ← Data dummy
├── resources/views/
│   ├── layouts/                ← Layout utama & dashboard
│   ├── auth/                   ← Login & Register
│   ├── public/                 ← Halaman publik
│   ├── admin/                  ← Views Admin
│   ├── seniman/                ← Views Seniman
│   └── pelanggan/              ← Views Pelanggan
├── routes/
│   └── web.php                 ← Semua route
└── public/
    └── uploads/
        ├── karya/              ← Gambar karya seni
        ├── profil/             ← Foto profil user
        └── pembayaran/         ← Bukti pembayaran
```

---

## 🚀 Fitur Sistem

### 👥 Multi-Role (RBAC)
- **Admin**: Kelola user, verifikasi seniman, kelola karya, verifikasi pembayaran, laporan
- **Seniman**: Upload/edit/hapus karya, kelola pesanan, chat pelanggan, edit profil
- **Pelanggan**: Browse galeri, pesan karya, upload bukti bayar, chat seniman, riwayat pesanan

### 🖼️ Gallery & Marketplace
- Galeri karya dengan pagination
- Filter: terbaru, terlaris, harga terendah/tertinggi
- Pencarian karya
- Detail karya + profil seniman

### 💳 Sistem Transaksi
- Pemesanan karya oleh pelanggan
- Upload bukti pembayaran manual
- Verifikasi pembayaran oleh admin
- Update status pesanan oleh seniman

### 💬 Sistem Chat
- Chat real-time sederhana (polling AJAX 10 detik)
- Chat per pesanan antara pelanggan & seniman

### 📊 Dashboard Multi-Role
- Dashboard Admin dengan Chart.js (statistik pesanan)
- Dashboard Seniman (karya, pesanan, revenue)
- Dashboard Pelanggan (riwayat pesanan, status)

---

## 🛠️ Tech Stack

| Layer      | Teknologi                  |
|------------|----------------------------|
| Backend    | Laravel 10 (PHP 8.1+)      |
| Frontend   | Bootstrap 5 + Blade        |
| Database   | MySQL / MariaDB            |
| Auth       | Laravel Session Auth       |
| RBAC       | Custom Middleware           |
| Charts     | Chart.js                   |
| Icons      | Bootstrap Icons            |
| Fonts      | Google Fonts (Inter + Playfair Display) |

---

## ⚠️ Troubleshooting

**Error: Class not found**
```bash
composer dump-autoload
```

**Error: Permission denied (storage)**
```bash
chmod -R 775 storage bootstrap/cache
```

**Error: SQLSTATE connection refused**
- Pastikan MySQL sudah berjalan di XAMPP
- Cek konfigurasi DB di `.env`

**Gambar tidak muncul**
- Pastikan folder `public/uploads/` bisa ditulis (writable)
- Jalankan `php artisan storage:link`

---

## 📝 Catatan

- Gambar karya pada data dummy menggunakan placeholder (karena tidak ada file aktual). Setelah upload karya sungguhan, gambar akan tampil normal.
- Sistem chat menggunakan polling AJAX setiap 10 detik (bukan WebSocket).
- Pembayaran bersifat manual (transfer bank) — tidak terintegrasi payment gateway.

---

*Dibuat untuk komunitas Imagirupa, Pontianak © 2024*
