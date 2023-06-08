<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rate;
use App\Models\ProductDetail;
use App\Models\PictureRate;
use App\Models\InvoiceDetail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request as HttpRequest;
use Carbon\Carbon;
// use Validator;
use File;
use Hash;

class RateController extends Controller
{
    //DS sản phẩm chưa đánh giá
    public function getProductNotYedRated()
    {
        $user = Auth::user();

        $products = Product::select('products.*')
        ->with(['pictures'  => function($query) {
            $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
        }])
        ->with(['likes'])
        ->rightJoin('invoice_details', function($query) use ($user)
        {
            $query->on('invoice_details.product_id', '=', 'products.id')
                ->join('invoices', 'invoices.id', '=', 'invoice_details.invoice_id')
                ->where('invoices.user_id', '=', $user->id)
                ->where('invoice_details.rated', '=', false)
                ->where('invoices.status', '=', 4);
        })
        // ->leftJoin('rates', function($query) use ($user)
        // {
        //     $query->on('rates.product_id', '=', 'products.id')
        //         ->where('rates.user_id', '=', $user->id);
        // })
        // ->where('rates.id', '=', null)
        ->where('products.status', '=', 1)
        ->orderBy('products.id', 'DESC')
        ->distinct()
        ->get();

        return response()->json(['status'=>0, 'data'=>$products, 'message'=>'']);
    }

    //DS sản phẩm đã đánh giá
    public function getProductRated()
    {
        $user = Auth::user();

        $products = Product::select('products.*' ,'rates.id as rate_id', 'rates.num_rate as rate_num_rate', 'rates.description as rate_description', 'rates.created_at as rate_created_at')
        ->with(['pictures'  => function($query) {
            $query->select(['*', DB::raw('CONCAT("assets/img/products/",picture_value) AS picture_value')]);
        }])
        ->with(['likes'])
        ->join('invoice_details', function($query) use ($user)
        {
            $query->on('invoice_details.product_id', '=', 'products.id')
                ->join('invoices', 'invoices.id', '=', 'invoice_details.invoice_id')
                ->where('invoices.user_id', '=', $user->id)
                ->where('invoices.status', '=', 4);
        })
        ->rightJoin('rates', function($query) use ($user)
        {
            $query->on('rates.product_id', '=', 'products.id')
                ->where('rates.user_id', '=', $user->id);
        })
        ->where('rates.id', '<>', null)
        ->where('products.status', '=', 1)
        ->orderBy('products.id', 'DESC')
        ->distinct()
        ->orderBy('rates.created_at', 'DESC')
        ->get();

        return response()->json(['status'=>0, 'data'=>$products, 'message'=>'']);
    }

    //Chi tiết đánh giá sản phẩm
    public function getRatedDetail($id)
    {
        $user = Auth::user();

        $rate = Rate::with(['pictures_rate'=> function($query) {
            $query->select(['*', DB::raw('CONCAT("assets/img/rates/",picture_value) AS picture_value')]);
        }])
        ->with(['user'  => function($query) {
            $query->select(['*', DB::raw('CONCAT("assets/img/users/",avatar) AS avatar')]);
        }])
        ->where('user_id', $user->id)
        ->where('id', $id)
        ->first();

        return response()->json(['status'=>0, 'data'=>$rate, 'message'=>'']);
    }

    //Danh sách đánh giá
    public function getAllRateOfProduct(HttpRequest $request)
    {
        $product_id = (int) $request->product_id;

        $rates = Rate::with(['pictures_rate'=> function($query) {
            $query->select(['*', DB::raw('CONCAT("assets/img/rates/",picture_value) AS picture_value')]);
        }])
        ->with(['user'  => function($query) {
            $query->select(['*', DB::raw('CONCAT("assets/img/users/",avatar) AS avatar')]);
        }])
        ->where('rates.product_id', '=', $product_id)
        ->orderBy('rates.id', 'DESC')
        ->select('*' , 'rates.created_at as rate_created_at')
        ->get();

        foreach ($rates as $rate){
            try {
                $avatar = explode('users/', $rate->user->avatar)[1];
            } catch (\Throwable $th) {
                $avatar = explode('users/', $rate->user->avatar)[0];
            }
            if( explode(':', $avatar)[0] == 'https'){
                $rate->user->avatar = $avatar;
            }
        }

        return response()->json(['status'=>0, 'data'=>$rates, 'message'=>'']);
    }

    //Đánh giá sản phẩm
    public function rateProduct(HttpRequest $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'product_id' => 'required',
                'num_rate' => 'required',
                'description' => 'required',
                // 'images' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:10240'
            ]);

            if ($validator->fails()) {
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);
            }

            $user = Auth::user();

            // $rate = Rate::where('product_id', $request->product_id)
            // ->where('user_id', $user->id)
            // ->first();

            // if ($rate) {
            //     return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Sản phẩm chỉ được đánh giá một lần!']);
            // }

            $rate = Rate::create([
                'product_id' => $request->product_id,
                'user_id' =>  $user->id,
                'num_rate' => $request->num_rate,
                'description' => $request->description,
            ]);

            $num_rate = Rate::where('product_id', $request->product_id)
            ->avg('num_rate');

            $product = Product::where('id', $request->product_id)
            ->update([
                'num_rate' => $num_rate,
            ]);

            InvoiceDetail::join('invoices', 'invoices.id', '=', 'invoice_details.invoice_id')
            ->where('invoice_details.product_id', $request->product_id)
            ->where('invoices.user_id', $user->id)
            ->update(['rated' => true]);

            if($request->hasFile('images')){
                foreach ($request->file('images') as $image){
                    //Tạo một đối tượng nè
                    $picture_rate = new PictureRate;
                    //Lấy full cái tên file
                    $namewithextension = $image->getClientOriginalName();
                    //Lấy cái tên file 
                    $fileName = explode('.', $namewithextension)[0];
                    //Lấy cái đuôi mở rộng của file
                    $extension = $image->getClientOriginalExtension();
                    //Đặt tên file mới
                    $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
                    //Đường dẫn tới chổ m lưu hình
                    $destinationPath = public_path('/assets/img/rates/');
                    //Lưu nó dô trong cái đường dẫn với cái tên mới tạo
                    $image->move($destinationPath,$fileNew);
                    //Add link hình đó dô db
                    $picture_rate->rate_id = $rate->id;
                    $picture_rate->picture_value = $fileNew;
                    $picture_rate->save();
                }
            }
            DB::commit();
            return response()->json(['status'=>0, 'data'=>'', 'message'=>'Đánh giá thành công!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
    }

    //Chỉnh sửa đánh giá
    public function editRateProduct(HttpRequest $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'product_id' => 'required',
                'num_rate' => 'required',
                'description' => 'required',
                // 'images' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:10240'
            ]);

            if ($validator->fails()) {
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);
            }

            $user = Auth::user();

            $rate = Rate::where('product_id', $request->product_id)
            ->where('user_id', $user->id)
            ->where('id', $request->id)
            ->first();

            if (!$rate) {
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Không tìm thấy đánh giá!']);
            }

            $rate->update([
                'num_rate' => $request->num_rate,
                'description' => $request->description,
            ]);

            $num_rate = Rate::where('product_id', $request->product_id)
            ->avg('num_rate');

            $product = Product::where('id', $request->product_id)
            ->update([
                'num_rate' => $num_rate,
            ]);

            if($request->hasFile('images')){
                $images = $request->file('images');
                $picture_rate_lst = PictureRate::where('rate_id', $rate->id)->get();
                foreach ($picture_rate_lst as $pic){
                    unlink(public_path('/assets/img/rates/'.$pic->picture_value));
                    $pic->delete();
                }
                foreach ($images as $image){
                    $picture_rate = new PictureRate;

                    $namewithextension = $image->getClientOriginalName();
                    $fileName = explode('.', $namewithextension)[0];
                    $extension = $image->getClientOriginalExtension();
                    $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
                    $destinationPath = public_path('/assets/img/rates/');
                    $image->move($destinationPath,$fileNew);

                    $picture_rate->rate_id = $rate->id;
                    $picture_rate->picture_value = $fileNew;
                    $picture_rate->save();
                }
            }
            DB::commit();
            return response()->json(['status'=>0, 'data'=>'', 'message'=>'Sửa đánh giá tin thành công!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
    }
}
