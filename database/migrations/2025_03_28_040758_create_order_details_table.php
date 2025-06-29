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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->string('custom_order_id');
            // $table->unsignedBigInteger('product_id');
            $table->string('product_name');
            $table->float('product_price');
            $table->integer('quantity');
            $table->integer('subtotal');
            $table->timestamps();
            $table->foreign('custom_order_id')->references('custom_order_id')->on('orders');
            // $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
