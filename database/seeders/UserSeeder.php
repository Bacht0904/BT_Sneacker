<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('users')->insert([
            'full_name'=>'Võ Đăng Khoa',
            'email'=>'admin@gmail.com',
            'phone'=> '0329290298',
            'password'=>Hash::make('123456'),
            'address'=> 'Tây Ninh',
            'avatar'=>'default_avatar.png',
            'role'=>1,
            'status'=>1,
        ]);
        DB::table('users')->insert([
            'full_name'=>'Trần Thị Thu Hà',
            'email'=>'hattt@gmail.com',
            'phone'=> '0964745869',
            'password'=>Hash::make('123456'),
            'address'=> '558, P.28, Q.Bình Thạnh, TP.HCM',
            'avatar'=>'default_avatar.png',
            'role'=>1,
            'status'=>1,
        ]);
        DB::table('users')->insert([
            'full_name'=>'Đỗ Minh Chánh',
            'email'=>'chanhdm@gmail.com',
            'phone'=> '0835478139',
            'password'=>Hash::make('123456'),
            'address'=> '71 Chu Văn An, P.26, Q.Bình Thạnh, TP.HCM',
            'avatar'=>'default_avatar.png',
            'role'=>2,
            'status'=>1,
        ]);
        //4
        DB::table('users')->insert([
            'full_name'=>'Võ Hoàng Đức',
            'email'=>'ducvh@gmail.com',
            'phone'=> '0939659743',
            'password'=>Hash::make('123456'),
            'address'=> 'Ngũ Hiệp, Cai Lậy, Tiền Giang',
            'avatar'=>'default_avatar.png',
            'role'=>2,
            'status'=>1,
        ]);
        //5
        DB::table('users')->insert([
            'full_name'=>'Hồ Thị Thu Nhi',
            'email'=>'nhihtt@gmail.com',
            'phone'=> '0989356479',
            'password'=>Hash::make('123456'),
            'address'=> 'Khánh Đông, Khánh Vĩnh, Khánh Hòa',
            'avatar'=>'default_avatar.png',
            'role'=>0,
            'status'=>1,
        ]);
        //6
        DB::table('users')->insert([
            'full_name'=>'Trần Bách Hiệp',
            'email'=>'hiepbt@gmail.com',
            'phone'=> '0363934536',
            'password'=>Hash::make('123456'),
            'address'=> '45 Đ. Hoàng Diệu, Phường 5, Thành phố Đà Lạt, Lâm Đồng',
            'avatar'=>'default_avatar.png',
            'role'=>0,
            'status'=>1,
        ]);
        //7
        DB::table('users')->insert([
            'full_name'=>'Võ Minh Triết',
            'email'=>'trietvm@gmail.com',
            'phone'=> '0329297549',
            'password'=>Hash::make('password'),
            'address'=> 'Thạnh Mỹ, Tân Phước, Tiền Giang',
            'avatar'=>'default_avatar.png',
            'role'=>0,
            'status'=>1,
        ]);
        //8
        DB::table('users')->insert([
            'full_name'=>'Phan Thanh Vinh',
            'email'=>'vinhpt@gmail.com',
            'phone'=> '0939658523',
            'password'=>Hash::make('123456'),
            'address'=> '389 Lê Viết Thuật, Hưng Lộc, Thành phố Vinh, Nghệ An',
            'avatar'=>'default_avatar.png',
            'role'=>0,
            'status'=>1,
        ]);
        //9
        DB::table('users')->insert([
            'full_name'=>'Phạm Thu Trang',
            'email'=>'trangpt@gmail.com',
            'phone'=> '0393919567',
            'password'=>Hash::make('123456'),
            'address'=> 'Kỳ Thọ, Kỳ Anh, Hà Tĩnh',
            'avatar'=>'default_avatar.png',
            'role'=>0,
            'status'=>1,
        ]);
        //10
        DB::table('users')->insert([
            'full_name'=>'Nguyễn Thị Kim',
            'email'=>'kimnt@gmail.com',
            'phone'=> '0932589632',
            'password'=>Hash::make('123456'),
            'address'=> '21 Hồ Đắc Di, An Cựu, Thành phố Huế, Thừa Thiên Huế',
            'avatar'=>'default_avatar.png',
            'role'=>0,
            'status'=>1,
        ]);
        //11
        DB::table('users')->insert([
            'full_name'=>'Hà Văn Trung Tiến',
            'email'=>'tienhvt@gmail.com',
            'phone'=> '0376552369',
            'password'=>Hash::make('123456'),
            'address'=> 'Đường Hùng Vương, Trần Phú, Quảng Ngãi',
            'avatar'=>'default_avatar.png',
            'role'=>0,
            'status'=>1,
        ]);
        //12
        DB::table('users')->insert([
            'full_name'=>'Nguyễn Thị Kim Loan',
            'email'=>'Loanntk@gmail.com',
            'phone'=> '0389641237',
            'password'=>Hash::make('123456'),
            'address'=> 'Đồng tâm, Đam Rông, Lâm Đồng',
            'avatar'=>'default_avatar.png',
            'role'=>0,
            'status'=>1,
        ]);
        //13
        DB::table('users')->insert([
            'full_name'=>'Hồ Thanh Toàn',
            'email'=>'toanht@gmail.com',
            'phone'=> '0937335698',
            'password'=>Hash::make('123456'),
            'address'=> 'Bùi Hữu Nghĩa, Long Tuyền, Bình Thủy, Cần Thơ',
            'avatar'=>'default_avatar.png',
            'role'=>0,
            'status'=>1,
        ]);
        //14
        DB::table('users')->insert([
            'full_name'=>'Phan Nguyễn Công Khanh',
            'email'=>'khanhpnc@gmail.com',
            'phone'=> '0933149374',
            'password'=>Hash::make('123456'),
            'address'=> '01 Đường Tạ An Khương, Phường 5, Thành phố Cà Mau, Cà Mau',
            'avatar'=>'default_avatar.png',
            'role'=>0,
            'status'=>1,
        ]);
        //15
        DB::table('users')->insert([
            'full_name'=>'Phan Hồng Thuý Liễu',
            'email'=>'lieupht@gmail.com',
            'phone'=> '0965963482',
            'password'=>Hash::make('123456'),
            'address'=> 'Thới Đông, Cờ Đỏ, Cần Thơ',
            'avatar'=>'default_avatar.png',
            'role'=>0,
            'status'=>1,
        ]);
    }

}
