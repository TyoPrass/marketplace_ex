<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - LaptopKu</title>
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
                    <a href="{{ route('buyer.orders.index') }}" class="text-blue-600 font-semibold">Pesanan Saya</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-6 py-12">
        <div class="mb-6">
            <a href="{{ route('buyer.orders.index') }}" class="text-blue-600 hover:text-blue-700">← Kembali ke Pesanan Saya</a>
        </div>

        <h1 class="text-4xl font-bold text-gray-800 mb-8">Detail Pesanan</h1>

        <div class="grid md:grid-cols-2 gap-8">
            <!-- Order Info -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Informasi Pesanan</h2>
                <div class="space-y-4">
                    <div>
                        <p class="text-gray-600 text-sm">Nomor Order</p>
                        <p class="font-mono text-lg font-semibold text-blue-600">{{ $order->order_number }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Status</p>
                        <p class="mt-1">
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
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Tanggal Pesanan</p>
                        <p class="font-semibold text-gray-800">{{ $order->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    @if($order->verified_at)
                    <div>
                        <p class="text-gray-600 text-sm">Tanggal Verifikasi</p>
                        <p class="font-semibold text-gray-800">{{ $order->verified_at->format('d F Y, H:i') }}</p>
                    </div>
                    @endif
                    @if($order->notes)
                    <div>
                        <p class="text-gray-600 text-sm">Catatan dari Admin</p>
                        <p class="font-semibold text-gray-800">{{ $order->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Detail Produk</h2>
                
                @if($order->product->image)
                <img src="{{ asset('storage/' . $order->product->image) }}" alt="{{ $order->product->name }}" 
                    class="w-full h-48 object-cover rounded-lg mb-4">
                @else
                <div class="w-full h-48 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center rounded-lg mb-4">
                    <svg class="w-20 h-20 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                    </svg>
                </div>
                @endif

                <div class="space-y-3">
                    <div>
                        <p class="text-gray-600 text-sm">Nama Produk</p>
                        <p class="font-semibold text-gray-800 text-lg">{{ $order->product->name }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Brand</p>
                        <p class="font-semibold text-gray-800">{{ $order->product->brand }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-600 text-sm">Jumlah</p>
                            <p class="font-semibold text-gray-800">{{ $order->quantity }} unit</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-sm">Harga per Unit</p>
                            <p class="font-semibold text-gray-800">Rp {{ number_format($order->product->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="border-t pt-3">
                        <p class="text-gray-600 text-sm">Total Harga</p>
                        <p class="text-3xl font-bold text-blue-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- Shipping Info -->
            <div class="bg-white rounded-xl shadow-lg p-8 md:col-span-2">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Informasi Pengiriman</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-gray-600 text-sm mb-2">Alamat Pengiriman</p>
                        <p class="font-semibold text-gray-800">{{ $order->shipping_address }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm mb-2">No. Telepon</p>
                        <p class="font-semibold text-gray-800">{{ $order->phone }}</p>
                    </div>
                </div>
            </div>

            <!-- Order Timeline -->
            <div class="bg-white rounded-xl shadow-lg p-8 md:col-span-2">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Timeline Pesanan</h2>
                <div class="space-y-4">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Pesanan Dibuat</p>
                            <p class="text-gray-600 text-sm">{{ $order->created_at->format('d F Y, H:i') }}</p>
                        </div>
                    </div>

                    @if($order->verified_at)
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Pesanan Diverifikasi</p>
                            <p class="text-gray-600 text-sm">{{ $order->verified_at->format('d F Y, H:i') }}</p>
                        </div>
                    </div>
                    @endif

                    @if(in_array($order->status, ['processing', 'shipped', 'completed']))
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">
                                @if($order->status === 'completed') Pesanan Selesai
                                @elseif($order->status === 'shipped') Pesanan Dikirim
                                @else Pesanan Diproses
                                @endif
                            </p>
                            <p class="text-gray-600 text-sm">Status terkini dari pesanan Anda</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
