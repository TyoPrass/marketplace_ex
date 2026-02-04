<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Dashboard Penjual</title>
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
                <a href="{{ route('seller.products.index') }}" class="block px-6 py-3 bg-blue-700 hover:bg-blue-600 transition">
                    Produk Saya
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto">
            <div class="p-8">
                <div class="mb-6">
                    <a href="{{ route('seller.products.index') }}" class="text-blue-600 hover:text-blue-700">← Kembali ke Produk Saya</a>
                </div>

                <h1 class="text-3xl font-bold text-gray-800 mb-8">Edit Produk</h1>

                <div class="bg-white rounded-xl shadow-lg p-8 max-w-3xl">
                    <form action="{{ route('seller.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Nama Produk *</label>
                                <input type="text" name="name" required value="{{ old('name', $product->name) }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Brand *</label>
                                <input type="text" name="brand" required value="{{ old('brand', $product->brand) }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                @error('brand')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-6">
                            <label class="block text-gray-700 font-semibold mb-2">Deskripsi *</label>
                            <textarea name="description" rows="4" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid md:grid-cols-2 gap-6 mt-6">
                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Processor *</label>
                                <input type="text" name="processor" required value="{{ old('processor', $product->processor) }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">RAM *</label>
                                <input type="text" name="ram" required value="{{ old('ram', $product->ram) }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Storage *</label>
                                <input type="text" name="storage" required value="{{ old('storage', $product->storage) }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">GPU (Opsional)</label>
                                <input type="text" name="gpu" value="{{ old('gpu', $product->gpu) }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Ukuran Layar *</label>
                                <input type="text" name="screen_size" required value="{{ old('screen_size', $product->screen_size) }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Harga (Rp) *</label>
                                <input type="number" name="price" required value="{{ old('price', $product->price) }}" min="0" step="0.01"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Stok *</label>
                                <input type="number" name="stock" required value="{{ old('stock', $product->stock) }}" min="0"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            </div>

                            <div>
                                <label class="block text-gray-700 font-semibold mb-2">Status *</label>
                                <select name="status" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                                    <option value="active" {{ old('status', $product->status) === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', $product->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-6">
                            <label class="block text-gray-700 font-semibold mb-2">Gambar Produk</label>
                            @if($product->image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded-lg">
                                <p class="text-sm text-gray-600 mt-1">Gambar saat ini</p>
                            </div>
                            @endif
                            <input type="file" name="image" accept="image/*"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                            <p class="text-gray-600 text-sm mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
                        </div>

                        <div class="mt-8 flex space-x-4">
                            <a href="{{ route('seller.products.index') }}" 
                                class="flex-1 bg-gray-300 text-gray-700 text-center py-3 rounded-lg font-semibold hover:bg-gray-400 transition">
                                Batal
                            </a>
                            <button type="submit" 
                                class="flex-1 bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                                Update Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
