<?php

namespace App\Http\Controllers;

use App\Models\UserTransaction;

class InvoiceController extends Controller
{
    public function show($order_id)
    {
        // Ambil data transaksi berdasarkan order_id
        $transaction = UserTransaction::where('transaction_id', $order_id)->firstOrFail();

        // Tampilkan halaman invoice
        return view('page.checkout.invoice', ['transaction' => $transaction]);
    }
}