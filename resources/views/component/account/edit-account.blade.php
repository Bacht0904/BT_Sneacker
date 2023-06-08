@extends('layouts.master')
@section('title','Chi tiết tài khoản')

@section('head')
@parent
@endsection

@section('content')
<div class="row">
    <div class="col-lg">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3  ">
                <div class="float-left d-flex">
                    <a class="d-flex" href="{{ route('list-user') }}"><i class="fa-solid fa-chevron-left mr-2"></i><h6 class="mr-3">Trở lại</h6></a>
                    <h6 class="m-0 font-weight-bold text-primary">Chi tiết tài khoản</h6>
                </div>
            </div>
            <div class="card-body">
                @if (!empty($success))
                    <h3>Cập nhật thành công.</h3>
                    <a href="{{ route('list-user') }}">Danh sách người dùng</a>
                @else
                <form action="{{ route('post-EditUser',$user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row d-flex justify-content-center" style="margin-bottom:40px; position: relative;">
                        <img style="border-radius:50%;border: solid 1px #ccc;" src="{{ asset('assets/img/users') }}/{{ $user->avatar }}" width="200">
                        <label for="avatar_reup"><i class="fa-solid fa-camera" style="font-size: 25px;background: blue;color: #fff;padding: 20px;border-radius: 50%;cursor: pointer;position: absolute;bottom: 0;right: 40%;"></i></label>
                        <input type="file" name="avatar_reup" accept="image/*" id="avatar_reup" style="display:none;">

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="full_name">Họ và tên</label>
                            <input type="text" name="full_name" id="full_name" placeholder="Họ và tên" class="form-control " value="{{ $user->full_name }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" placeholder="Email" class="form-control " value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="form-row">
                        {{-- <div class="form-group col-md-4">
                            <label for="birth_date">Ngày sinh</label>
                            <input type="date" name="birth_date" id="birth_date" class="form-control" value="@if($user->date_of_birth != null){{ $user->date_of_birth }} @endif">
                        </div> --}}
                        <div class="form-group col-md-4">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->phone }}">
                        </div>
                        <div class="form-group col-md-4 ">
                            <label for="gender">Giới tính</label>
                            <div class="form-row d-flex justify-content-center">
                                <div class="form-group col-md-4">
                                    <input type="radio" name="gender" id="male" value="0" @if ($user->sex == 0)
                                    checked
                                    @endif>
                                    <label for="male">Nam</label>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="radio" name="gender" id="female" value="1" @if ($user->sex == 1)
                                    checked
                                    @endif>
                                    <label for="female">Nữ</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="role">Loại</label>
                            <select name="role" id="role" class="form-control">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->role_value }}" @if($user->role == $role->role_value) selected @endif>{{ $role->role_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" id="address" placeholder="Địa chỉ" class="form-control" value="{{ $user->address }}">
                        </div>
                    </div>
                    <div class="from-row">
                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <select name="status" id="status" class="form-control">
                                @if ($user->status==0)
                                <option value="0" selected>Ngưng hoạt động</option>
                                <option value="1">Đang hoạt động</option>
                            @else
                                <option value="0" >Ngưng hoạt động</option>
                                <option value="1" selected>Đang hoạt động</option>
                            @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-row d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary "> Sửa </button>
                    </div>

                </form>
                @endif
            </div>
        </div>

    </div>



</div>
@endsection

@section('script')
@parent
    <script>

    </script>

@endsection
