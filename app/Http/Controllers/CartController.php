<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Product;
use App\Models\Cart;
use App\Models\UserTransaction;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class CartController extends Controller
{
    // Menambahkan produk ke keranjang
    public function addToCart(Request $request)
    {
        $product = Product::find($request->product['id']);
        $quantity = $request->quantity;

        // Cek apakah produk sudah ada di keranjang pengguna
        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($cart) {
            // Jika produk sudah ada, update quantity dan subtotal
            $cart->quantity += $quantity;
            $cart->subtotal = $cart->quantity * $cart->price;
            $cart->save();
        } else {
            // Jika produk belum ada, tambahkan produk baru ke keranjang
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->selling_price,
                'subtotal' => $product->selling_price * $quantity,
            ]);
        }

        Alert::success('Produk berhasil ditambahkan ke keranjang');
        return redirect()->route('user.dashboard');
    }

    public function getCartCount()
    {
        // Ambil semua produk di keranjang pengguna yang sedang login
        $cartCount = Cart::where('user_id', auth()->id())->sum('quantity');
        return $cartCount;
    }

    // Menampilkan keranjang
    public function index()
    {
        // Ambil keranjang pengguna dari database
        $cart = Cart::where('user_id', auth()->id())->get();
        $total = $cart->sum('subtotal'); // Hitung total harga

        return view('page.keranjang.index', compact('cart', 'total'));
    }

    // Mengupdate jumlah produk dalam keranjang
    public function update(Request $request, $id)
    {
        $quantity = $request->quantity;
        $cart = Cart::find($id);

        if ($cart) {
            $cart->quantity = $quantity;
            $cart->subtotal = $cart->quantity * $cart->price;
            $cart->save();
        }

        return redirect()->route('cart.index');
    }

    // Menghapus produk dari keranjang
    public function remove($id)
    {
        $cart = Cart::find($id);

        if ($cart) {
            $cart->delete();
        }

        // Recalculate total after removing product
        $total = 0;
        $cart = Cart::where('user_id', auth()->id())->get();
        $total = $cart->sum('subtotal');

        return redirect()->route('cart.index');
    }
}