<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Cart;
use Midtrans\Config; // Pastikan ini ada di sini!
use Midtrans\Snap; // Ini untuk Snap API
use App\Models\UserTransaction;

class paymentController extends Controller
{
    // Halaman Checkout
    public function checkout()
    {
        // Ambil keranjang dan total
        $cart = Cart::where('user_id', auth()->id())->get();
        $total = $cart->sum('subtotal');

        // Pastikan keranjang tidak kosong sebelum melanjutkan
        if (empty($cart)) {
            Alert::error('Your cart is empty', 'Please add products to your cart before proceeding to checkout.');
            return redirect()->route('cart.index');
        }

        return view('page.checkout.index', compact('cart', 'total'));
    }

    // Proses Pembayaran
    public function processPayment(Request $request)
    {
        // Ambil keranjang dan total
        $cart = Cart::where('user_id', auth()->id())->get();
        $total = $cart->sum('subtotal') + 2000; // Tambahkan fee jika ada

        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = false; // Set true jika di production

        // Membuat transaksi di Midtrans
        $transaction_details = array(
            'order_id' => 'ORDER-' . uniqid(),
            'gross_amount' => $total, // Total amount yang dibayar
        );

        // Detil barang
        $items = [];
        foreach ($cart as $item) {
            $items[] = array(
                'id' => $item->product_id,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'name' => $item->product->name,
            );
        }

        // Detail pembayaran
        $payment_type = 'credit_card'; // Kamu bisa menggunakan berbagai jenis pembayaran lainnya
        $credit_card = array(
            'secure' => true,
        );

        // Membuat Snap Transaction
        $params = array(
            'transaction_details' => $transaction_details,
            'item_details' => $items,
            'payment_type' => $payment_type,
            'credit_card' => $credit_card,
        );

        // Menyimpan transaksi ke database
        $transaction = UserTransaction::create([
            'user_id' => auth()->id(),
            'transaction_id' => 'ORDER-' . uniqid(),  // Menggunakan ID transaksi unik
            'total' => $total,
            'status' => 'pending',
            'payment_url' => null,  // Bisa diupdate nanti jika ada URL pembayaran
        ]);

        // Membuat Snap Token
        $snapToken = Snap::getSnapToken($params);

        // Mengirimkan Snap Token sebagai response JSON
        return response()->json(['snap_token' => $snapToken]);
    }

    // Handle callback dari Midtrans
}