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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 8, 2); // Decimal untuk harga
            $table->unsignedInteger('stock'); // Menyimpan jumlah stok
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Menambahkan foreign key untuk category
            $table->foreignId('brand_id')->constrained()->onDelete('cascade'); // Menambahkan foreign key untuk brand
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
