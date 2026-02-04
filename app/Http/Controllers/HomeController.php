<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('status', 'active')
            ->latest()
            ->take(8)
            ->get();
        
        return view('home', compact('featuredProducts'));
    }
}
