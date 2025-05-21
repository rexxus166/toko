<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    // Menampilkan halaman produk
    public function produk()
    {
        $produk = Product::all();
        return view('admin.produk.index', compact('produk'));
    }

    // Menampilkan halaman produk di Guest
    public function showProducts()
    {
        // Mengambil data produk untuk guest
        $products = Product::paginate(10);  // Sesuaikan dengan kebutuhan pagination

        return view('produk', compact('products'));
    }

    // Menampilkan halaman form untuk menambah produk baru
    public function newProduk()
    {
        return view('admin.produk.addProduk');
    }

    public function store(Request $request)
    {
        // Validasi data produk
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category' => 'required|string',
            'brand' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'initial_stock' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000', // Validasi gambar
            'unit' => 'required|string',
            'min_stock_alert' => 'required|integer',
        ]);

        // Menyimpan data produk
        $product = new Product();
        $product->name = $request->product_name;
        $product->category = $request->category;
        $product->brand = $request->brand;
        $product->sku = $request->sku;
        $product->purchase_price = $request->purchase_price;
        $product->selling_price = $request->selling_price;
        $product->stock = $request->initial_stock;
        $product->description = $request->description; // Menyimpan deskripsi
        $product->unit = $request->unit;
        $product->min_stock_alert = $request->min_stock_alert;

        // Cek apakah ada file gambar yang di-upload
        if ($request->hasFile('image')) {
            // Mendapatkan file yang di-upload
            $image = $request->file('image');

            // Generate nama gambar yang unik
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension(); // Mendapatkan ekstensi asli file

            // Pindahkan file gambar ke folder public/imgProduk
            $image->move(public_path('imgProduk'), $imageName);

            // Menyimpan path gambar di kolom image
            $product->image = 'imgProduk/' . $imageName;  // Path relatif untuk disimpan di database
        }

        $product->save(); // Simpan produk ke database

        // Redirect setelah berhasil
        Alert::success('Success', 'Berhasil Menambahkan Produk!');
        return redirect()->route('admin.produk');
    }

    public function edit($id)
    {
        $product = Product::find($id); // Ambil produk berdasarkan ID
        if ($product) {
            return view('admin.produk.edit', compact('product')); // Pastikan produk dikirim ke view
        } else {
            return redirect()->route('admin.produk.index')->with('error', 'Product not found');
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id); // Temukan produk berdasarkan ID

        // Validasi data produk
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category' => 'required|string',
            'brand' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'purchase_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'initial_stock' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5000',
            'unit' => 'required|string',
            'min_stock_alert' => 'required|integer',
        ]);

        // Update produk
        $product->name = $request->product_name;
        $product->category = $request->category;
        $product->brand = $request->brand;
        $product->sku = $request->sku;
        $product->purchase_price = $request->purchase_price;
        $product->selling_price = $request->selling_price;
        $product->stock = $request->initial_stock;
        $product->description = $request->description;
        $product->unit = $request->unit;
        $product->min_stock_alert = $request->min_stock_alert;

        // Handle image upload if exists
        if ($request->hasFile('image')) {
            $imageName = uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('imgProduk'), $imageName);
            $product->image = 'imgProduk/' . $imageName;
        }

        $product->save(); // Simpan perubahan

        Alert::success('Success', 'Berhasil Mengubah Produk!');
        return redirect()->route('admin.produk');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id); // Menemukan produk berdasarkan ID
        $product->delete(); // Menghapus produk

        Alert::success('Success', 'Berhasil Menghapus Produk!');
        return redirect()->route('admin.produk');
    }

}
