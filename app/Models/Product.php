<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'category', 'brand', 'sku', 'purchase_price', 'selling_price',
        'stock', 'description', 'image', 'unit', 'min_stock_alert',
    ];

    // Relasi ke model Cart
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class, 'product_id');
    }
}
