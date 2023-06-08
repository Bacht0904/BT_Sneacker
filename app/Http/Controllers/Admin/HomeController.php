<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    //đếm số người dùng
    public function statistic(Request $request){
        $countUser = DB::table('users')->where([['role','=',0],['status','=',1]])->count();
        $date = Date('Y-m-d');
        //DT hom nay
        $saleNowDay = DB::table('invoices')
        ->where('status','=',4)
        ->whereDate('created_at','=',$date)
        ->sum('until_price');
        //DT thang nay
        $saleNowMonth = DB::table('invoices')
        ->where('status','=',4)
        ->whereMonth('created_at','=',Carbon::parse($date)->format('m'))
        ->whereYear('created_at','=',Carbon::parse($date)->format('Y'))
        ->sum('until_price');
        // dd($saleNowMonth);
        $saleNowYear = DB::table('invoices')
        ->where('status','=',4)
        ->whereYear('created_at','=',Carbon::parse($date)->format('Y'))
        ->sum('until_price');

        //so don hang
        $num_invocie = Invoice::where('status','=','4')->count();

        // bieu do doanh thu thep tung thang cua nam hien tai
        $year = $request->startYear;
        if(!empty($year)){
            $data = DB::select("SELECT MONTH(created_at) as 'month',SUM(until_price) as 'sale' from invoices WHERE status = 4 and year(created_at) = '{$year}' GROUP BY month ORDER BY MONTH(created_at)");
        }else{
            $data = DB::select("SELECT MONTH(created_at) as 'month',SUM(until_price) as 'sale' from invoices WHERE status = 4 and year(created_at) = '{$date}' GROUP BY month ORDER BY MONTH(created_at)");
        }
        $months=[];
        $monthSum=[];
        if($data){
            for ($i=0; $i < count($data); $i++) {
                if($i+1<$data[$i]->month){
                    if($i==0){
                        for ($j=$i+1; $j < $data[$i]->month - $i; $j++) {
                            $months[]="Tháng ".$j;
                            $monthSum[]=0;
                        }
                    }else{
                        for ($j=$data[$i-1]->month + 1 ; $j < $data[$i]->month; $j++) {
                            $months[]="Tháng ".$j;
                            $monthSum[]=0;
                        }
                    }
                }
                $months[]="Tháng ".$data[$i]->month;
                $monthSum[]=$data[$i]->sale;
            }
            if($data[count($data)-1]->month<12){
                for ($j=$data[count($data)-1]->month + 1 ; $j < 13; $j++) {
                    $months[]="Tháng ".$j;
                    $monthSum[]= 0;
                }
            }
        }
        // foreach ($data as $value){
        //     $months[]="Tháng ".$value->month;
        //     $monthSum[]=$value->sale;
        // }

        // dd($months,$saleNowYear);
        return view('home',['saleNowYear'=>$saleNowYear,'num_invocie'=>$num_invocie,'countUser'=>$countUser,'saleNowDay' => $saleNowDay,'saleNowMonth'=>$saleNowMonth,'months'=>$months,'monthSum'=>$monthSum,'year'=>$year]);
    }


    // public function saleOfYear(Request $request){
    //     // $year = $request->year;
    //     // $data = DB::select("SELECT MONTH(created_at) as 'month', Year(created_at) as 'year',SUM(until_price) as 'sale'
    //     // from invoices WHERE status = 4 and year(created_at) = '{$year}'
    //     // GROUP BY month, year");

    //     // $months=[];
    //     // $monthSum=[];
    //     // $yearSum=$data[0]->year;
    //     // foreach ($data as $value){
    //     //     $months[]="Tháng ".$value->month;
    //     //     $monthSum[]=$value->sale;
    //     // }
    //     // // dd($months,$monthSum,$yearSum);
    //     // return Redirect::route('home',['months'=>$months,'monthSum'=>$monthSum,'year'=>$year]);
    // }
}
