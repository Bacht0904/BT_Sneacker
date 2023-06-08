<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreVoucherRequest;
use App\Http\Requests\UpdateVoucherRequest;
use Illuminate\Http\Request as HttpRequest;
use Carbon\Carbon;

class VoucherController extends Controller
{
    //Danh sách hoá đơn
    public function getAllVoucher()
    {
        try {        
            $user = Auth::user();

            $vouchers = Voucher::select('vouchers.*')
            ->leftJoin('invoices', function($query) use ($user)
            {
                $query->on('invoices.voucher_id', '=', 'vouchers.id')
                    ->where('invoices.user_id', '=', $user->id)    
                    ->where('invoices.status', '<>', 0);
            })           
            ->where('invoices.id', '=', null)
            ->where('vouchers.start_date', '<=',  Carbon::now()->toDateString())
            ->where('vouchers.end_date', '>=',  Carbon::now()->toDateString())
            ->where('vouchers.status', '=', 1)
            ->orderBy('vouchers.id', 'DESC')
            ->get();

            return response()->json(['status'=>0, 'data'=>$vouchers, 'message'=>'']);
        } catch (\Throwable $e) {
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }        
    }
}
