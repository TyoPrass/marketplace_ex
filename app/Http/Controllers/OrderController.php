<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->with('product')->latest()->paginate(10);
        return view('buyer.orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'shipping_address' => 'required|string',
            'phone' => 'required|string',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($product->stock < $validated['quantity']) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        $totalPrice = $product->price * $validated['quantity'];

        $order = Order::create([
            'buyer_id' => auth()->id(),
            'product_id' => $product->id,
            'quantity' => $validated['quantity'],
            'total_price' => $totalPrice,
            'shipping_address' => $validated['shipping_address'],
            'phone' => $validated['phone'],
        ]);

        $product->decrement('stock', $validated['quantity']);

        return redirect()->route('buyer.orders.index')->with('success', 'Pesanan berhasil dibuat! Nomor order: ' . $order->order_number);
    }

    public function show(Order $order)
    {
        if ($order->buyer_id !== auth()->id()) {
            abort(403);
        }

        $order->load('product', 'verifier');
        return view('buyer.orders.show', compact('order'));
    }
}
