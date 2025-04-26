<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Cart;
use App\Models\UserTransaction;
use App\Models\TransactionItem;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Log;

class paymentController extends Controller
{
    // Halaman Checkout
    public function checkout()
    {
        // Ambil keranjang dan total
        $cart = Cart::where('user_id', auth()->id())->get();
        $total = $cart->sum('subtotal');

        // Pastikan keranjang tidak kosong sebelum melanjutkan
        if ($cart->isEmpty()) {
            Alert::error('Your cart is empty', 'Please add products to your cart before proceeding to checkout.');
            return redirect()->route('cart.index');
        }

        // Kirim data ke halaman checkout
        return view('page.checkout.index', compact('cart', 'total'));
    }

    // Proses Pembayaran
    public function processPayment(Request $request)
    {
        // Ambil keranjang dan total
        $cart = Cart::where('user_id', auth()->id())->get();
        $total = $cart->sum('subtotal');
        $fee = 2000;  // Fee admin

        // Hitung total akhir dengan fee admin
        $finalTotal = $total + $fee;

        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = false; // Set true jika di production

        // Membuat transaksi di Midtrans
        $transaction_details = array(
            'order_id' => 'ORDER-' . uniqid(),
            'gross_amount' => $finalTotal, // Total amount yang dibayar
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

        // Menambahkan fee admin
        $items[] = [
            'id' => 'fee',
            'name' => 'Admin Fee',
            'price' => $fee,
            'quantity' => 1,
        ];

        // Detail pembayaran
        $payment_type = 'credit_card'; // Kamu bisa menggunakan berbagai jenis pembayaran lainnya, ganti ini dengan pilihan yang sesuai
        $credit_card = array(
            'secure' => true,
        );

        // Membuat Snap Transaction
        $params = array(
            'transaction_details' => $transaction_details,
            'item_details' => $items,
            'payment_type' => $payment_type,
            'credit_card' => $credit_card,
            'customer_details' => array(
                'first_name' => auth()->user()->full_name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->phone_number,
            ),
        );

        // Menyimpan transaksi ke database
        $transaction = UserTransaction::create([
            'user_id' => auth()->id(),
            'transaction_id' => $transaction_details['order_id'], // Menggunakan order_id dari transaksi Midtrans
            'total' => $finalTotal,
            'status' => 'pending',
            'payment_url' => null,  // Bisa diupdate nanti jika ada URL pembayaran
            'payment_method' => $payment_type,  // Menyimpan payment method
            'expire_time' => now()->addMinutes(15),  // Misalnya 15 menit setelah transaksi dibuat, disesuaikan dengan waktu kadaluarsa Midtrans
        ]);

        // Pindahkan data produk dari keranjang ke transaction_items
        foreach ($cart as $item) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'subtotal' => $item->subtotal,
            ]);
        }

        // Hapus keranjang setelah transaksi selesai
        Cart::where('user_id', auth()->id())->delete();  // Mengosongkan keranjang pengguna

        // Membuat Snap Token
        $snapToken = Snap::getSnapToken($params);

        // Mengirimkan Snap Token sebagai response JSON
        return response()->json(['snap_token' => $snapToken]);
    }

    // Callback
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $transaction = UserTransaction::where('transaction_id', $request->order_id)->first();

            // Periksa apakah transaksi ditemukan
            if ($transaction) {
                // Simpan payment_method dari Midtrans
                $transaction->payment_method = $request->payment_type;  // Simpan payment_type ke database
                $transaction->expiry_time = $request->expiry_time;  // Simpan expiry_time ke database
                $transaction->save();

                // Lakukan pengecekan status transaksi
                if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                    $transaction->update(['status' => 'success']);
                    // Mengurangi stok produk jika transaksi berhasil
                    $this->updateProductStock($transaction);
                } elseif ($request->transaction_status == 'cancel') {
                    $transaction->update(['status' => 'failed']);
                    // Tidak ada pengurangan stok jika transaksi dibatalkan
                } elseif ($request->transaction_status == 'pending') {
                    $transaction->update(['status' => 'pending']);
                }
            } else {
                // Tangani jika transaksi tidak ditemukan
                Log::error("Transaksi dengan order_id {$request->order_id} tidak ditemukan.");
                return response()->json(['error' => 'Transaction not found'], 404);
            }
        }
    }

    private function updateProductStock($transaction)
    {
        // Pindahkan data produk dari transaction_items dan kurangi stok produk
        foreach ($transaction->items as $item) {
            $product = $item->product;
            $product->stock -= $item->quantity;
            $product->save();
        }
    }
}