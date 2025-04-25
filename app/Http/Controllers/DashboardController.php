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
}