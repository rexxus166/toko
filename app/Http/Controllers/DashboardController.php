<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        // Tampilkan dashboard admin
        $totalMembers = User::count();
        $totalProducts = Product::count();
        return view('admin.index', compact('totalMembers', 'totalProducts'));
    }

    public function member()
    {
        $members = User::paginate(10);
        return view('admin.member.index', compact('members'));
    }

    public function newMember()
    {
        return view('admin.member.addMember');
    }

    public function editMember($id)
    {
        // Ambil data member berdasarkan ID
        $member = User::findOrFail($id);

        // Kembalikan ke halaman edit dengan data member
        return view('admin.member.edit', compact('member'));
    }

    public function updateMember(Request $request, $id)
{
    // Validasi input dari form edit
    $validatedData = $request->validate([
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $id,
        'phone_number' => 'required|string|max:15',
        'street_address' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'province' => 'required|string|max:255',
        'postal_code' => 'required|string|max:10',
        'membership_type' => 'required|string|max:255',
        'registration_date' => 'required|date', // Validasi tanggal jika perlu
        // Password opsional, jika diisi maka validasi panjangnya
        'password' => 'nullable|min:6',
    ]);

    // Temukan member berdasarkan ID dan update datanya
    $member = User::findOrFail($id);

    // Update data member
    $member->full_name = $validatedData['full_name'];
    $member->email = $validatedData['email'];
    $member->phone_number = $validatedData['phone_number'];
    $member->street_address = $validatedData['street_address'];
    $member->city = $validatedData['city'];
    $member->province = $validatedData['province'];
    $member->postal_code = $validatedData['postal_code'];
    $member->membership_type = $validatedData['membership_type'];
    $member->registration_date = $validatedData['registration_date'];

    // Cek jika password diinput, jika ya, hash dan update password
    if ($request->has('password') && $request->password != '') {
        $member->password = bcrypt($validatedData['password']);
    }

    // Simpan perubahan data member
    $member->save();

    // Redirect ke halaman member dengan pesan sukses
    return redirect()->route('admin.member')->with('success', 'Member updated successfully.');
}

    public function deleteMember($id)
    {
        // Temukan member berdasarkan ID dan hapus
        $member = User::findOrFail($id);
        $member->delete();

        // Redirect ke halaman member dengan pesan sukses
        return redirect()->route('admin.member')->with('success', 'Member deleted successfully.');
    }
}