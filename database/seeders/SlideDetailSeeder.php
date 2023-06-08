<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlideDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 3; $i++) { 
            for ($j=1; $j < 10 ; $j++) { 
                DB::table('slide_details')->insert([
                    array(
                        'slide_id'=>$i,
                        'product_id'=>$j,
                    ),
                ]);
            }
           
        }
        
    }
}
