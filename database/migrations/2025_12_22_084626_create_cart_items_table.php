<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();

            // user login (pakai session)
            $table->unsignedBigInteger('user_id');

            // karena produk hardcode
            $table->string('product_code');
            $table->string('product_name');

            // harga satuan & jumlah
            $table->integer('price');
            $table->integer('quantity');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }

};
