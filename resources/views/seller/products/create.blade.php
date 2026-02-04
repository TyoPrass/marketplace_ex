<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Dashboard Penjual</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gradient-to-b from-blue-600 to-blue-800 text-white">
            <div class="p-6">
                <h2 class="text-2xl font-bold">Dashboard Penjual</h2>
            </div>
            <nav class="mt-6">
                <a href="{{ route('seller.products.index') }}" class="block px-6 py-3 hover:bg-blue-700 transition">
                    Produk Saya
                </a>
                <a href="{{ route('seller.products.create') }}" class="block px-6 py-3 bg-blue-700 hover:bg-blue-600 transition">
                    Tambah Produk
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto">
            <div class="p-8">
                <div class="mb-6">
                    <a href="{{ route('seller.products.index') }}" class="text-blue-600 hover:text-blue-700">← Kembali ke Produk Saya</a>
                </div>

                <h1 class="text-3xl font-bold text-gray-800 mb-8">Tambah Produk Baru</h1>

                <div class="bg-white rounded-xl shadow-lg p-8 max-w-3xl">
                    <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Nama Produk *</label>
                                <input type="text" name="name" required value="{{ old('name') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Brand *</label>
                                <input type="text" name="brand" required value="{{ old('brand') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                @error('brand')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6">
                            <label class="block text-gray-700 font-semibold mb-2">Deskripsi *</label>
                            <textarea name="description" rows="4" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">{{ old('description') }}</textarea>
                            @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid md:grid-cols-2 gap-6 mt-6">
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Processor *</label>
                                <input type="text" name="processor" required value="{{ old('processor') }}"
                                    placeholder="Contoh: Intel Core i7-12700H"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                @error('processor')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">RAM *</label>
                                <input type="text" name="ram" required value="{{ old('ram') }}"
                                    placeholder="Contoh: 16GB DDR4"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                @error('ram')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Storage *</label>
                                <input type="text" name="storage" required value="{{ old('storage') }}"
                                    placeholder="Contoh: 512GB NVMe SSD"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                @error('storage')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">GPU (Opsional)</label>
                                <input type="text" name="gpu" value="{{ old('gpu') }}"
                                    placeholder="Contoh: NVIDIA RTX 3060"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Ukuran Layar *</label>
                                <input type="text" name="screen_size" required value="{{ old('screen_size') }}"
                                    placeholder="Contoh: 15.6 inch FHD"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                @error('screen_size')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Harga (Rp) *</label>
                                <input type="number" name="price" required value="{{ old('price') }}" min="0" step="0.01"
                                    placeholder="Contoh: 15000000"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                @error('price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Stok *</label>
                                <input type="number" name="stock" required value="{{ old('stock') }}" min="0"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                @error('stock')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6">
                            <label class="block text-gray-700 font-semibold mb-2">Gambar Produk</label>
                            <input type="file" name="image" accept="image/*"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            <p class="text-gray-600 text-sm mt-1">Format: JPG, PNG (Max: 2MB)</p>
                            @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-8 flex space-x-4">
                            <a href="{{ route('seller.products.index') }}" 
                                class="flex-1 bg-gray-300 text-gray-700 text-center py-3 rounded-lg font-semibold hover:bg-gray-400 transition">
                                Batal
                            </a>
                            <button type="submit" 
                                class="flex-1 bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                                Simpan Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
