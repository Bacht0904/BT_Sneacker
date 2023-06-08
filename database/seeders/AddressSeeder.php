<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('addresses')->insert([
            array(
                'user_id'=>1,
                'address'=>'Ho Chi Minh city',
                'phone_number'=>'0'.random_int(100,999).random_int(100,999).random_int(100,999),
                'is_default'=>1
            ),
            array(
                'user_id'=>1,
                'address'=>'Ben Tre',
                'phone_number'=>'0'.random_int(100,999).random_int(100,999).random_int(100,999),
                'is_default'=>0
            ),
            array(
                'user_id'=>1,
                'address'=>'Dong Nai',
                'phone_umber'=>'0'.random_int(100,999).random_int(100,999).random_int(100,999),
                'is_default'=>0
            ),
        ]);
    }
}
