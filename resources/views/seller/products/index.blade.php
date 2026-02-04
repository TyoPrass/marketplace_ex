<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Penjual - LaptopKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gradient-to-b from-blue-600 to-blue-800 text-white">
            <div class="p-6">
                <h2 class="text-2xl font-bold">Dashboard Penjual</h2>
                <p class="text-blue-200 text-sm mt-2">{{ auth()->user()->name }}</p>
            </div>
            <nav class="mt-6">
                <a href="{{ route('seller.products.index') }}" class="block px-6 py-3 bg-blue-700 hover:bg-blue-600 transition">
                    Produk Saya
                </a>
                <a href="{{ route('seller.products.create') }}" class="block px-6 py-3 hover:bg-blue-700 transition">
                    Tambah Produk
                </a>
                <a href="/" class="block px-6 py-3 hover:bg-blue-700 transition">
                    Ke Halaman Utama
                </a>
                <form method="POST" action="/logout" class="mt-4">
                    @csrf
                    <button type="submit" class="block w-full text-left px-6 py-3 hover:bg-blue-700 transition">
                        Logout
                    </button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto">
            <div class="p-8">
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-800">Produk Saya</h1>
                    <a href="{{ route('seller.products.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                        + Tambah Produk Baru
                    </a>
                </div>

                @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded">
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
                @endif

                <!-- Products Grid -->
                @if($products->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                        @else
                        <div class="w-full h-48 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                            <svg class="w-20 h-20 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                            </svg>
                        </div>
                        @endif
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm text-blue-600 font-semibold">{{ $product->brand }}</span>
                                @if($product->status === 'active')
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Active</span>
                                @else
                                <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-semibold">Inactive</span>
                                @endif
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $product->name }}</h3>
                            <p class="text-gray-600 text-sm mb-3">{{ Str::limit($product->description, 60) }}</p>
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-2xl font-bold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <span class="text-sm text-gray-600">Stok: {{ $product->stock }}</span>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('seller.products.edit', $product) }}" class="flex-1 bg-blue-600 text-white text-center py-2 rounded-lg hover:bg-blue-700 transition text-sm">
                                    Edit
                                </a>
                                <form action="{{ route('seller.products.destroy', $product) }}" method="POST" class="flex-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Yakin ingin menghapus produk ini?')" 
                                        class="w-full bg-red-600 text-white py-2 rounded-lg hover:bg-red-700 transition text-sm">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $products->links() }}
                </div>
                @else
                <div class="bg-white rounded-xl shadow-lg p-12 text-center">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                    </svg>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Produk</h3>
                    <p class="text-gray-600 mb-6">Mulai tambahkan produk pertama Anda sekarang!</p>
                    <a href="{{ route('seller.products.create') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                        + Tambah Produk
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
