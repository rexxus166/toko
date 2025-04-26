<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\UserTransaction;
use App\Models\Cart;

class UserController extends Controller
{
    public function dashboard(Request $request)
    {
        // Ambil produk yang ada di database
        $products = Product::query();

        // Filter berdasarkan kategori
        if ($request->has('category') && $request->category != '') {
            $products->where('category', $request->category);
            $categories = Product::distinct()->pluck('category');
        } else {
            $categories = Product::distinct()->pluck('category');
        }

        // Filter berdasarkan rentang harga
        if ($request->has('price_range') && $request->price_range != '') {
            $range = explode('-', $request->price_range);
            $products->whereBetween('price', [intval($range[0]), intval($range[1])]);
        }

        // Ambil produk yang sudah difilter atau semua produk
        $products = $products->paginate(12); // Atur pagination sesuai kebutuhan
        $cartCount = Cart::where('user_id', auth()->id())->sum('quantity');

        return view('page.dashboard.index', compact('products', 'categories', 'cartCount'));
    }

    public function order(Request $request)
    {
        // Mengambil transaksi hanya untuk user yang sedang login
        $transactions = UserTransaction::where('user_id', auth()->id())->get();
        
        return view('page.riwayat-transaksi.index', compact('transactions'));
    }
}