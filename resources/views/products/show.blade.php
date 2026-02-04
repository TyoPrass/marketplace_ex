<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - LaptopKu</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <a href="/" class="text-2xl font-bold text-gray-800">Laptop<span class="text-blue-600">Ku</span></a>
                <div class="flex items-center space-x-6">
                    <a href="/" class="text-gray-700 hover:text-blue-600">Beranda</a>
                    <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-blue-600">Produk</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-6 py-12">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="grid md:grid-cols-2 gap-8 p-8">
                <!-- Product Image -->
                <div>
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full rounded-lg">
                    @else
                    <div class="w-full h-96 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center rounded-lg">
                        <svg class="w-32 h-32 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                        </svg>
                    </div>
                    @endif
                </div>

                <!-- Product Details -->
                <div>
                    <span class="text-blue-600 font-semibold text-lg">{{ $product->brand }}</span>
                    <h1 class="text-4xl font-bold text-gray-800 mt-2 mb-4">{{ $product->name }}</h1>
                    
                    <div class="mb-6">
                        <span class="text-4xl font-bold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    </div>

                    <div class="mb-6">
                        <p class="text-gray-700 leading-relaxed">{{ $product->description }}</p>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg mb-6">
                        <h3 class="font-bold text-gray-800 mb-4">Spesifikasi:</h3>
                        <ul class="space-y-2">
                            <li class="flex items-center">
                                <span class="w-32 text-gray-600">Processor:</span>
                                <span class="font-semibold">{{ $product->processor }}</span>
                            </li>
                            <li class="flex items-center">
                                <span class="w-32 text-gray-600">RAM:</span>
                                <span class="font-semibold">{{ $product->ram }}</span>
                            </li>
                            <li class="flex items-center">
                                <span class="w-32 text-gray-600">Storage:</span>
                                <span class="font-semibold">{{ $product->storage }}</span>
                            </li>
                            @if($product->gpu)
                            <li class="flex items-center">
                                <span class="w-32 text-gray-600">GPU:</span>
                                <span class="font-semibold">{{ $product->gpu }}</span>
                            </li>
                            @endif
                            <li class="flex items-center">
                                <span class="w-32 text-gray-600">Layar:</span>
                                <span class="font-semibold">{{ $product->screen_size }}</span>
                            </li>
                            <li class="flex items-center">
                                <span class="w-32 text-gray-600">Stok:</span>
                                <span class="font-semibold {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $product->stock }} unit
                                </span>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-blue-50 p-4 rounded-lg mb-6">
                        <p class="text-sm text-gray-600">Dijual oleh:</p>
                        <p class="font-semibold text-gray-800">{{ $product->seller->name }}</p>
                    </div>

                    @auth
                        @if(auth()->user()->isBuyer())
                            @if($product->stock > 0)
                            <button onclick="document.getElementById('orderModal').classList.remove('hidden')" class="w-full bg-blue-600 text-white py-4 rounded-lg font-semibold hover:bg-blue-700 transition text-lg">
                                Beli Sekarang
                            </button>
                            @else
                            <button disabled class="w-full bg-gray-400 text-white py-4 rounded-lg font-semibold cursor-not-allowed text-lg">
                                Stok Habis
                            </button>
                            @endif
                        @endif
                    @else
                        <a href="/login" class="block w-full bg-blue-600 text-white text-center py-4 rounded-lg font-semibold hover:bg-blue-700 transition text-lg">
                            Login untuk Membeli
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Order Modal -->
    @auth
    @if(auth()->user()->isBuyer())
    <div id="orderModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl p-8 max-w-md w-full mx-4">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Formulir Pemesanan</h2>
            
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Jumlah</label>
                    <input type="number" name="quantity" min="1" max="{{ $product->stock }}" value="1" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Alamat Pengiriman</label>
                    <textarea name="shipping_address" rows="3" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">{{ auth()->user()->address }}</textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">No. Telepon</label>
                    <input type="text" name="phone" value="{{ auth()->user()->phone }}" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                </div>

                <div class="flex space-x-4">
                    <button type="button" onclick="document.getElementById('orderModal').classList.add('hidden')"
                        class="flex-1 bg-gray-300 text-gray-700 py-3 rounded-lg font-semibold hover:bg-gray-400 transition">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                        Pesan Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
    @endauth
</body>
</html>
