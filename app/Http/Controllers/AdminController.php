<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalProducts = Product::count();
        $totalSellers = User::where('role', 'seller')->count();
        $totalBuyers = User::where('role', 'buyer')->count();
        
        return view('admin.dashboard', compact('totalOrders', 'pendingOrders', 'totalProducts', 'totalSellers', 'totalBuyers'));
    }

    public function orders()
    {
        $orders = Order::with(['buyer', 'product', 'verifier'])->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function showOrder(Order $order)
    {
        $order->load(['buyer', 'product', 'verifier']);
        return view('admin.orders.show', compact('order'));
    }

    public function verifyOrder(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:verified,cancelled',
            'notes' => 'nullable|string',
        ]);

        $order->update([
            'status' => $validated['status'],
            'verified_at' => now(),
            'verified_by' => auth()->id(),
            'notes' => $validated['notes'] ?? null,
        ]);

        $message = $validated['status'] === 'verified' 
            ? 'Pesanan berhasil diverifikasi!' 
            : 'Pesanan dibatalkan!';

        return redirect()->route('admin.orders.index')->with('success', $message);
    }

    public function updateOrderStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:processing,shipped,completed,cancelled',
        ]);

        $order->update(['status' => $validated['status']]);

        return redirect()->route('admin.orders.show', $order)->with('success', 'Status pesanan berhasil diupdate!');
    }
}
