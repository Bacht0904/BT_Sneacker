<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InfoShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('info_shops')->insert([
            array(
                'address'=>'65 Đ.Huỳnh Thúc Kháng, Bến Nghé, Quận 1, TP.Hồ Chí Minh',
                'address_map'=>'https://www.google.com/maps/place/Tr%C6%B0%E1%BB%9Dng+Cao+%C4%91%E1%BA%B3ng+K%E1%BB%B9+thu%E1%BA%ADt+Cao+Th%E1%BA%AFng/@10.7716003,106.6991629,17z/data=!3m1!4b1!4m5!3m4!1s0x31752f40a3b49e59:0xa1bd14e483a602db!8m2!3d10.771595!4d106.7013516?hl=vi-VN',
                'phone'=> '0964743275',
                'mess_manager'=>'https://business.facebook.com/latest/home?asset_id=106483085453041&nav_id=125076478&nav_ref=redirect_biz_inbox',
                'mess_chat'=>'https://l.facebook.com/l.php?u=http%3A%2F%2Fm.me%2Fgracfulclothes%3Ffbclid%3DIwAR1nUeWnK0P1xn4GELlN84gAY__8U8XXMcZnOfou4m9qMx4NpNUODyjYMUo&h=AT0jaUuaUEs_oRLvLrIDGIVzEZHDXgWHu6inyq99R0ohtyG4IyUZYX_M6BOb59QOjBtfS1Lff5gVi4iBDb5olXkZAUodsYgvv-M9OrNXFrq1DUYTTKn9vRzuT0szjhokaerbntw6sUeZCN3tNJY7FA',
                'page_fb'=>'https://www.facebook.com/gracfulclothes'
            ),
        ]);
    }
}
