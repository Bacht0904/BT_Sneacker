<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PictureRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 30; $i+=3) {
            for ($j=1; $j < 4; $j++) {
                DB::table('picture_rates')->insert([
                    'rate_id'=>$i,
                    'picture_value'=>random_int(1,8).'.jpg',
                ]);
            }
        }
    }
}
