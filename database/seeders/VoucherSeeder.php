<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vouchers')->insert([
            array(
                'voucher_code'=>'2022DATT0001',
                'description'=>'Giảm 20000 cho đơn hàng có giá trị từ 150.000 trở lên',
                'min_total_price'=> 150000,
                'discount_price'=>20000,
                'start_date'=>Carbon::create(2022, 7, 6),
                'end_date'=>Carbon::create(2022, 7, 8),
                'status'=>1,
            ),
            array(
                'voucher_code'=>'2022DATT0002',
                'description'=>'Giảm 49000 cho đơn hàng có giá trị từ 399.000 trở lên',
                'min_total_price'=> 399000,
                'discount_price'=>49000,
                'start_date'=>Carbon::create(2022, 7, 10),
                'end_date'=>Carbon::create(2022, 7, 20),
                'status'=>1,
            ),
            array(
                'voucher_code'=>'2022DATT0003',
                'description'=>'Giảm 39000 cho đơn hàng có giá trị từ 149.000 trở lên',
                'min_total_price'=> 150000,
                'discount_price'=>39000,
                'start_date'=>Carbon::create(2022, 07, 25),
                'end_date'=>Carbon::create(2022, 07, 31),
                'status'=>1,
            ),
        ]);
    }
}
