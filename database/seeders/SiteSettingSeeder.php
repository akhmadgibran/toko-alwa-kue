<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteSetting::create([
            'shop_name' => 'Toko Alwa Kue',
            'logo_path' => 'site-logos/default-logo.png', // Simpan file default-nya nanti di storage/app/public/site-logos/
            'shop_email' => 'tokoaalwa@gmail.com',
            'slogan' => 'Apapun acaranya, Alwa Kue Solusinya',
            'about_us' => 'ALWA KUE merupakan toko kue di Tulungagung yang menyediakan berbagai macam aneka Snack, Cookies, Tart, Kue Tradisional, Paket Snack, dan masih banyak lagi produk yang kami tawarkan. Kini, ALWA KUE hadir di Sebalor, Kec. Bandung, Kabupaten Tulungagung, Jawa Timur 66274. Kami juga melayani pemesanan secara online melalui WhatsApp dan Instagram. Dengan tema “APAPUN ACARANYA, ALWA KUE SOLUSINYA”, kami siap melayani segala kebutuhan Sahabat ALWA.',
            'phone' => '085875206802',
            'address' => 'Sirah Kandang, Jl. Sebalor, Kec. Bandung, Kabupaten Tulungagung, Jawa Timur 66274.',
            'facebook_name' => 'Alwa kue',
            'facebook_link' => 'https://www.facebook.com/alwa.kue',
            'twitter_name' => 'MyAwesomeShopTW',
            'twitter_link' => 'https://twitter.com/MyAwesomeShopTW',
            'instagram_name' => 'alwa_kue',
            'instagram_link' => 'https://www.instagram.com/alwa_kue/',
        ]);
    }
}
