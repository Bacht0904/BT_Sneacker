<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\LoginRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getUsers(Request $request){
        $title = 'Danh sách người dùng';
        $role = Role::all();
        $users = DB::select('SELECT users.*,roles.role_name FROM users,roles WHERE users.role = roles.role_value and users.role != 1 ORDER BY created_at DESC');

        $filter = $request->filter_users;
        if($filter != null){
            if($filter == 1){
                // user đang hoạt động
                $users = DB::table('users')
                ->leftJoin('roles','roles.role_value','=','users.role')
                ->where([['users.role','!=',1],['users.status','=',1]])
                ->select('users.*','roles.role_name')->get();
            }else if($filter == 2){
                // user ngung hoạt động
                $users = DB::table('users')
                ->leftJoin('roles','roles.role_value','=','users.role')
                ->where([['users.role','!=',1],['users.status','=',0]])
                ->select('users.*','roles.role_name')->get();
            }else if($filter == 3){
                // user nhan vien
                $users = DB::table('users')
                ->leftJoin('roles','roles.role_value','=','users.role')
                ->where('users.role','=',2)
                ->select('users.*','roles.role_name')->get();
            }else if($filter == 4){
                // user nguoi dung
                $users = DB::table('users')
                ->leftJoin('roles','roles.role_value','=','users.role')
                ->where('users.role','=',0)
                ->select('users.*','roles.role_name')->get();
            }else{
                $users = DB::table('users')
                ->leftJoin('roles','roles.role_value','=','users.role')
                ->where('users.role','!=',1)
                ->select('users.*','roles.role_name')
                ->orderBy('id','desc')->get();
            }
        }
        else{
            $users = DB::table('users')
            ->leftJoin('roles','roles.role_value','=','users.role')
            ->where('users.role','!=',1)
            ->select('users.*','roles.role_name')
            ->orderBy('id','desc')->get();
            $filter = -1;
        }

        return view('component.account.users',compact('title','users','role','filter'));
    }




    public function getLogin(){
        return view('component.login');
    }
    public function postLogin(Request $request){
        if((Auth::attempt(['phone' => $request->phone, 'password' =>
            $request->password])))
            {

                $account=Auth::User();


                if(Auth::User()->role != 0)
                {
                    Session::flash('success', 'Đăng Nhập thành công');
                    return redirect()->route('home');
                }
                else
                {
                    Session::flash('error', 'Tài khoản hoặc mật khẩu không đúng!');
                    return redirect('login');
                }
                //return view("component/index");
            }
            else
            {
                    // Kiểm tra không đúng sẽ hiển thị thông báo lỗi
                    Session::flash('error', 'Tài khoản hoặc mật khẩu không đúng!');
                    return redirect('login');
            }
    }
    public function getCreateAccount(){

        $roles = Role::all();

        return view('component.account.create-account',compact('roles'));
    }
    public function postCreateAccount(Request $request){


        $fileNew = "default_avatar.png";

        $user = new User();
        $user->avatar = $fileNew;
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->status = 1;
        return view('component.account.create-account',['success'=>$user->save()]);
    }
    //edit
    public function getEditUser($id){
        $roles = Role::all();
        $user = User::all()->find($id);
        return view('component.account.edit-account',compact('user','roles'));
    }
    public function postEditUser( Request $request,$id){
        $user = User::find($id);
        if($request->hasFile('avatar_reup')){
            $image = $request->file('avatar_reup');
            $namewithextension = $image->getClientOriginalName();
            $fileName = explode('.', $namewithextension)[0];
            $extension = $image->getClientOriginalExtension();
            $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
            $destinationPath = public_path('/assets/img/users/');
            $image->move($destinationPath,$fileNew);

            $user->avatar = $fileNew;
            $user->full_name = $request->input('full_name');
            $user->date_of_birth = $request->input('date_of_birth');
            $user->sex = $request->input('gender');
            $user->phone = $request->input('phone');
            $user->role = $request->input('role');
            $user->address = $request->input('address');
            $user->status = $request->input('status');
        }else{
            $user->full_name = $request->input('full_name');
            $user->date_of_birth = $request->input('date_of_birth');
            $user->sex = $request->input('gender');
            $user->phone = $request->input('phone');
            $user->role = $request->input('role');
            $user->address = $request->input('address');
            $user->status = $request->input('status');
        }
        $success = $user->update();
        return view('component.account.edit-account',compact('success'));
    }
    public  function getProfile(){
        $user = Auth::user();
        $roles = Role::all();
        return view('component.account.profile',compact('user','roles'));
    }
    public function postProfile(Request $request){
        $get_user = Auth::user();
        $user_id = $get_user->id;
        $user = User::find($user_id);
        // dd($user_id);

        if($request->hasFile('avatar_reup')){
            $image = $request->file('avatar_reup');
            $namewithextension = $image->getClientOriginalName();
            $fileName = explode('.', $namewithextension)[0];
            $extension = $image->getClientOriginalExtension();
            $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
            $destinationPath = public_path('/assets/img/users/');
            $image->move($destinationPath,$fileNew);

            $user->avatar = $fileNew;
            $user->full_name = $request->input('full_name');
            $user->date_of_birth = $request->input('date_of_birth');
            $user->sex = $request->input('gender');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address');
        }else{
            $user->full_name = $request->input('full_name');
            $user->date_of_birth = $request->input('date_of_birth');
            $user->sex = $request->input('gender');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address');
        }
        // dd($user);
        $success = $user->update();
        return view('component.account.profile',compact('user','success'));
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->status = 0;
        $name=$user->full_name;
        $user->update();
        return redirect()->route('list-user')->with('msg','Đã ngưng hoạt động thành công người dùng '.$name);

    }

// doi mat khau
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'currentPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            're-Password' => 'required|min:6|same:newPassword'
        ],
        [
            'required' => ':attribute không được bỏ trống.',
            'min' => ':attribute yêu cầu độ dài từ :min ký tự',
            'same' => ':attribute phải trùng với Mật khẩu mới'
        ],
        [
            'currentPassword' => 'Mật khẩu hiện tại',
            'newPassword' => 'Mật khẩu mới',
            're-Password' => 'Xác nhận mật khẩu'
        ]
    );
    $user = Auth::user();
    if(Hash::check($request->currentPassword, $user->password)){
        $user->password = Hash::make($request->newPassword);
        $user->update();
        // dd($user->password);
        return Redirect::route('login')->with('msg','Thay đổi mật khẩu thành công!');
    }else{
        return Redirect::back()->withErrors($validator);
    }
    }

}

