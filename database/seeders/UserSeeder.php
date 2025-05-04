<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            'name' => 'admin',
            'email' =>  'admin@gmail.com',
            'email_verified_at' => now(),
            'phone' => '',
            'usertype' => 'admin',
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'superadmin',
            'email' =>  'superadmin@gmail.com',
            'email_verified_at' => now(),
            'phone' => '',
            'usertype' => 'superadmin',
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'costumer',
            'email' =>  'costumer@gmail.com',
            'email_verified_at' => now(),
            'phone' => '088811112222',
            'usertype' => 'costumer',
            'password' => Hash::make('password'),
        ]);
    }
}
