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
        Schema::create('barang_masuks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Produk yang masuk
            $table->foreignId('supplier_id')->constrained()->onDelete('cascade'); // Supplier dari barang
            $table->integer('quantity'); // Kuantitas barang
            $table->decimal('purchase_price', 15, 2); // Harga beli barang
            $table->date('date'); // Tanggal barang masuk
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_masuks');
    }
};
