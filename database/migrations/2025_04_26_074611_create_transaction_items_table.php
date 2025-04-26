<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->onDelete('cascade');  // Menyambungkan dengan tabel transactions
            $table->foreignId('product_id')->constrained()->onDelete('cascade');  // Menyambungkan dengan tabel products
            $table->integer('quantity')->default(1);  // Jumlah produk yang dibeli
            $table->decimal('price', 10, 2);  // Harga produk per item
            $table->decimal('subtotal', 10, 2);  // Subtotal per produk
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_items');
    }
};
