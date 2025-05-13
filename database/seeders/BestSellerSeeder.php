<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BestSellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("best_sellers")->insert([
            "product_id" => null,
        ]);
        DB::table("best_sellers")->insert([
            "product_id" => null,
        ]);
        DB::table("best_sellers")->insert([
            "product_id" => null,
        ]);
    }
}
