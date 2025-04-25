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
        Schema::create('barang_keluars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Produk yang keluar
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); // Menyimpan ID user jika customer adalah member
            $table->string('membership_type')->default('regular'); // Menyimpan tipe customer, bisa 'member' atau 'regular'
            $table->integer('quantity'); // Kuantitas barang keluar
            $table->decimal('selling_price', 15, 2); // Harga jual barang
            $table->decimal('total_price', 15, 2)->nullable();  // Menambahkan kolom total_price
            $table->string('transaction_id'); // Transaction ID otomatis
            $table->date('date'); // Tanggal barang keluar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_keluars');
    }
};
