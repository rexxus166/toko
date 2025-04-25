<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'category', 'brand', 'sku', 'purchase_price', 'selling_price',
        'stock', 'description', 'image', 'unit', 'min_stock_alert',
    ];
}
