<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MemberController extends Controller
{
    // Menampilkan form untuk menambahkan anggota baru
    public function create()
    {
        return view('admin.add-member');
    }

    // Menyimpan data anggota baru
    public function store(Request $request)
    {
        // Validasi data yang dimasukkan
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|max:15',
            'password' => 'required|string|min:8',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'membership_type' => 'required|string',
            'registration_date' => 'required|date',
        ]);

        // Membuat anggota baru
        $member = new User();
        $member->full_name = $request->full_name;
        $member->email = $request->email;
        $member->phone_number = $request->phone_number;
        $member->password = $request->password;
        $member->street_address = $request->street_address;
        $member->city = $request->city;
        $member->province = $request->province;
        $member->postal_code = $request->postal_code;
        $member->membership_type = $request->membership_type;
        $member->registration_date = $request->registration_date;
        $member->save();

        Alert::success('Success', 'Member added successfully!');
        return redirect()->route('admin.member');
    }
}