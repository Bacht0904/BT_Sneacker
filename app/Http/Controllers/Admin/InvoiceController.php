<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\InvoiceDetail;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Jobs\SendEmail;
use App\Models\Picture;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->status_search);
        $title = 'Danh sách đơn hàng';
        $status_search=$request->status_search;
        if($request->status_search!=null){
            if($status_search!=-1){
                $invoices = DB::table('invoices')
                ->join('users','users.id','=','invoices.user_id')
                ->leftJoin('vouchers','vouchers.id','=','invoices.voucher_id')
                ->orderBy('invoices.created_at','DESC')
                ->where('invoices.status','=',$status_search)
                ->select('invoices.*','users.full_name','vouchers.voucher_code')
                ->get();
            }else{
                $invoices = DB::table('invoices')
                ->join('users','users.id','=','invoices.user_id')
                ->leftJoin('vouchers','vouchers.id','=','invoices.voucher_id')
                ->orderBy('invoices.created_at','DESC')
                ->select('invoices.*','users.full_name','vouchers.voucher_code')
                ->get();
            }
        }
        else{
            $invoices = DB::table('invoices')
            ->join('users','users.id','=','invoices.user_id')
            ->leftJoin('vouchers','vouchers.id','=','invoices.voucher_id')
            ->orderBy('invoices.created_at','DESC')
            ->select('invoices.*','users.full_name','vouchers.voucher_code')
            ->get();
            $status_search = -1;
        }
        // dd($invoices);
        return view('component.invoice.list-invoice',compact('invoices','title','status_search'));
    }

    // public function index2(Request $request)
    // {
    //     dd('s');
    //     $title = 'Danh sách đơn hàng';
    //     $status_search=$request->status_search;
    //     if($status_search){
    //         if($status_search!=-1){
    //             $invoices = DB::table('invoices')
    //             ->join('users','users.id','=','invoices.user_id')
    //             ->leftJoin('vouchers','vouchers.id','=','invoices.voucher_id')
    //             ->orderBy('invoices.created_at','DESC')
    //             ->where('invoices.status','=',$status_search)
    //             ->select('invoices.*','users.full_name','vouchers.voucher_code')
    //             ->get();
    //         }else{
    //             $invoices = DB::table('invoices')
    //         ->join('users','users.id','=','invoices.user_id')
    //         ->leftJoin('vouchers','vouchers.id','=','invoices.voucher_id')
    //         ->orderBy('invoices.created_at','DESC')
    //         ->select('invoices.*','users.full_name','vouchers.voucher_code')
    //         ->get();
    //         }
    //     }
    //     else{
    //         $invoices = DB::table('invoices')
    //         ->join('users','users.id','=','invoices.user_id')
    //         ->leftJoin('vouchers','vouchers.id','=','invoices.voucher_id')
    //         ->orderBy('invoices.created_at','DESC')
    //         ->select('invoices.*','users.full_name','vouchers.voucher_code')
    //         ->get();
    //         $status_search =-1;
    //     }
    //     // dd($invoices);
    //     return view('component.invoice.list-invoice',compact('invoices','title','status_search'));
    // }


    public function updateStatus($id){
        $invoice = Invoice::find($id);
        $invoice->status = $invoice->status+1;
        $invoice->update();

        $user = User::select('users.*')
        ->join('invoices', 'invoices.user_id', '=', 'users.id')
        ->where('invoices.id', '=', $id)
        ->first();

        if( $invoice->status == 2){
            //Đã xác nhận
            $message = [
                'type' => 'Đơn hàng',
                'hi' => $user->full_name,
                'content1' => 'Đơn hàng của bạn đã được xác nhận. Mã đơn hàng của bạn là: ',
                'num' => $invoice->invoice_code,
                'content2' => ' và tổng giá trị đơn hàng: '.number_format( $invoice->until_price, 0, '', '.').' VND.',
            ];
            SendEmail::dispatch($message, $user)->delay(now()->addMinute(1));

        }else if( $invoice->status == 3){
            //Đang giao
            $message = [
                'type' => 'Đơn hàng',
                'hi' => $user->full_name,
                'content1' => 'Đơn hàng của bạn đang được vận chuyển. Mã đơn hàng của bạn là: ',
                'num' => $invoice->invoice_code,
                'content2' => ' và tổng giá trị đơn hàng: '.number_format( $invoice->until_price, 0, '', '.').' VND',
            ];
            SendEmail::dispatch($message, $user)->delay(now()->addMinute(1));
        }else if( $invoice->status == 4){
            //Đã giao
            $message = [
                'type' => 'Đơn hàng',
                'hi' => $user->full_name,
                'content1' => 'Đơn hàng của bạn đã được giao. Mã đơn hàng của bạn là: ',
                'num' => $invoice->invoice_code,
                'content2' => ' và tổng giá trị đơn hàng: '.number_format( $invoice->until_price, 0, '', '.').' VND',
            ];
            SendEmail::dispatch($message, $user)->delay(now()->addMinute(1));

        }
        return Redirect::route('list-invoice')->with('msg','Đã duyệt đơn hàng '.$invoice->invoice_code);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::find($id);
        $invoice_v = DB::select("SELECT vouchers.* FROM invoices LEFT JOIN vouchers on voucher_id = vouchers.id WHERE invoices.id = {$id}");
        $invoice_details = DB::table('invoice_details')
        ->leftJoin('invoices','invoices.id','=','invoice_id')
        ->leftJoin('products','products.id','=','product_id')
        ->leftJoin('colors','colors.id','=','color_id')
        ->leftJoin('sizes','sizes.id','=','size_id')
        ->where('invoice_id','=',$id)
        ->select('invoice_details.*','products.*','invoices.quantity as invoice_quantity','sizes.*','colors.*')
        ->get();
        //  lay tong tien san pham
        $sum_price = DB::table('invoice_details')->where('invoice_id','=',$id)->sum('total_price');

        //lay thong tin nguoi huy
        $user_cancel = DB::table('invoices')
        ->leftJoin('users','users.id','=','invoices.canceler_id')
        ->where('invoices.id','=',$id)
        ->select('users.*')->get();
        // dd($user_cancel);
        return view('component.invoice.detail-invoice',compact('user_cancel','sum_price','invoice','invoice_details','invoice_v'));
    }
    public function searchStatus(Request $request){
        $invoice = DB::table('invoices')->where('status','=',$request->status_search)->get();
        $status_search = $request->searchStatus;
        // dd($invoice);
        return redirect::route('list-invoice',compact('invoice','status_search'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInvoiceRequest  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $user = Auth::user();
        $invoice = Invoice::where('invoices.id', '=', $id)
        ->first();
        if($invoice){
            $invoice->update([
                'destroy_status'=> $invoice->status,
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


            $user2 = User::select('users.*')
            ->join('invoices', 'invoices.user_id', '=', 'users.id')
            ->where('invoices.id', '=', $id)
            ->first();

            $message = [
                'type' => 'Đơn hàng',
                'hi' => $user2->full_name,
                'content1' => 'Mã đơn hàng: ',
                'num' => $invoice->invoice_code,
                'content2' => ' đã được huỷ. Lý do: '.$request->reason,
            ];
            SendEmail::dispatch($message, $user2)->delay(now()->addMinute(1));
        }
        $code = $invoice->invoice_code;
        return Redirect::route('list-invoice')->with('msg','Đã hủy thành công đơn hàng '.$code);
    }
}
