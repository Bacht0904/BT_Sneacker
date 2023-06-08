<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use Illuminate\Http\Request as HttpRequest;
use Carbon\Carbon;
use Validator;
use File;
use Hash;

class CartController extends Controller
{
    //Danh sách sản phẩm trong giỏ hàng
    public function getAllCartProduct()
    {
        try {        
            $user = Auth::user();

            $products = Cart::with(['product'])
            ->with(['color' => function($query) {
                $query->select(['*', DB::raw('CONCAT("assets/img/product_colors/",picture) AS picture')]);
            }])
            ->with(['size'])
            ->where('carts.user_id', '=', $user->id)
            ->orderBy('carts.updated_at', 'DESC')
            ->get();

            return response()->json(['status'=>0, 'data'=>$products, 'message'=>'']);
        } catch (\Throwable $e) {
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
        
    }

    //Thêm sản phẩm vào giỏ hàng
    public function addCart(HttpRequest $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [ 
                'product_id' => 'required', 
                'color_id' => 'required', 
                'size_id' => 'required',
                'quantity' => 'required',
            ]);

            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);
            }
        
            $user = Auth::user();

            $cart = Cart::where('user_id', '=', $user->id)
            ->where('product_id', '=', $request->product_id)
            ->where('color_id', '=', $request->color_id)
            ->where('size_id', '=', $request->size_id)
            ->first();

            // dd(date_default_timezone_get());
            // dd(env('TIMEZONE'));

            if($cart == null){
                Cart::insert([
                    'product_id'=> $request->product_id,
                    'color_id'=> $request->color_id,
                    'size_id'=> $request->size_id,
                    'user_id'=> $user->id,
                    'quantity'=> $request->quantity,
                    'created_at'=>Carbon::now(),
                    'updated_at'=>Carbon::now(),
                ]);                
            }else{
                if($request->quantity > 0)
                {
                    $cart->update([
                        'quantity'=> $cart->quantity + $request->quantity,
                    ]);  
                }else{
                    $cart->delete();
                }
            }
            DB::commit();
            return response()->json(['status'=>0, 'data'=>'', 'message'=>'Thêm sản phẩm vào giỏ hàng thành công!']);

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
        
    }

    //Cập nhật giỏ hàng
    public function updateCart(HttpRequest $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [ 
                'product_id' => 'required', 
                'color_id' => 'required', 
                'size_id' => 'required',
                'quantity' => 'required',
            ]);

            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);
            }
        
            $user = Auth::user();

            $cart = Cart::where('user_id', '=', $user->id)
            ->where('product_id', '=', $request->product_id)
            ->where('color_id', '=', $request->color_id)
            ->where('size_id', '=', $request->size_id)
            ->first();

            if($cart == null){
                DB::commit();
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Sản phẩm không tồn tại trong giỏ hàng!']);            
            }else{
                if($request->quantity > 0)
                {
                    $cart->update([
                        'quantity'=> $request->quantity,
                    ]);  
                }else{
                    $cart->delete();
                }
            }
            DB::commit();
            return response()->json(['status'=>0, 'data'=>'', 'message'=>'Cập nhật giỏ hàng thành công!']);

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
        
    }

    //Xoá giỏ hàng
    public function deleteCart(HttpRequest $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [ 
                'cart_id' => 'required', 
            ]);
            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);
            }
        
            $user = Auth::user();

            foreach ($request->cart_id as $id){
                $cart = Cart::where('id', '=', $id)
                ->where('user_id', '=', $user->id)
                ->first();
                  
                $cart->delete();
            }        
                
            DB::commit();
            return response()->json(['status'=>0, 'data'=>'', 'message'=>'Cập nhật giỏ hàng thành công!']);

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
        
    }
}
