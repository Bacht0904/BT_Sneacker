<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Voucher;
use App\Models\Cart;
use App\Models\Product;
use App\Models\InvoiceDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use Illuminate\Http\Request as HttpRequest;
use Carbon\Carbon;
use Validator;
use File;
use Hash;
use App\Jobs\SendEmail;

class InvoiceController extends Controller
{
    //Danh sách hoá đơn
    public function getAllInvoice()
    {
        try {        
            $user = Auth::user();

            $invoices = Invoice::with(['voucher'])
            // ->where('invoices.status', '=', 1)
            ->where('invoices.user_id', '=', $user->id)
            ->orderBy('invoices.created_at', 'DESC')
            ->get();

            return response()->json(['status'=>0, 'data'=>$invoices, 'message'=>'']);
        } catch (\Throwable $e) {
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
        
    }

    //Chi tiết hoá đơn
    public function getInvoiceDetail($id)
    {
        try {        
            $user = Auth::user();

            $invoices = Invoice::where('invoices.user_id', '=', $user->id)
            ->where('invoices.id', '=', $id)
            ->first();
            
            $invoice_detail = InvoiceDetail::with(['product'])
            ->with(['color' => function($query) {
                $query->select(['*', DB::raw('CONCAT("assets/img/product_colors/",picture) AS picture')]);
            }])
            ->with(['size'])
            ->where('invoice_details.invoice_id', '=', $invoices->id)
            ->get();

            return response()->json(['status'=>0, 'data'=>$invoice_detail, 'message'=>'']);
        } catch (\Throwable $e) {
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
        
    }

    //Tạo hoá đơn
    public function addInvoice(HttpRequest $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [ 
                'cart_id' => 'required', 
                'voucher_id' => 'nullable|int',
                'ship_price' => 'nullable|int',
                'name' => 'required', 
                'phone' => 'required', 
                'address' => 'required', 
            ]);
            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);
            }
           
            $user = Auth::user();

            $date = Carbon::now();
            $year = Str::substr($date->year, 2, 2);
            $month = $date->month;
            $day = $date->day;
            if(Str::length($month)==1)
            {
                $month = '0'.$month;
            }
            if(Str::length($day)==1)
            {
                $day = '0'.$day;
            }
            
            $invoice = Invoice::create([
                'user_id'=> $user->id,
                'invoice_code'=> $year.$month.$day.'_'.Str::random(12),
                'voucher_id'=> $request->voucher_id,
                'quantity'=> 0,
                'ship_price'=> $request->ship_price,
                'until_price'=> 0 + $request->ship_price,
                'name'=> $request->name,
                'phone'=> $request->phone,
                'address'=> $request->address,
                'status'=> 1,
                'canceler_id' => null,
                'reason' => null,
            ]); 

            foreach ($request->cart_id as $id){
                $cart = Cart::where('id', '=', $id)
                ->where('user_id', '=', $user->id)
                ->first();
                if($cart){
                    $product = Product::where('id', $cart->product_id)->first();
                    $invoice_detail =  InvoiceDetail::create([
                        'invoice_id'=> $invoice->id,
                        'product_id'=> $cart->product_id,
                        'color_id'=> $cart->color_id,
                        'size_id'=> $cart->size_id,
                        'quantity'=> $cart->quantity,
                        'price'=> $product->price,
                        'total_price'=> $product->price * $cart->quantity,
                        'status'=> 1,
                    ]); 
                    $invoice->update([
                        'quantity'=> $invoice->quantity + $invoice_detail->quantity,
                        'until_price'=> $invoice->until_price + $invoice_detail->total_price,
                    ]); 
                    // Product::where('id', $cart->product_id)
                    // ->update([
                    //     'stock'=> $product->stock - $cart->quantity,
                    // ]);   
                    $cart->delete();
                }else{
                    DB::rollBack();
                    return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Không tìm thấy sản phẩm trong giỏ hàng']);
                }                
            }        
            
            if($request->voucher_id){
                $voucher = Voucher::where('id', '=', $request->voucher_id)->first();
                $invoice->update([
                    'until_price'=> $invoice->until_price - $voucher->discount_price,
                ]);
            }
            
            if($invoice->until_price < 0){
                $invoice->update([
                    'until_price'=> 0,
                ]); 
            }

            if($request->type_pay){
                $invoice->update([
                    'invoice_code'=> $request->invoice_code,
                    'type_pay'=> $request->type_pay,
                ]);
            } 

            $message = [
                'type' => 'Đơn hàng',
                'hi' => $user->full_name,
                'content1' => 'Chúng tôi đã tiếp nhận đơn đặt hàng của bạn. Mã đơn hàng của bạn là: ',
                'num' => $invoice->invoice_code,
                'content2' => ' và tổng giá trị đơn hàng: '.number_format( $invoice->until_price, 0, '', '.').' VND. Chúng tôi sẽ phản hồi sớm nhất cho bạn, xin cảm ơn!',
            ];
            SendEmail::dispatch($message, $user)->delay(now()->addMinute(1)); 

            DB::commit();
            return response()->json(['status'=>0, 'data'=>'', 'message'=>'Hoá đơn được tạo thành công!']);

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
        
    }

    //Huỷ đơn hàng
    public function cancelInvoice(HttpRequest $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [ 
                'id' => 'required', 
                'reason' => 'required'
            ]);
            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);
            }
        
            $user = Auth::user();

            $invoice = Invoice::where('invoices.id', '=', $request->id)
            ->where('invoices.user_id', '=', $user->id)
            ->first();

            if($invoice){
                $invoice->update([
                    'status'=> 0,
                    'canceler_id'=> $user->id,
                    'reason'=> $request->reason,
                ]); 

                $invoice_details = InvoiceDetail::join('invoices', 'invoices.id', '=', 'invoice_details.invoice_id')
                ->where('invoices.id', '=', $invoice->id)
                ->get();    

                // foreach ($invoice_details as $invoice_detail){
                //     $product = Product::where('id', $invoice_detail->product_id)->first();
                //     Product::where('id', $invoice_detail->product_id)
                //     ->update([
                //         'stock'=> $product->stock + $invoice_detail->quantity,
                //     ]); 
                // }

                if($invoice->type_pay == 'ZaloPay'){

                    //Truy vấn trạng thái thanh toán của đơn hàng
                    $config = [
                        "app_id" => 2554,
                        "key1" => "sdngKKJmqEMzvh5QQcdD2A9XBSKUNaYn",
                        "key2" => "trMrHtvjo6myautxDUiAcYsVtaeQ8nhf",
                        "refund_url" => "https://sb-openapi.zalopay.vn/v2/query"
                    ];
                    
                    $app_trans_id = $invoice->invoice_code;  // Input your app_trans_id
                    $data = $config["app_id"]."|".$app_trans_id."|".$config["key1"]; // app_id|app_trans_id|key1
                    $params = [
                    "app_id" => $config["app_id"],
                    "app_trans_id" => $app_trans_id,
                    "mac" => hash_hmac("sha256", $data, $config["key1"])
                    ];
                    
                    $context = stream_context_create([
                        "http" => [
                            "header" => "Content-type: application/x-www-form-urlencoded\r\n",
                            "method" => "POST",
                            "content" => http_build_query($params)
                        ]
                    ]);
                    
                    $resp = file_get_contents($config["refund_url"], false, $context);
                    $result = json_decode($resp, true);
                    $zp_trans_id = $result["zp_trans_id"];
    
                    //Hoàn tiền giao dịch
                    $config = [
                        "app_id" => 2554,
                        "key1" => "sdngKKJmqEMzvh5QQcdD2A9XBSKUNaYn",
                        "key2" => "trMrHtvjo6myautxDUiAcYsVtaeQ8nhf",
                        "refund_url" => "https://sb-openapi.zalopay.vn/v2/refund"
                    ];
    
                    $timestamp = round(microtime(true) * 1000); // miliseconds
                    $uid = "$timestamp".rand(111,999); // unique id 
    
                    $params = [
                        "app_id" => $config["app_id"],
                        "m_refund_id" => date("ymd")."_".$config["app_id"]."_".$uid,
                        "timestamp" => $timestamp,
                        "zp_trans_id" => $zp_trans_id,
                        "amount" => $invoice->until_price,
                        "description" => "ZaloPay Intergration Demo"
                    ];
    
                    // app_id|zp_trans_id|amount|description|timestamp
                    $data = $params["app_id"]."|".$params["zp_trans_id"]."|".$params["amount"]
                    ."|".$params["description"]."|".$params["timestamp"];
                    $params["mac"] = hash_hmac("sha256", $data, $config["key1"]);
    
                    $context = stream_context_create([
                    "http" => [
                        "header" => "Content-type: application/x-www-form-urlencoded\r\n",
                        "method" => "POST",
                        "content" => http_build_query($params)
                    ]
                    ]);
    
                    $resp = file_get_contents($config["refund_url"], false, $context);
                    $result = json_decode($resp, true);
    
                    // foreach ($result as $key => $value) {
                    //     echo "$key: $value<br>";
                    // }
    
                    // dd($result);
                }    

                $message = [
                    'type' => 'Đơn hàng',
                    'hi' => $user->full_name,
                    'content1' => 'Mã đơn hàng: ',
                    'num' => $invoice->invoice_code,
                    'content2' => ' đã huỷ thành công. Lý do: '.$request->reason,
                ];
                SendEmail::dispatch($message, $user)->delay(now()->addMinute(1));            
                
                DB::commit();
                return response()->json(['status'=>0, 'data'=>'', 'message'=>'Huỷ đơn hàng thành công!']);
            }
            else{
                DB::commit();
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Không tìm thấy đơn hàng!']);
            }
            

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
        
    }
}
