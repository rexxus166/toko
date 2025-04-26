<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id', 'product_id', 'quantity', 'price', 'subtotal'
    ];

    // Relasi dengan tabel Transaction
    public function transaction()
    {
        return $this->belongsTo(UserTransaction::class, 'transaction_id');
    }

    // Relasi dengan tabel Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}