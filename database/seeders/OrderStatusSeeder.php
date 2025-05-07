<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('order_statuses')->insert([
            'status' => 'Menunggu Pembayaran',
        ]);
        DB::table('order_statuses')->insert([
            'status' => 'Menunggu Verifikasi',
        ]);

        DB::table('order_statuses')->insert([
            'status' => 'Dalam Proses',
        ]);

        DB::table('order_statuses')->insert([
            'status' => 'Delivery',
        ]);

        DB::table('order_statuses')->insert([
            'status' => 'Selesai',
        ]);

        DB::table('order_statuses')->insert([
            'status' => 'Ditolak',
        ]);
    }
}
