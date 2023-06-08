<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InfoShop;
use Illuminate\Support\Facades\DB;

class InfoShopController extends Controller
{
    //Lấy thông tin shop
    public function getInfoShop()
    {
        $info =  DB::table('info_shops')->first();

        return response()->json(['status'=>0, 'data'=>$info, 'message'=>'']);
    }
}
