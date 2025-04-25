<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    // Menambahkan atribut yang boleh diisi secara massal
    protected $fillable = [
        'product_id',
        'membership_type',
        'user_id',
        'quantity',
        'selling_price',
        'total_price',
        'date',
        'transaction_id',
    ];

    // Relasi dengan Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Relasi dengan User (Customer)
    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}