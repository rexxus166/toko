<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BarangMasukController extends Controller
{
    // Menampilkan halaman barang masuk
    public function index()
    {
        $produk = Product::all(); // Ambil semua produk
        $supplier = Supplier::all(); // Ambil semua supplier
        $barangMasuk = BarangMasuk::all(); // Ambil semua data barang masuk
        return view('admin.barangMasuk.index', compact('produk', 'supplier', 'barangMasuk'));
    }

    // Menyimpan data barang masuk
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'date' => 'required|date',
        ]);

        // Ambil data produk yang dipilih
        $product = Product::findOrFail($request->product_id);

        // Ambil stok produk dari database
        $stok_sekarang = $product->stock;  // Ambil stok saat ini dari produk

        // Simpan data barang masuk dengan stok yang ada
        BarangMasuk::create([
            'product_id' => $request->product_id,
            'supplier_id' => $request->supplier_id,
            'quantity' => $stok_sekarang,  // Menyimpan quantity sesuai dengan stok produk
            'purchase_price' => $product->purchase_price,  // Ambil harga beli dari produk
            'date' => $request->date,
        ]);

        // Redirect kembali dengan pesan sukses
        Alert::success('Success', 'Berhasil Menambahkan Barang Masuk!');
        return redirect()->route('admin.barang-masuk');
    }
}