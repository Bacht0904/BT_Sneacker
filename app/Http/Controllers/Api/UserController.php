<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Feedback;
use Carbon\Carbon;
use Validator;
use File;
use Hash;
use App\Jobs\SendEmail;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    //Đăng ký
    public function register(HttpRequest $request) 
    { 
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [ 
                'name' => 'required', 
                'phone' => 'required',
                'email' => 'required|email', 
                'password' => 'required', 
            ]);
            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);
            } 
            else{
                $validator = Validator::make($request->all(), [ 
                    'phone' => 'unique:users',
                ]);
                if ($validator->fails()) { 
                    return response()->json(['status'=>-2, 'data'=>'', 'message'=>'Số điện thoại đã được đăng ký']);
                } 
                $user = User::create([
                    'full_name' => $request->name, 
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'avatar' => 'default_avatar.png',
                    'role' => 0,
                    'status' => true
                ]); 
                DB::commit();
                return response()->json(['status'=>0, 'data'=>$user->id.'', 'message'=>'Đăng ký thành công!']);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
    }

    //Đăng nhập
    public function login(HttpRequest $request)
    {        
        try {
            $validator = Validator::make($request->all(), [ 
                'phone' => 'required', 
                'password' => 'required', 
            ]);
            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);
            }
            if(Auth::attempt(['phone' => $request->phone, 'password' => $request->password])){ 
                $user = Auth::user(); 
                if($user->role == 0 && $user->status == 1){
                    $token = $user->createToken('MobileApp', ['Graceful'])->plainTextToken;
                    return response()->json(['status'=>0, 'data'=>$token, 'message'=>'Đăng nhập thành công!']); 
                } else {
                    if($user->role != 0)
                    {
                        return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Tài khoản không tồn tại!']);
                    }
                    else{
                        return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Tài khoản đã bị khoá!']);
                    }                    
                }
            } 
            else{ 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Tài khoản hoặc mật khẩu không chính xác!']);
            } 
        } catch (\Exception $e) {
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
    }

    //Đăng nhập với google
    protected function loginWithGoogle(HttpRequest $request){
        try {
            // Getting the user from socialite using token from google
            // $user_google = Socialite::driver('google')->stateless()->userFromToken($request->token);
            // dd($user_google);
            // Getting or creating user from db
        
            $user = User::firstOrCreate(
                [
                    'email' => $request->email,
                    'type_login' => 1,
                ],
                [
                    // 'email_verified_at' => now(),
                    'full_name' => $request->displayName,
                    'phone' => "",
                    'avatar' => $request->photoUrl,
                    'role' => 0,
                    'status' => true,
                ]
            );

            // Returning response
            $token = $user->createToken('MobileApp', ['Graceful'])->plainTextToken;
            return response()->json(['status'=>0, 'data'=>$token, 'message'=>'Đăng nhập thành công!']); 

        } catch (\Exception $e) {
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
    }


    //Đăng xuất
    public function logout()
    {
        try {
            Auth::user()->tokens()->delete();
            return response()->json(['status'=>0, 'data'=>'', 'message'=>'Đăng xuất thành công!']); 
        } catch (\Throwable $e) {
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
    }

    //Đổi mật khẩu
    public function changePass(HttpRequest $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [ 
                'old_pass' => 'required', 
                'new_pass' => 'required', 
            ]);            
            $user = Auth::user();
            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);
            }           
            if(Auth::guard('web')->attempt(['phone' => $user->phone, 'password' => $request->old_pass])){ 
                
                $user->update(['password' => Hash::make($request->new_pass)]);
                // Auth::user()->tokens()->delete();
                $tokens = $user->tokens;
                foreach ($tokens as $tKey => $token) {
                    $token->delete();
                }                
                DB::commit();
                return response()->json(['status'=>0, 'data'=>'', 'message'=>'Đổi mật thành công!']); 
            } 
            else{ 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Mật khẩu cũ không chính xác!']);
            }               
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
        
    }

    //Thông tin người dùng 
    public function info() 
    { 
        try {            
            // $user = Auth::user(); 
            $user = User::where('role', '=', 0)
            ->where('status', '=', 1)
            ->where('id', '=', Auth::user()->id)
            ->first();

            if( explode(':', $user->avatar)[0] != 'https'){
                $user->avatar = "assets/img/users/".$user->avatar;
            }

            return response()->json(['status'=>0, 'data' => $user, 'message'=>'']);   
        } catch (\Throwable $e) {
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
    } 

    //Thay đổi thông tin người dùng 
    public function changeInfo(HttpRequest $request) 
    { 
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [ 
                'full_name' => 'required', 
                'date_of_birth' => 'nullable|date',
                'sex' => 'nullable|int',
                'email' => 'email',
                'address' => 'nullable|string',
                'avatar' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:10240'
            ]);            
            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);
            }      

            $user = Auth::user();
            
            if($request->hasFile('avatar')){
                if($user->avatar != 'default_avatar.png' && explode(':', $user->avatar)[0] != 'https'){
                    //Xoá ảnh cũ
                    unlink(public_path('/assets/img/users/'.$user->avatar));
                }               
                $image= $request->file('avatar');
                $namewithextension = $image->getClientOriginalName();
                $fileName = explode('.', $namewithextension)[0];
                $extension = $image->getClientOriginalExtension();
                $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
                $destinationPath = public_path('/assets/img/users/');
                $image->move($destinationPath,$fileNew);
                $user->update([
                    'full_name' => $request->full_name,
                    'date_of_birth' => $request->date_of_birth,
                    'sex' => $request->sex,
                    'email' => $request->email,
                    'address' => $request->address,
                    'avatar' => $fileNew,
                ]);
            }else{
                $user->update([
                    'full_name' => $request->full_name,
                    'date_of_birth' => $request->date_of_birth,
                    'sex' => $request->sex,
                    'email' => $request->email,
                    'address' => $request->address,
                ]);    
            }
            DB::commit();
            return response()->json(['status'=>0, 'data'=>'', 'message'=>'Cập nhật thông tin thành công!']);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
    } 

    //Thay đổi ảnh đại diện
    public function changeAvatar(HttpRequest $request) 
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [ 
                'avatar' => 'nullable|image|mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:10240'
            ]);
            
            if ($validator->fails()) {
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);         
            }
            
            $user = Auth::user();
            if($request->hasFile('avatar')){
                if($user->avatar != 'default_avatar.png' && explode(':', $user->avatar)[0] != 'https'){
                    //Xoá ảnh cũ
                    unlink(public_path('/assets/img/users/'.$user->avatar));
                }               
                $image= $request->file('avatar');
                $namewithextension = $image->getClientOriginalName();
                $fileName = explode('.', $namewithextension)[0];
                $extension = $image->getClientOriginalExtension();
                $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
                $destinationPath = public_path('/assets/img/users/');
                $image->move($destinationPath,$fileNew);
                $user->update([
                    'avatar' => $fileNew,
                ]);
                DB::commit();
                return response()->json(['status'=>0, 'data'=>'assets/img/users/'.$fileNew, 'message'=>'Cập nhật thành công!']);
            }
            else{
                DB::rollBack();
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Không tìm thấy ảnh']);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
    }

    //Gửi phản hồi
    public function sendFeedback(HttpRequest $request)
    {        
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [ 
                'description' => 'required', 
            ]);
            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);
            }

            $user = Auth::user();

            Feedback::create([
                'user_id'=> $user->id,
                'description'=> $request->description,
            ]); 
            
            $message = [
                'type' => 'Phản hồi',
                'hi' => $user->full_name,
                'content1' => 'Chúng tôi đã tiếp nhận phản hồi của bạn',
                'num' => '',
                'content2' => '',
            ];
            SendEmail::dispatch($message, $user)->delay(now()->addMinute(1));

            DB::commit();
            return response()->json(['status'=>0, 'data'=>'', 'message'=>'Gửi phản hồi thành công!']);
        
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
    }

    //Quên mật khẩu
    public function forgotPass(HttpRequest $request)
    {        
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [ 
                'phone' => 'required', 
                'new_pass' => 'required', 
                'otp' => 'required', 
            ]);
            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);
            }

            $user = User::where('phone', '=', $request->phone)
            ->where('otp', '=', $request->otp)
            ->where('type_login', '=', 0)
            ->first();

            if($user){
                $user->update(['otp' => null]);
                $user->update(['password' => Hash::make($request->new_pass)]);

                $tokens = $user->tokens;
                foreach ($tokens as $tKey => $token) {
                    $token->delete();
                }

                DB::commit();
                return response()->json(['status'=>0, 'data'=>'', 'message'=>'Mật khẩu đã được thay đổi thành công!']);
            }
            else{
                $user = User::where('phone', '=', $request->phone)
                ->where('type_login', '=', 0)
                ->update(['otp' => null]);
                DB::commit();
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Không thành công!']);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
    }

    //Gửi OTP
    public function requestOtp(HttpRequest $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [ 
                'phone' => 'required', 
            ]);
            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);
            }

            $otp = rand(1000,9999);
            Log::info("otp = ".$otp);   

            $user = User::where('phone','=',$request->phone)->first();
            User::where('id', '=', $user->id)
            ->where('type_login', '=', 0)
            ->update(['otp' => $otp]);

            $message = [
                'type' => 'Mã xác thực',
                'hi' => $user->full_name,
                'content1' => 'Sau đây là mã xác thực của bạn: ',
                'num' => $otp,
                'content2' => '. Vui lòng không cung cấp mã này cho bất kỳ ai!',
            ];
            SendEmail::dispatch($message, $user)->delay(now()->addMinute(1));
            DB::commit();
            return response()->json(['status'=>0, 'data'=>'', 'message'=>'Mã xác thực đã được gửi về mail bạn']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
    }

    //Xác thực OTP
    public function verifyOtp(HttpRequest $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make($request->all(), [ 
                'phone' => 'required', 
                'otp' => 'required', 
            ]);
            if ($validator->fails()) { 
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>$validator->errors()->all()[0]]);
            }

            $user = User::where('phone', '=', $request->phone)
            ->where('otp', '=', $request->otp)
            ->where('type_login', '=', 0)
            ->first();

            if($user){
                $user->update(['otp' => null]);
                DB::commit();
                return response()->json(['status'=>0, 'data'=>'', 'message'=>'Thành công!']);
            }
            else{
                $user = User::where('phone', '=', $request->phone)
                ->where('type_login', '=', 0)
                ->update(['otp' => null]);
                DB::commit();
                return response()->json(['status'=>-1, 'data'=>'', 'message'=>'Không thành công!']);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['status'=>-5, 'data'=>'', 'message'=>$e->getMessage()]);
        }
    }
}
