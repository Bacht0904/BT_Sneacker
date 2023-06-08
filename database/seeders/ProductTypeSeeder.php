<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_types')->insert([
            // 1
            array(
                'product_type_name'=>'Áo sơ mi',
                'categorie_id'=>1,
                'status'=>1
            ),
            // 2
            array(
                'product_type_name'=>'Áo thun',
                'categorie_id'=>1,
                'status'=>1
            ),
            // 3
            array(
                'product_type_name'=>'Áo len',
                'categorie_id'=>1,
                'status'=>1
            ),
            // 4
            array(
                'product_type_name'=>'Áo khoác',
                'categorie_id'=>1,
                'status'=>1
            ),
            // 5
            array(
                'product_type_name'=>'Áo hoodie',
                'categorie_id'=>1,
                'status'=>1
            ),
            // 6
            array(
                'product_type_name'=>'Quần tây',
                'categorie_id'=>2,
                'status'=>1
            ),
            // 7
            array(
                'product_type_name'=>'Quần short',
                'categorie_id'=>2,
                'status'=>1
            ),
            // 8
            array(
                'product_type_name'=>'Quần jeans',
                'categorie_id'=>2,
                'status'=>1
            ),
            // 9
            array(
                'product_type_name'=>'Quần baggy',
                'categorie_id'=>2,
                'status'=>1
            ),
            // 10
            array(
                'product_type_name'=>'Quần jogger',
                'categorie_id'=>2,
                'status'=>1
            ),
            // 11
            array(
                'product_type_name'=>'Đầm dáng xòe',
                'categorie_id'=>3,
                'status'=>1
            ),
            // 12
            array(
                'product_type_name'=>'Đầm body',
                'categorie_id'=>3,
                'status'=>1
            ),
            // 13
            array(
                'product_type_name'=>'Đầm suông',
                'categorie_id'=>3,
                'status'=>1
            ),
            // 14
            array(
                'product_type_name'=>'Đầm trễ vai',
                'categorie_id'=>3,
                'status'=>1
            ),
            // 15
            array(
                'product_type_name'=>'Đầm sơ mi',
                'categorie_id'=>3,
                'status'=>1
            ),
            //
            // 16
            array(
                'product_type_name'=>'Mũ lưỡi trai',
                'categorie_id'=>4,
                'status'=>1
            ),
            // 17
            array(
                'product_type_name'=>'Mũ tai bèo',
                'categorie_id'=>4,
                'status'=>1
            ),
            // 18
            array(
                'product_type_name'=>'Mũ len',
                'categorie_id'=>4,
                'status'=>1
            ),
            // 19
            array(
                'product_type_name'=>'Mũ rộng vành',
                'categorie_id'=>4,
                'status'=>1
            ),
            // 20
            array(
                'product_type_name'=>'Giày Sneaker',
                'categorie_id'=>5,
                'status'=>1
            ),
            // 21
            array(
                'product_type_name'=>'Giày Trainer',
                'categorie_id'=>5,
                'status'=>1
            ),
        ]);
    }
}
