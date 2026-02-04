# 🚀 Quick Start Commands

Jalankan command berikut secara berurutan untuk setup aplikasi:

```powershell
# 1. Install dependencies
composer install

# 2. Setup environment (jika belum ada .env)
if (!(Test-Path .env)) { Copy-Item .env.example .env }
php artisan key:generate

# 3. Konfigurasi database (edit .env terlebih dahulu!)
# DB_DATABASE=laptopku_db
# DB_USERNAME=root
# DB_PASSWORD=

# 4. Jalankan migration dan seeder
php artisan migrate:fresh --seed

# 5. Install Laravel Breeze untuk authentication
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install
npm run build

# 6. Buat symbolic link untuk storage
php artisan storage:link

# 7. Jalankan server
php artisan serve
```

## 🔑 Login Credentials

**Admin:**

- Email: admin@laptopku.com
- Password: password

**Seller:**

- Email: seller1@laptopku.com atau seller2@laptopku.com
- Password: password

**Buyer:**

- Email: buyer1@example.com atau buyer2@example.com
- Password: password

## 🌐 URL Akses

- Landing Page: http://localhost:8000
- Katalog Produk: http://localhost:8000/products
- Admin Dashboard: http://localhost:8000/admin/dashboard
- Seller Dashboard: http://localhost:8000/seller/products
- Buyer Orders: http://localhost:8000/buyer/orders

## ⚠️ Troubleshooting

**Error "Class 'App\Http\Middleware\...' not found"**

```powershell
composer dump-autoload
```

**Error "SQLSTATE[HY000] [1049] Unknown database"**

- Buat database terlebih dahulu:

```sql
CREATE DATABASE laptopku_db;
```

**Error "The stream or file could not be opened"**

```powershell
# Buat folder storage jika belum ada
New-Item -ItemType Directory -Force -Path storage/logs
New-Item -ItemType Directory -Force -Path storage/framework/sessions
New-Item -ItemType Directory -Force -Path storage/framework/views
New-Item -ItemType Directory -Force -Path storage/framework/cache

# Set permission (Windows)
icacls storage /grant Everyone:F /T
icacls bootstrap/cache /grant Everyone:F /T
```

**Gambar produk tidak muncul**

```powershell
php artisan storage:link
```
