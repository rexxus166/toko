<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\BarangKeluar;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class BarangKeluarController extends Controller
{
    // Menampilkan halaman barang keluar
    public function index()
    {
        $products = Product::all();
        $members = User::all();
        $barangKeluar = BarangKeluar::all();
        return view('admin.barangKeluar.index', compact('products', 'members', 'barangKeluar'));
    }

    // Method untuk menyimpan data barang keluar
    public function store(Request $request)
    {
        // Validasi data yang dimasukkan untuk banyak produk
        $request->validate([
            'customer_type' => 'required|string',
            'transaction_id' => 'required|string',
            'date' => 'required|date',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:0',
        ]);

        // Membuat Transaction ID dengan format yang diinginkan
        $transactionId = $request->transaction_id;  // Menggunakan Transaction ID dari form

        // Ambil data customer (jika tipe customer adalah 'member', maka ambil data member)
        $customer = null;
        if ($request->customer_type == 'member') {
            $customer = User::find($request->customer_id);
        }

        // Mulai transaksi dan periksa stok untuk setiap produk
        foreach ($request->products as $productData) {
            // Ambil data produk
            $product = Product::findOrFail($productData['product_id']);

            // Pengecekan apakah stok cukup
            if ($productData['quantity'] > $product->stock) {
                // Redirect kembali dengan pesan error jika stok tidak mencukupi
                Alert::error('Transaksi Gagal', 'Stok produk ' . $product->name . ' tidak mencukupi!');
                return redirect()->back();
            }

            // Hitung total harga untuk setiap produk
            $totalPrice = $productData['quantity'] * $productData['price'];

            // Simpan data barang keluar untuk setiap produk
            BarangKeluar::create([
                'product_id' => $product->id,
                'membership_type' => $request->customer_type,
                'user_id' => $customer ? $customer->id : null, // Jika member, simpan ID member
                'quantity' => $productData['quantity'],
                'selling_price' => $productData['price'],
                'total_price' => $totalPrice,
                'transaction_id' => $transactionId,
                'date' => $request->date,
            ]);

            // Mengurangi stok produk setelah transaksi
            $product->stock -= $productData['quantity'];
            $product->save();
        }

        // Jika berhasil, beri pesan sukses
        Alert::success('Transaksi Berhasil', 'Barang keluar berhasil dicatat!');
        return redirect()->route('admin.barang-keluar');
    }
}