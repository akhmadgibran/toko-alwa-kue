<?php

namespace Database\Seeders;

use App\Models\BestSeller;
use App\Models\User;
use App\Models\OrderStatus;
use App\Models\SiteSetting;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ShopStatusSeeder;
use Database\Seeders\OrderStatusSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //  call seeder
        $this->call([
            UserSeeder::class,
            ShopStatusSeeder::class,
            OrderStatusSeeder::class,
            BestSellerSeeder::class,
            SiteSettingSeeder::class,
            ProductPromotionSeeder::class
        ]);
    }
}
