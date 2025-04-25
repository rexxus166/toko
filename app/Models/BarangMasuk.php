<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'supplier_id', 'quantity', 'purchase_price', 'date'];

    // Relasi dengan model Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi dengan model Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}