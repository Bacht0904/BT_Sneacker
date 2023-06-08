<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        for ($i=1; $i <= 5; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>1,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //2
        for ($i=6; $i <= 8; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>2,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //3
        for ($i=9; $i <= 11; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>3,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //4
        for ($i=12; $i <= 14; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>4,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //5
        for ($i=15; $i <= 17; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>5,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //6
        for ($i=18; $i <= 19; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>6,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //7
        for ($i=20; $i <= 23; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>7,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //8
        for ($i=24; $i <= 29; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>8,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //9
        for ($i=30; $i <= 32; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>9,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //10
        for ($i=34; $i <= 36; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>10,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //11
        for ($i=37; $i <= 38; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>11,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //12
        for ($i=39; $i <= 44; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>12,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //13
        for ($i=45; $i <= 48; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>13,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //14
        for ($i=49; $i <= 52; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>14,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //15
        for ($i=53; $i <= 55; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>15,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //16
        for ($i=56; $i <= 58; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>16,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //17
        for ($i=59; $i <= 63; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>17,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //18
        for ($i=64; $i <= 66; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>18,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //19
        for ($i=67; $i <= 72; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>19,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //20
        for ($i=73; $i <= 75; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>20,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //21
        for ($i=76; $i <= 78; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>21,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //22
        for ($i=79; $i <= 82; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>22,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //23
        for ($i=83; $i <= 87; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>23,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //24
        for ($i=88; $i <= 91; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>24,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //25
        for ($i=92; $i <= 95; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>25,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //26
        for ($i=96; $i <= 100; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>26,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //27
        for ($i=101; $i <= 106; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>27,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //28
        for ($i=107; $i <= 110; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>28,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //29
        for ($i=111; $i <= 114; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>29,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //30
        for ($i=115; $i <= 118; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>30,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //31
        for ($i=119; $i <= 122; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>31,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //32
        for ($i=123; $i <= 126; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>32,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //33
        for ($i=127; $i <= 129; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>33,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //34
        for ($i=130; $i <= 132; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>34,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //35
        for ($i=133; $i <= 134; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>35,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //36
        for ($i=135; $i <= 136; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>36,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //37
        for ($i=137; $i <= 139; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>37,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //38
        for ($i=140; $i <= 142; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>38,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //39
        for ($i=143; $i <= 145; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>39,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //40
        for ($i=146; $i <= 149; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>40,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
        //41
        for ($i=150; $i <= 153; $i++) {
            DB::table('pictures')->insert([
                'product_id'=>41,
                'picture_value'=>$i.'.jpg',
                'status'=>1
            ]);
        }
    }
}
