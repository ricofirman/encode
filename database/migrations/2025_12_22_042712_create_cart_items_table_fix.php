<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       
        if (!Schema::hasTable('cart_items')) {
            Schema::create('cart_items', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->constrained()->onDelete('cascade');
                $table->foreignId('product_id')->constrained()->onDelete('cascade');
                $table->integer('quantity')->default(1);
                $table->timestamps();
                
                // Satu user hanya satu item per produk
                $table->unique(['user_id', 'product_id']);
                
                $table->index('user_id');
                $table->index('product_id');
            });
            
            \Illuminate\Support\Facades\Log::info('Cart items table created successfully');
        } else {
            // Jika tabel sudah ada, tambah kolom jika belum ada
            if (!Schema::hasColumn('cart_items', 'user_id')) {
                Schema::table('cart_items', function (Blueprint $table) {
                    $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
                });
            }
            
            \Illuminate\Support\Facades\Log::info('Cart items table already exists');
        }
    }

    public function down(): void
    {
        // Jangan drop table, hanya hapus foreign key jika perlu
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['product_id']);
        });
        

    }
};