<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'full_name' => 'Andi Saputra',
                'email' => 'andi.saputra@gmail.com',
                'password' => bcrypt('password123'), // Gantilah dengan password dummy yang kamu inginkan
                'phone_number' => '081234567890',
                'street_address' => 'Jl. Melati No.7, Gg. Semangka',
                'city' => 'Bandung',
                'province' => 'Jawa Barat',
                'postal_code' => '40123',
                'membership_type' => 'regular',
                'registration_date' => Carbon::now(),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'full_name' => 'Budi Kurniawan',
                'email' => 'budi.kurniawan@example.com',
                'password' => bcrypt('password123'), 
                'phone_number' => '082345678901',
                'street_address' => 'Jl. Pahlawan No.5, Blok D',
                'city' => 'Yogyakarta',
                'province' => 'DI Yogyakarta',
                'postal_code' => '55223',
                'membership_type' => 'premium',
                'registration_date' => Carbon::now(),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'full_name' => 'Citra Wijaya',
                'email' => 'citra.wijaya@gmail.com',
                'password' => bcrypt('password123'),
                'phone_number' => '089876543210',
                'street_address' => 'Jl. Raya Cibubur No.10',
                'city' => 'Bekasi',
                'province' => 'Jawa Barat',
                'postal_code' => '17510',
                'membership_type' => 'regular',
                'registration_date' => Carbon::now(),
                'remember_token' => Str::random(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}