<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-900 text-white">
            <div class="p-6">
                <h2 class="text-2xl font-bold">Admin Panel</h2>
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="block px-6 py-3 hover:bg-gray-800 transition">
                    Dashboard
                </a>
                <a href="{{ route('admin.orders.index') }}" class="block px-6 py-3 bg-blue-600 hover:bg-blue-700 transition">
                    Kelola Pesanan
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto">
            <div class="p-8">
                <div class="mb-6">
                    <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:text-blue-700">← Kembali ke Daftar Pesanan</a>
                </div>

                <h1 class="text-3xl font-bold text-gray-800 mb-8">Detail Pesanan: {{ $order->order_number }}</h1>

                @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded">
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
                @endif

                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Order Info -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Informasi Pesanan</h2>
                        <div class="space-y-3">
                            <div>
                                <p class="text-gray-600 text-sm">Nomor Order</p>
                                <p class="font-semibold font-mono text-blue-600">{{ $order->order_number }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm">Status</p>
                                <p class="font-semibold">
                                    @if($order->status === 'pending')
                                    <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-sm">Pending</span>
                                    @elseif($order->status === 'verified')
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">Verified</span>
                                    @elseif($order->status === 'processing')
                                    <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm">Processing</span>
                                    @elseif($order->status === 'shipped')
                                    <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm">Shipped</span>
                                    @elseif($order->status === 'completed')
                                    <span class="px-3 py-1 bg-teal-100 text-teal-700 rounded-full text-sm">Completed</span>
                                    @else
                                    <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm">Cancelled</span>
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm">Tanggal Pesanan</p>
                                <p class="font-semibold">{{ $order->created_at->format('d F Y, H:i') }}</p>
                            </div>
                            @if($order->verified_at)
                            <div>
                                <p class="text-gray-600 text-sm">Diverifikasi Pada</p>
                                <p class="font-semibold">{{ $order->verified_at->format('d F Y, H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm">Diverifikasi Oleh</p>
                                <p class="font-semibold">{{ $order->verifier->name }}</p>
                            </div>
                            @endif
                            @if($order->notes)
                            <div>
                                <p class="text-gray-600 text-sm">Catatan Admin</p>
                                <p class="font-semibold">{{ $order->notes }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Informasi Produk</h2>
                        <div class="space-y-3">
                            <div>
                                <p class="text-gray-600 text-sm">Nama Produk</p>
                                <p class="font-semibold">{{ $order->product->name }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm">Brand</p>
                                <p class="font-semibold">{{ $order->product->brand }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm">Jumlah</p>
                                <p class="font-semibold">{{ $order->quantity }} unit</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm">Harga per Unit</p>
                                <p class="font-semibold">Rp {{ number_format($order->product->price, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm">Total Harga</p>
                                <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Buyer Info -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Informasi Pembeli</h2>
                        <div class="space-y-3">
                            <div>
                                <p class="text-gray-600 text-sm">Nama</p>
                                <p class="font-semibold">{{ $order->buyer->name }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm">Email</p>
                                <p class="font-semibold">{{ $order->buyer->email }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm">No. Telepon</p>
                                <p class="font-semibold">{{ $order->phone }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm">Alamat Pengiriman</p>
                                <p class="font-semibold">{{ $order->shipping_address }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4">Aksi Admin</h2>
                        
                        @if($order->status === 'pending')
                        <div class="space-y-4">
                            <form action="{{ route('admin.orders.verify', $order) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="verified">
                                <textarea name="notes" rows="3" placeholder="Catatan verifikasi (opsional)" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-3 focus:outline-none focus:border-blue-500"></textarea>
                                <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition">
                                    ✓ Verifikasi Pesanan
                                </button>
                            </form>

                            <form action="{{ route('admin.orders.verify', $order) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="cancelled">
                                <textarea name="notes" rows="3" placeholder="Alasan pembatalan (opsional)" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-3 focus:outline-none focus:border-red-500"></textarea>
                                <button type="submit" class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition"
                                    onclick="return confirm('Yakin ingin membatalkan pesanan ini?')">
                                    ✗ Batalkan Pesanan
                                </button>
                            </form>
                        </div>
                        @elseif($order->status === 'verified')
                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="processing">
                            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                                Ubah ke Processing
                            </button>
                        </form>
                        @elseif($order->status === 'processing')
                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="shipped">
                            <button type="submit" class="w-full bg-purple-600 text-white py-3 rounded-lg font-semibold hover:bg-purple-700 transition">
                                Ubah ke Shipped
                            </button>
                        </form>
                        @elseif($order->status === 'shipped')
                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" class="w-full bg-teal-600 text-white py-3 rounded-lg font-semibold hover:bg-teal-700 transition">
                                Tandai Selesai
                            </button>
                        </form>
                        @else
                        <div class="bg-gray-50 p-4 rounded-lg text-center">
                            <p class="text-gray-600">Tidak ada aksi yang tersedia untuk status ini</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
