<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangKeluar;

class TransaksiController extends Controller
{
    public function index()
    {
        // Ambil semua transaksi yang dikelompokkan berdasarkan transaction_id
        $transaksi = BarangKeluar::select('transaction_id', 'date', 'membership_type', 'user_id')
            ->groupBy('transaction_id', 'date', 'membership_type', 'user_id')
            ->get();

        // Tambahkan total harga untuk setiap transaksi
        foreach ($transaksi as $item) {
            $totalPrice = BarangKeluar::where('transaction_id', $item->transaction_id)
                ->sum('total_price');
            $item->total_price = $totalPrice;

            // Ambil customer berdasarkan user_id
            if ($item->membership_type == 'member' && $item->user_id) {
                $item->customer = $item->customer;  // Menampilkan customer terkait
            } else {
                $item->customer = null;  // Untuk regular customer
            }
        }

        return view('admin.transaksi.index', compact('transaksi'));
    }

    public function show($transactionId)
    {
        // Ambil semua produk berdasarkan transaction_id
        $barangKeluar = BarangKeluar::where('transaction_id', $transactionId)->get();

        // Hitung total harga transaksi (sum total_price dari semua produk)
        $totalPrice = $barangKeluar->sum('total_price');

        return view('admin.transaksi.show', compact('barangKeluar', 'transactionId', 'totalPrice'));
    }
}
