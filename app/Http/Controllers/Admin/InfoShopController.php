<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InfoShop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class InfoShopController extends Controller
{
    //Lấy thông tin shop
    public function index()
    {
        $info =  DB::table('info_shops')->first();

        return view('component.shop.info-shop',compact('info'));
    }
    public function getEdit(){
        $info =  DB::table('info_shops')->first();
        return view('component.shop.edit-info-shop',compact('info'));
    }
    public function postEdit(Request $request){
        $info = InfoShop::first();
        $info->address = $request->address;
        $info->address_map = $request->address_map;
        $info->phone = $request->phone;
        $info->page_fb = $request->fanpage;
        $info->mess_chat = $request->mess_chat;
        $info->mess_manager = $request->mess_manager;
        $success= $info->update();

        return view('component.shop.edit-info-shop',compact('success'));
    }
}
