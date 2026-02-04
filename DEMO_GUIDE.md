# 🎬 Demo Flow & Testing Guide

## 🧪 Testing Scenarios

### Scenario 1: Buyer Purchase Flow

1. **Login sebagai Buyer**
    - Navigate to: `http://localhost:8000/login`
    - Email: `buyer1@example.com`
    - Password: `password`

2. **Browse Products**
    - Click "Lihat Produk" di landing page
    - Atau navigate to: `http://localhost:8000/products`

3. **View Product Detail**
    - Click "Lihat Detail" pada produk pilihan
    - Lihat spesifikasi lengkap laptop

4. **Make Purchase**
    - Click "Beli Sekarang"
    - Isi form pemesanan:
        - Jumlah: 1
        - Alamat pengiriman (auto-filled dari profile)
        - No. telepon (auto-filled dari profile)
    - Click "Pesan Sekarang"

5. **Check Order Status**
    - Navigate to: `http://localhost:8000/buyer/orders`
    - Status akan "Menunggu Verifikasi" (pending)
    - Click "Lihat Detail" untuk detail lengkap

### Scenario 2: Seller Product Management

1. **Login sebagai Seller**
    - Navigate to: `http://localhost:8000/login`
    - Email: `seller1@laptopku.com`
    - Password: `password`

2. **View Products Dashboard**
    - Auto redirect ke: `http://localhost:8000/seller/products`
    - Lihat semua produk yang sudah dibuat

3. **Add New Product**
    - Click "+ Tambah Produk Baru"
    - Isi form:
        - Nama Produk: "Lenovo Legion 5"
        - Brand: "Lenovo"
        - Deskripsi: "Gaming laptop dengan cooling system excellent"
        - Processor: "AMD Ryzen 7 5800H"
        - RAM: "16GB DDR4"
        - Storage: "512GB NVMe SSD"
        - GPU: "NVIDIA RTX 3060"
        - Ukuran Layar: "15.6 inch FHD 165Hz"
        - Harga: 17500000
        - Stok: 10
        - Upload gambar (optional)
    - Click "Simpan Produk"

4. **Edit Product**
    - Click "Edit" pada produk yang ingin diubah
    - Ubah harga atau stok
    - Update status (Active/Inactive)
    - Click "Update Produk"

5. **Delete Product**
    - Click "Hapus" pada produk yang ingin dihapus
    - Confirm deletion
    - Product akan dihapus dari database

### Scenario 3: Admin Order Verification

1. **Login sebagai Admin**
    - Navigate to: `http://localhost:8000/login`
    - Email: `admin@laptopku.com`
    - Password: `password`

2. **View Dashboard**
    - Auto redirect ke: `http://localhost:8000/admin/dashboard`
    - Lihat statistik:
        - Total Orders
        - Pending Orders
        - Total Products
        - Total Sellers
        - Total Buyers

3. **Manage Orders**
    - Click "Kelola Pesanan" di sidebar
    - Lihat semua pesanan dengan status masing-masing

4. **Verify Order**
    - Click "Detail" pada order dengan status pending
    - Periksa detail pesanan:
        - Info pembeli
        - Info produk
        - Alamat pengiriman
    - **Option A: Approve**
        - Isi catatan verifikasi (optional)
        - Click "✓ Verifikasi Pesanan"
        - Status berubah menjadi "Verified"
    - **Option B: Cancel**
        - Isi alasan pembatalan
        - Click "✗ Batalkan Pesanan"
        - Status berubah menjadi "Cancelled"

5. **Update Order Status** (for verified orders)
    - Status flow: Verified → Processing → Shipped → Completed
    - Click tombol status yang tersedia
    - Status akan terupdate secara otomatis

## 🎯 Feature Testing Checklist

### Authentication & Authorization

- [ ] Login dengan 3 role berbeda berhasil
- [ ] Admin tidak bisa akses `/seller/*` routes
- [ ] Seller tidak bisa akses `/admin/*` routes
- [ ] Buyer tidak bisa akses `/seller/*` atau `/admin/*` routes
- [ ] Logout berhasil dan redirect ke home

### Product Management (Seller)

- [ ] Create product dengan semua field berhasil
- [ ] Create product dengan image upload berhasil
- [ ] Edit product berhasil
- [ ] Delete product berhasil
- [ ] Seller hanya bisa edit/delete produknya sendiri
- [ ] Product status (active/inactive) berfungsi

### Order Management (Buyer)

- [ ] Browse products tanpa login berhasil
- [ ] Purchase product dengan form valid berhasil
- [ ] Order number auto-generated dengan format correct
- [ ] Stock berkurang setelah purchase
- [ ] View order history berhasil
- [ ] View order detail berhasil
- [ ] Error jika stock habis

### Admin Verification

- [ ] Dashboard statistics akurat
- [ ] View all orders berhasil
- [ ] Verify order berhasil (status: pending → verified)
- [ ] Cancel order berhasil (status: pending → cancelled)
- [ ] Update status flow berhasil
- [ ] Admin notes tersimpan

### UI/UX

- [ ] Landing page responsive
- [ ] Navigation menu berfungsi
- [ ] Success messages muncul
- [ ] Error messages muncul
- [ ] Product images ditampilkan
- [ ] Pagination berfungsi

## 📊 Data Validation Testing

### Product Validation

```
Required: name, brand, description, processor, ram, storage, screen_size, price, stock
Optional: gpu, image
Numeric: price (min: 0)
Integer: stock (min: 0)
Image: jpeg, png, jpg (max: 2MB)
```

### Order Validation

```
Required: product_id, quantity, shipping_address, phone
Integer: quantity (min: 1, max: available stock)
Exists: product_id must exist in products table
```

### Admin Verification

```
Required: status (verified/cancelled)
Optional: notes
Enum: status must be one of allowed values
```

## 🐛 Known Issues & Solutions

### Issue: Images not showing

**Solution:**

```powershell
php artisan storage:link
```

### Issue: 404 on routes

**Solution:**

```powershell
php artisan route:clear
php artisan route:cache
```

### Issue: Authentication not working

**Solution:**
Install Laravel Breeze:

```powershell
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run build
```

### Issue: Database error

**Solution:**

```powershell
php artisan migrate:fresh --seed
```

## 🎨 UI Components

### Colors

- Primary: Blue (#3B82F6)
- Success: Green (#10B981)
- Warning: Orange (#F59E0B)
- Danger: Red (#EF4444)
- Gray scale for text and backgrounds

### Status Badges

- Pending: Orange
- Verified: Green
- Processing: Blue
- Shipped: Purple
- Completed: Teal
- Cancelled: Red

### Buttons

- Primary: Blue background, white text
- Secondary: Gray background, gray text
- Danger: Red background, white text

## 📸 Screenshot Locations

Untuk dokumentasi lengkap, ambil screenshot dari:

1. Landing page
2. Product catalog
3. Product detail with order form
4. Seller dashboard
5. Seller create/edit product form
6. Buyer orders list
7. Buyer order detail
8. Admin dashboard
9. Admin orders management
10. Admin order verification

---

**Happy Testing! 🚀**
