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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('custom_order_id')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('address');
            $table->integer('total_price');
            $table->string('status')->default('Menunggu Pembayaran');
            $table->longText('buyer_note')->nullable();
            $table->longText('seller_note')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
