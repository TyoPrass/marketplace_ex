<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Admin LaptopKu',
            'email' => 'admin@laptopku.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Admin No. 1, Jakarta',
        ]);

        // Create Seller Users
        $seller1 = User::create([
            'name' => 'Toko Laptop Jakarta',
            'email' => 'seller1@laptopku.com',
            'password' => Hash::make('password'),
            'role' => 'seller',
            'phone' => '081234567891',
            'address' => 'Jl. Seller No. 1, Jakarta',
        ]);

        $seller2 = User::create([
            'name' => 'Komputer Central',
            'email' => 'seller2@laptopku.com',
            'password' => Hash::make('password'),
            'role' => 'seller',
            'phone' => '081234567892',
            'address' => 'Jl. Seller No. 2, Jakarta',
        ]);

        // Create Buyer Users
        $buyer1 = User::create([
            'name' => 'John Doe',
            'email' => 'buyer1@example.com',
            'password' => Hash::make('password'),
            'role' => 'buyer',
            'phone' => '081234567893',
            'address' => 'Jl. Buyer No. 1, Jakarta',
        ]);

        $buyer2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'buyer2@example.com',
            'password' => Hash::make('password'),
            'role' => 'buyer',
            'phone' => '081234567894',
            'address' => 'Jl. Buyer No. 2, Jakarta',
        ]);

        // Create Sample Products from Seller 1
        Product::create([
            'seller_id' => $seller1->id,
            'name' => 'ASUS ROG Strix G15',
            'brand' => 'ASUS',
            'description' => 'Laptop gaming powerful dengan desain futuristik. Sempurna untuk gaming dan content creation dengan performa maksimal.',
            'processor' => 'AMD Ryzen 9 5900HX',
            'ram' => '16GB DDR4',
            'storage' => '1TB NVMe SSD',
            'gpu' => 'NVIDIA RTX 3070',
            'screen_size' => '15.6" FHD 144Hz',
            'price' => 23000000,
            'stock' => 5,
            'status' => 'active',
        ]);

        Product::create([
            'seller_id' => $seller1->id,
            'name' => 'Dell XPS 13',
            'brand' => 'Dell',
            'description' => 'Laptop ultrabook premium dengan desain elegan dan performa tinggi. Cocok untuk profesional dan pelajar.',
            'processor' => 'Intel Core i7-1165G7',
            'ram' => '16GB LPDDR4x',
            'storage' => '512GB NVMe SSD',
            'gpu' => 'Intel Iris Xe Graphics',
            'screen_size' => '13.4" FHD+',
            'price' => 19500000,
            'stock' => 8,
            'status' => 'active',
        ]);

        Product::create([
            'seller_id' => $seller1->id,
            'name' => 'MacBook Air M2',
            'brand' => 'Apple',
            'description' => 'Laptop tipis dan ringan dengan chip M2 yang powerful. Battery life luar biasa dan performa yang sangat baik.',
            'processor' => 'Apple M2 Chip',
            'ram' => '8GB Unified Memory',
            'storage' => '256GB SSD',
            'gpu' => 'Apple M2 8-core GPU',
            'screen_size' => '13.6" Liquid Retina',
            'price' => 18999000,
            'stock' => 10,
            'status' => 'active',
        ]);

        // Create Sample Products from Seller 2
        Product::create([
            'seller_id' => $seller2->id,
            'name' => 'Lenovo ThinkPad X1 Carbon',
            'brand' => 'Lenovo',
            'description' => 'Business laptop premium dengan daya tahan tinggi. Keyboard terbaik di kelasnya dan sangat cocok untuk produktivitas.',
            'processor' => 'Intel Core i7-1165G7',
            'ram' => '16GB LPDDR4x',
            'storage' => '512GB NVMe SSD',
            'gpu' => 'Intel Iris Xe Graphics',
            'screen_size' => '14" FHD',
            'price' => 22500000,
            'stock' => 6,
            'status' => 'active',
        ]);

        Product::create([
            'seller_id' => $seller2->id,
            'name' => 'HP Pavilion Gaming 15',
            'brand' => 'HP',
            'description' => 'Laptop gaming dengan harga terjangkau namun performa mumpuni. Cocok untuk gaming casual dan pekerjaan sehari-hari.',
            'processor' => 'Intel Core i5-11300H',
            'ram' => '8GB DDR4',
            'storage' => '512GB NVMe SSD',
            'gpu' => 'NVIDIA GTX 1650',
            'screen_size' => '15.6" FHD 144Hz',
            'price' => 12500000,
            'stock' => 12,
            'status' => 'active',
        ]);

        Product::create([
            'seller_id' => $seller2->id,
            'name' => 'Acer Swift 3',
            'brand' => 'Acer',
            'description' => 'Laptop ringan dengan performa baik untuk pekerjaan sehari-hari. Value for money yang sangat baik.',
            'processor' => 'AMD Ryzen 5 5500U',
            'ram' => '8GB DDR4',
            'storage' => '512GB NVMe SSD',
            'gpu' => 'AMD Radeon Graphics',
            'screen_size' => '14" FHD IPS',
            'price' => 9500000,
            'stock' => 15,
            'status' => 'active',
        ]);

        Product::create([
            'seller_id' => $seller2->id,
            'name' => 'MSI GF63 Thin',
            'brand' => 'MSI',
            'description' => 'Gaming laptop tipis dengan performa solid. Desain portable namun tetap powerful untuk gaming.',
            'processor' => 'Intel Core i7-11800H',
            'ram' => '16GB DDR4',
            'storage' => '512GB NVMe SSD',
            'gpu' => 'NVIDIA RTX 3050',
            'screen_size' => '15.6" FHD 144Hz',
            'price' => 14500000,
            'stock' => 7,
            'status' => 'active',
        ]);

        Product::create([
            'seller_id' => $seller2->id,
            'name' => 'ASUS VivoBook 14',
            'brand' => 'ASUS',
            'description' => 'Laptop harian yang stylish dan terjangkau. Cocok untuk pelajar dan pekerja kantoran.',
            'processor' => 'Intel Core i3-1115G4',
            'ram' => '4GB DDR4',
            'storage' => '256GB NVMe SSD',
            'gpu' => 'Intel UHD Graphics',
            'screen_size' => '14" FHD',
            'price' => 6500000,
            'stock' => 20,
            'status' => 'active',
        ]);
    }
}

