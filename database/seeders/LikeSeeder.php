<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i=1; $i < 42; $i++) {
            for ($j=random_int(5,15); $j < 16; $j++) {
                DB::table('likes')->insert(
                    array(
                        'product_id'=> $i,
                        'user_id'=>$j
                    )
                );
                $product = Product::where('id', $i)->first();
                $product->update(['num_like' => $product->num_like + 1]);
            }  
        }       
    }
}
