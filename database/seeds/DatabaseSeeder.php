<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name= array(0 => "hau",
        1 => "huy",
        2 => "bach",
        3 => "minh",
        4 => "tai" ,
        5=>"tuan");
        for($i=1;$i<6;$i++){
            $username=rand(0,5);
            DB::table('TaiKhoan')->insert([
                'username'=>$name+$username,
                'password'=>"123456",
                'trangthai'=>'1',
            ]);
        }
        for($i=1;$i<6;$i++){
            $hoten=Str::random(10);
            $Hinh= Str::random(50);
            $ngaysinh=date("Y-m-d");
            $diachi=Str::random(10);
            $sdt="0123456789";
            $email="@gmail.com";
            DB::table('NguoiDung')->insert([
                'hoten'=>$hoten,
                'ngaysinh'=>$ngaysinh,
                'HinhAnh'=>$Hinh,
                'diachi'=>$diachi,
                'sdt'=>$sdt,
                'email'=>$name+$email,
                'isAdmin'=>rand(0,1),
                'trangthai'=>'1',
            ]);
        }
        $product= array(0 => "Giày lười",
        1 => "dép",
        2 => "bata",
        3 => "Giày đá banh",
        4 => "Sneacker" ,
        );
        $thuonghieu= array(0 => "MWC",
        1 => "ADIDAS",
        2 => "Biti's",
        3 => "NIKE",
        4 => "MEELY" ,
        );
        for($i=1;$i<6;$i++){
          
            $malop=Str::random(50);
            DB::table('SanPham')->insert([
                'tensp'=>$product[$i],
                'thuonghieu'=>$thuonghieu[$i],
                'mota'=>$malop,
                'trangthai'=>'1',
            ]);
        }
        $color= array(0 => "Trắng",
        1 => "Đen",
        2 => "Đỏ",
        3 => "Xanh",
        4 => "Be" ,
        5=>"Tím"
        );
        $thuonghieu= array(0 => "MWC",
        1 => "ADIDAS",
        2 => "Biti's",
        3 => "NIKE",
        4 => "MEELY" ,
        );
        $size=array(36,37,38,39,40,41,42);
        for($i=1;$i<6;$i++){

            $soluong=rand(10,50);
            $gia=rand(250000,4000000);
            for($j=1;$j<6;$j++){
            DB::table('SP_Detail')->insert([
                'idSP'=>$i,
                'color'=>$color[$j],
                'soluong'=>$soluong,
                'size'=>$size[$j],
                'dongia'=>$gia,
                'trangthai'=>'1',
            ]);
            }
        }
        for($i=1;$i<6;$i++){
            DB::table('KhuyenMai')->insert([
                'phantram'=>rand(5,35),
                'NgayBatDau'=>date("Y-m-d"),
                'NgayKetThuc'=>date("Y-m-d"),
                'trangthai'=>'1',
            ]);
        }
    }
}
