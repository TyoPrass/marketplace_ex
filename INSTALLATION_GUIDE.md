# 🛒 LaptopKu - Marketplace Laptop

Marketplace laptop terpercaya dengan sistem 3 role: Admin, Penjual, dan Pembeli.

## ✨ Fitur Utama

### 👥 Role-Based Access Control

- **Admin**: Verifikasi transaksi, kelola pesanan, monitoring sistem
- **Penjual**: Upload, edit, hapus produk laptop
- **Pembeli**: Browse katalog, beli produk, tracking pesanan

### 🎨 Fitur Landing Page

- Design modern dan responsif dengan Tailwind CSS
- Hero section dengan CTA yang menarik
- Katalog produk terbaru
- Informasi fitur marketplace

### 📦 Fitur CRUD Produk (Seller)

- Upload produk dengan detail lengkap (specs, harga, stok)
- Edit informasi produk
- Hapus produk
- Upload gambar produk
- Toggle status aktif/nonaktif

### 🛍️ Fitur Pembelian (Buyer)

- Browse katalog laptop
- Detail produk dengan spesifikasi lengkap
- Form pemesanan
- Tracking status pesanan
- Riwayat pembelian

### ⚙️ Admin Dashboard

- Dashboard statistik (total orders, pending, products, users)
- Kelola dan verifikasi pesanan
- Update status pesanan (pending → verified → processing → shipped → completed)
- Cancel pesanan dengan catatan
- View detail lengkap setiap transaksi

## 🚀 Instalasi

### Prasyarat

- PHP >= 8.1
- Composer
- MySQL/PostgreSQL
- Node.js & NPM (untuk asset compilation)

### Langkah Instalasi

1. **Clone atau setup project**

```bash
cd d:\Laravel\vibe_code
```

2. **Install dependencies**

```bash
composer install
npm install
```

3. **Setup environment**

```bash
copy .env.example .env
php artisan key:generate
```

4. **Konfigurasi database di file .env**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laptopku_db
DB_USERNAME=root
DB_PASSWORD=
```

5. **Jalankan migration dan seeder**

```bash
php artisan migrate:fresh --seed
```

6. **Buat symbolic link untuk storage**

```bash
php artisan storage:link
```

7. **Install Laravel Breeze untuk authentication**

```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install
npm run build
```

8. **Jalankan aplikasi**

```bash
php artisan serve
```

Aplikasi akan berjalan di: `http://localhost:8000`

## 👤 Akun Default (Setelah Seeding)

### Admin

- Email: `admin@laptopku.com`
- Password: `password`

### Seller 1

- Email: `seller1@laptopku.com`
- Password: `password`

### Seller 2

- Email: `seller2@laptopku.com`
- Password: `password`

### Buyer 1

- Email: `buyer1@example.com`
- Password: `password`

### Buyer 2

- Email: `buyer2@example.com`
- Password: `password`

## 📂 Struktur Database

### Tabel Users

- id, name, email, password, role (admin/seller/buyer), phone, address

### Tabel Products

- id, seller_id, name, brand, description, processor, ram, storage, gpu, screen_size, price, stock, image, status

### Tabel Orders

- id, order_number, buyer_id, product_id, quantity, total_price, shipping_address, phone, status, verified_at, verified_by, notes

## 🎯 Flow Aplikasi

1. **Pembeli** browse produk di landing page
2. **Pembeli** membuat pesanan dengan mengisi form
3. **Admin** menerima notifikasi pesanan baru (status: pending)
4. **Admin** verifikasi pesanan (status: verified) atau cancel dengan catatan
5. **Admin** update status: processing → shipped → completed
6. **Pembeli** dapat tracking status pesanan real-time

## 🛠️ Teknologi

- **Backend**: Laravel 11
- **Frontend**: Blade Templates + Tailwind CSS
- **Database**: MySQL
- **Authentication**: Laravel Breeze
- **File Storage**: Laravel Storage (public disk)

## 📝 Catatan Penting

- Setelah upload gambar produk, pastikan folder `storage/app/public` ter-symlink ke `public/storage`
- Untuk production, jangan lupa ganti `APP_ENV=production` dan `APP_DEBUG=false`
- Ubah semua password default sebelum deploy ke production
- Setup proper email driver untuk notifikasi pesanan

## 🔐 Security

- Implementasi middleware untuk role-based access
- Password hashing menggunakan bcrypt
- CSRF protection untuk semua form
- File validation untuk upload gambar
- SQL injection protection (Eloquent ORM)

## 📧 Support

Untuk pertanyaan atau bantuan, silakan hubungi tim development.

---

**Happy Coding! 🚀**
