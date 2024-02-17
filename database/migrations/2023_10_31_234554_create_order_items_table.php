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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_order_detail')->references('id')->on('order_details')->onDelete('cascade');
            $table->foreignId('id_product')->references('id')->on('products')->onDelete('cascade');
            $table->string('nama_product');
            $table->decimal('harga', 10, 2);
            $table->integer('kuantitas');
            $table->double('berat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
