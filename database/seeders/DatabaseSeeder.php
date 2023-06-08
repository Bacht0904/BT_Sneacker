<?php

namespace Database\Seeders;

use App\Models\ProductDetail;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            BrandSeeder::class,
            CategorySeeder::class,
            ProductTypeSeeder::class,
            RoleSeeder::class,
            SlideSeeder::class,
            VoucherSeeder::class,
            UserSeeder::class,
            ProductSeeder::class,
            SlideDetailSeeder::class,
            ColorSeeder::class,
            SizeSeeder::class,
            PictureSeeder::class,
            ProductDetailSeeder::class,
            LikeSeeder::class,
            RateSeeder::class,
            PictureRateSeeder::class,
            InfoShopSeeder::class,
            InvoiceSeeder::class,
            InvoiceDetailSeeder::class,
        ]);
    }
}
