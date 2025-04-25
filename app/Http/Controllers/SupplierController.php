<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SupplierController extends Controller
{
    // Tampilkan halaman daftar supplier
    public function index()
    {
        $suppliers = Supplier::all(); // Ambil semua data supplier
        return view('admin.supplier.index', compact('suppliers'));
    }

    // Form untuk tambah supplier baru
    public function create()
    {
        return view('admin.supplier.create');
    }

    // Simpan supplier baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Supplier::create([
            'name' => $request->name,
        ]);

        Alert::success('Success', 'Berhasil Menambahkan Supplier!');
        return redirect()->route('admin.supplier');
    }

    // Form untuk edit supplier
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.supplier.edit', compact('supplier'));
    }

    // Update supplier
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update([
            'name' => $request->name,
        ]);

        Alert::success('Success', 'Supplier Berhasil di Update!');
        return redirect()->route('admin.supplier');
    }

    // Hapus supplier
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        Alert::success('Success', 'Supplier Berhasil di Hapus!');
        return redirect()->route('admin.supplier');
    }
}