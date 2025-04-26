<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Cart;
use Midtrans\Config; // Pastikan ini ada di sini!
use Midtrans\Snap; // Ini untuk Snap API
use App\Models\UserTransaction;
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
        ]);

        // Membuat Snap Token
        $snapToken = Snap::getSnapToken($params);

        // Mengirimkan Snap Token sebagai response JSON
        return response()->json(['snap_token' => $snapToken]);
    }

    // Handle callback dari Midtrans
    // public function callback(Request $request)
    // {
    //     $serverKey = config('midtrans.server_key');
    //     $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

    //     if($hashed == $request->signature_key) {
    //         if($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
    //             $transaction = UserTransaction::where('transaction_id', $request->order_id)->first();

    //             // Periksa apakah transaksi ditemukan
    //             if ($transaction) {
    //                 $transaction->update(['status' => 'success']);
    //                 $transaction->save();
    //             } else {
    //                 // Tangani jika transaksi tidak ditemukan
    //                 // Misalnya, log atau beri respons error
    //                 Log::error("Transaksi dengan order_id {$request->order_id} tidak ditemukan.");
    //                 return response()->json(['error' => 'Transaction not found'], 404);
    //             }
    //         }
    //     }
    // }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $transaction = UserTransaction::where('transaction_id', $request->order_id)->first();

                // Periksa apakah transaksi ditemukan
                if ($transaction) {
                    // Update status transaksi
                    $transaction->update(['status' => 'success']);

                    // Generate URL invoice berdasarkan order_id
                    $invoiceUrl = route('invoice.show', ['order_id' => $transaction->transaction_id]);

                    // Simpan URL invoice ke database
                    $transaction->invoice_url = $invoiceUrl;
                    $transaction->save(); // Pastikan untuk menyimpan perubahan

                    // Redirect user ke halaman invoice
                    return redirect($invoiceUrl);
                } else {
                    Log::error("Transaksi dengan order_id {$request->order_id} tidak ditemukan.");
                    return response()->json(['error' => 'Transaction not found'], 404);
                }
            }
        }
    }
}