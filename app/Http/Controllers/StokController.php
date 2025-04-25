<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class StokController extends Controller
{
    public function index()
    {
        $products = Product::all();
        // Ambil produk dengan stok rendah
        $lowStockProducts = Product::where('stock', '<=', \DB::raw('min_stock_alert'))->get();
        return view('admin.stok.index', compact('products', 'lowStockProducts'));
    }
}
