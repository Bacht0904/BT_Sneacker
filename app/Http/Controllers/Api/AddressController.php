<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use Illuminate\Http\Request as HttpRequest;
use Carbon\Carbon;
use Validator;

class AddressController extends Controller
{
   //Danh sách địa chỉ giao hàng
   public function getAllAddress()
   {
       try {        
           $user = Auth::user();

           $addresses = Address::where('addresses.user_id', '=', $user->id)
        //    ->orderBy('addresses.updated_at', 'DESC')
           ->get();

           return response()->json(['status'=>0, 'data'=>$addresses, 'message'=>'']);
       } catch (\Throwable $e) {
           return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
       }
       
   }

   //Tạo địa chỉ mới
   public function addNewAddress(HttpRequest $request)
   {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [ 
                'name' => 'required', 
                'address' => 'required', 
                'phone_number' => 'required', 
                'is_default' => 'nullable',
            ]);

            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);
            }
        
            $user = Auth::user();

            if($request->is_default == true){
                $addresses = Address::where('addresses.user_id', '=', $user->id)
                ->orderBy('addresses.updated_at', 'DESC')
                ->get();

                foreach ($addresses as $address) {
                    $address->update([
                        'is_default'=> false,
                    ]);
                }
            }

            Address::insert([
                'user_id'=> $user->id,
                'name'=> $request->name,
                'address'=> $request->address,
                'phone_number'=> $request->phone_number,
                'is_default'=> $request->is_default,
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ]);                
          
            DB::commit();
            return response()->json(['status'=>0, 'data'=>'', 'message'=>'Thêm địa chỉ giao hàng thành công!']);

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }       
   }

   //Chỉnh sửa địa chỉ
   public function editAddress(HttpRequest $request)
   {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [ 
                'id' => 'required',
                'name' => 'required', 
                'address' => 'required', 
                'phone_number' => 'required', 
                'is_default' => 'nullable',
            ]);

            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);
            }
        
            $user = Auth::user();

            $address = Address::where('addresses.user_id', '=', $user->id)
            ->where('addresses.id', '=', $request->id)
            ->first();

            if($address == null){
                return response()->json(['status'=>0, 'data'=>'', 'message'=>'Không tìm thấy địa chỉ']);     
            }else{

                if($request->is_default == true){
                    $addresses = Address::where('addresses.user_id', '=', $user->id)
                    ->orderBy('addresses.updated_at', 'DESC')
                    ->get();
    
                    foreach ($addresses as $address) {
                        $address->update([
                            'is_default'=> false,
                        ]);
                    }
                }

                $address->update([
                    'name'=> $request->name,
                    'address'=> $request->address,
                    'phone_number'=> $request->phone_number,
                    'is_default'=> $request->is_default,
                ]);   
                DB::commit();
                return response()->json(['status'=>0, 'data'=>'', 'message'=>'Cập nhật địa chỉ thành công']);
            }   

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }       
   }

   //Xoá địa chỉ
   public function deleteAddress(HttpRequest $request)
   {
        DB::beginTransaction();
        try {        
            $validator = Validator::make($request->all(), [ 
                'id' => 'required',
            ]);

            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);
            }
            $user = Auth::user();

            $address = Address::where('addresses.user_id', '=', $user->id)
            ->where('addresses.id', '=', $request->id)
            ->first();

            if($address == null){
                return response()->json(['status'=>0, 'data'=>'', 'message'=>'Không tìm thấy địa chỉ']);     
            }else{
                
                $address->delete();
                
                DB::commit();
                return response()->json(['status'=>0, 'data'=>'', 'message'=>'Xoá địa chỉ thành công']);
            }   

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }       
   }
}
