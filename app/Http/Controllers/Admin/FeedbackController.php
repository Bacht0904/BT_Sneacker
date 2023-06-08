<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendEmail;
use Illuminate\Support\Facades\Redirect;


class FeedbackController extends Controller
{
    public function index(){
        $feedbacks = DB::table('feedback')
        ->leftJoin('users','users.id','=','user_id')
        ->select('feedback.*','users.full_name')
        ->get();

        return view('component.feedback.list-feedback',compact('feedbacks'));
    }

    public function rep($id,Request $request){
        $user = DB::table('feedback')
        ->leftJoin('users','users.id','=','feedback.user_id')
        ->where('feedback.id', '=', $id)
        ->select('users.*')
        ->first();

        DB::table('feedback')->update([
            'check'=>1,
        ]);
        
        $message = [
            'type' => 'Phản hồi',
            'hi' => $user->full_name,
            'content1' => '',
            'num' => '',
            'content2' => ''.$request->reason,
        ];
        SendEmail::dispatch($message, $user)->delay(now()->addMinute(1));

        return Redirect::route('list-feedback')->with('msg','Đã gửi phản hồi cho khách hàng');
    }

}
