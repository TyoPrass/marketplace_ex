<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Laptop - LaptopKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <a href="/" class="text-2xl font-bold text-gray-800">Laptop<span class="text-blue-600">Ku</span></a>
                <div class="flex items-center space-x-6">
                    <a href="/" class="text-gray-700 hover:text-blue-600">Beranda</a>
                    <a href="{{ route('products.index') }}" class="text-blue-600 font-semibold">Produk</a>
                    @auth
                        @if(auth()->user()->isBuyer())
                            <a href="{{ route('buyer.orders.index') }}" class="text-gray-700 hover:text-blue-600">Pesanan Saya</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-6 py-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-8">Katalog Laptop</h1>

        <div class="grid md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($products as $product)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition">
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
                    <span class="text-sm text-blue-600 font-semibold">{{ $product->brand }}</span>
                    <h3 class="text-xl font-bold text-gray-800 mt-2 mb-2">{{ $product->name }}</h3>
                    <p class="text-sm text-gray-600 mb-4">{{ Str::limit($product->description, 80) }}</p>
                    <div class="mb-4">
                        <p class="text-sm text-gray-600"><strong>Processor:</strong> {{ $product->processor }}</p>
                        <p class="text-sm text-gray-600"><strong>RAM:</strong> {{ $product->ram }}</p>
                        <p class="text-sm text-gray-600"><strong>Storage:</strong> {{ $product->storage }}</p>
                    </div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-2xl font-bold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <span class="text-sm text-gray-500">Stok: {{ $product->stock }}</span>
                    </div>
                    <a href="{{ route('products.show', $product) }}" class="block w-full bg-blue-600 text-white text-center py-2 rounded-lg hover:bg-blue-700 transition">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-20">
                <p class="text-xl text-gray-600">Belum ada produk tersedia.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $products->links() }}
        </div>
    </div>
</body>
</html>
