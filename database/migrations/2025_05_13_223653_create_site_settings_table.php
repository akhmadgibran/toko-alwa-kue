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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name')->nullable()->default('Shop Name');
            $table->string('logo_path')->nullable();
            $table->string('home_background_path')->nullable();
            $table->string('about_banner_path')->nullable();
            $table->string('shop_email')->nullable()->default('shop@gmail.com');
            $table->string('slogan')->nullable()->default('Shop Slogan');
            $table->longText('about_us')->nullable();
            $table->string('promotion_paragraph')->nullable();
            $table->string('phone')->nullable()->default('0123456789');
            $table->string('address')->nullable()->default('Shop Address');
            $table->string('facebook_name')->nullable()->default('Facebook Name');
            $table->string('facebook_link')->nullable()->default('https://www.facebook.com');
            $table->string('twitter_name')->nullable()->default('Twitter Name');
            $table->string('twitter_link')->nullable()->default('https://www.twitter.com');
            $table->string('instagram_name')->nullable()->default('Instagram Name');
            $table->string('instagram_link')->nullable()->default('https://www.instagram.com');
            $table->string('copyright_text')->nullable();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
