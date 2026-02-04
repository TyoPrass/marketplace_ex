<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - LaptopKu</title>
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
                    <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-blue-600">Produk</a>
                    <a href="{{ route('buyer.orders.index') }}" class="text-blue-600 font-semibold">Pesanan Saya</a>
                    <form method="POST" action="/logout" class="inline">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-blue-600">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-6 py-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-8">Pesanan Saya</h1>

        @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded">
            <p class="text-green-700">{{ session('success') }}</p>
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
            <p class="text-red-700">{{ session('error') }}</p>
        </div>
        @endif

        @if($orders->count() > 0)
        <div class="space-y-6">
            @foreach($orders as $order)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <p class="text-sm text-gray-600">Nomor Order</p>
                            <p class="font-mono text-lg font-semibold text-blue-600">{{ $order->order_number }}</p>
                        </div>
                        <div class="text-right">
                            @if($order->status === 'pending')
                            <span class="px-4 py-2 bg-orange-100 text-orange-700 rounded-full text-sm font-semibold">Menunggu Verifikasi</span>
                            @elseif($order->status === 'verified')
                            <span class="px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold">Terverifikasi</span>
                            @elseif($order->status === 'processing')
                            <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">Diproses</span>
                            @elseif($order->status === 'shipped')
                            <span class="px-4 py-2 bg-purple-100 text-purple-700 rounded-full text-sm font-semibold">Dikirim</span>
                            @elseif($order->status === 'completed')
                            <span class="px-4 py-2 bg-teal-100 text-teal-700 rounded-full text-sm font-semibold">Selesai</span>
                            @else
                            <span class="px-4 py-2 bg-red-100 text-red-700 rounded-full text-sm font-semibold">Dibatalkan</span>
                            @endif
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex items-center space-x-6">
                            @if($order->product->image)
                            <img src="{{ asset('storage/' . $order->product->image) }}" alt="{{ $order->product->name }}" 
                                class="w-24 h-24 object-cover rounded-lg">
                            @else
                            <div class="w-24 h-24 bg-gray-200 rounded-lg flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                                </svg>
                            </div>
                            @endif

                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-800">{{ $order->product->name }}</h3>
                                <p class="text-gray-600">{{ $order->product->brand }}</p>
                                <p class="text-sm text-gray-600 mt-1">Jumlah: {{ $order->quantity }} unit</p>
                            </div>

                            <div class="text-right">
                                <p class="text-sm text-gray-600">Total Harga</p>
                                <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 mt-4 pt-4">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-600">
                                <p>Dipesan pada: {{ $order->created_at->format('d F Y, H:i') }}</p>
                                @if($order->verified_at)
                                <p class="mt-1">Diverifikasi pada: {{ $order->verified_at->format('d F Y, H:i') }}</p>
                                @endif
                            </div>
                            <a href="{{ route('buyer.orders.show', $order) }}" 
                                class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $orders->links() }}
        </div>
        @else
        <div class="bg-white rounded-xl shadow-lg p-12 text-center">
            <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
            </svg>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Pesanan</h3>
            <p class="text-gray-600 mb-6">Mulai belanja laptop impian Anda sekarang!</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                Lihat Produk
            </a>
        </div>
        @endif
    </div>
</body>
</html>
