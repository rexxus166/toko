<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat akun admin baru
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@miomidev.com',
            'password' => Hash::make('developer'), // Password admin
        ]);
    }
}