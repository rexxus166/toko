<?php

namespace App\Http\Controllers;

use App\Models\UserTransaction;

class InvoiceController extends Controller
{
    public function show($order_id)
    {
        // Ambil data transaksi berdasarkan order_id
        $transaction = UserTransaction::where('transaction_id', $order_id)->firstOrFail();

        // Mapping untuk payment method
        $paymentMethods = [
            'bank_transfer' => 'Bank Transfer',
            'qris' => 'Qris',
            'credit_card' => 'Credit Card',
            // Tambahkan metode pembayaran lainnya jika diperlukan
        ];

        // Cek apakah payment_method ada dalam mapping, jika tidak, set sebagai 'Unknown'
        $paymentMethodName = $paymentMethods[$transaction->payment_method] ?? 'Unknown Payment Method';

        // Tentukan tampilan berdasarkan status transaksi
        if ($transaction->status == 'success') {
            // Jika status transaksi 'success', tampilkan invoice sukses
            return view('page.checkout.invoice_success', ['transaction' => $transaction, 'paymentMethodName' => $paymentMethodName]);
        } elseif ($transaction->status == 'pending') {
            // Jika status transaksi 'pending', tampilkan invoice pending
            return view('page.checkout.invoice_pending', ['transaction' => $transaction, 'paymentMethodName' => $paymentMethodName]);
        } elseif ($transaction->status == 'failed') {
            // Jika status transaksi 'failed', tampilkan invoice failed
            return view('page.checkout.invoice_failed', ['transaction' => $transaction]);
        }

        // Jika status tidak terdeteksi, redirect atau tampilkan halaman error (opsional)
        return redirect()->route('cart.index');
    }
}