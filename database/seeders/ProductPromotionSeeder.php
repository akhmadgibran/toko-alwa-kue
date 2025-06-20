<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductPromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("product_promotions")->insert([
            "product_id" => null,
        ]);
        DB::table("product_promotions")->insert([
            "product_id" => null,
        ]);
        DB::table("product_promotions")->insert([
            "product_id" => null,
        ]);
    }
}
