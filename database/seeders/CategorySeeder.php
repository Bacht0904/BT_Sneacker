<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


use Illuminate\Support\Facades\DB;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            array(
                'category_name'=>'Áo',
                'icon'=>'shirt.svg',
                'status'=>1
            ),
            array(
                'category_name'=>'Quần',
                'icon'=>'trousers.svg',
                'status'=>1
            ),
            array(
                'category_name'=>'Đầm',
                'icon'=>'dress.svg',
                'status'=>1
            ),
            array(
                'category_name'=>'Mũ',
                'icon'=>'hat.svg',
                'status'=>1
            ),
            array(
                'category_name'=>'Giày',
                'icon'=>'shoes.svg',
                'status'=>1
            ),
        ]);
    }
}
