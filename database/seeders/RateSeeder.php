<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Rate;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        for($i=1;$i<42;$i++){
            for($j=5;$j<random_int(5,16);$j++){
                DB::table('rates')->insert([
                    'product_id'=>$i,
                    'user_id'=>$j,
                    'num_rate'=> random_int(1,5),
                    'description'=> $j%2==0?'Sản phẩm này đẹp quá! Mua về là quá ưng ý luôn. mê mê':'Sản phẩm quá tuyệt vời, vượt cả mong đợi',
                    'created_at'=> Carbon::now(),
                ]);
                $num_rate = Rate::where('product_id', $i)
                ->avg('num_rate');
                $product = Product::where('id', $i)
                ->update([
                    'num_rate' => $num_rate,
                ]);
            }
        }
    }
    
}
