@extends('layouts.master')
@section('title','Thông tin tài khoản người dùng')

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
                    <a class="d-flex" href="{{ route('home') }}"><i class="fa-solid fa-chevron-left mr-2"></i><h6 class="mr-3">Trở lại</h6></a>
                    <h6 class="m-0 font-weight-bold text-primary">Thông tin tài khoản người dùng</h6>
                </div>
            </div>
            <div class="card-body">
                @if (!empty($success))
                    <h3>Cập nhật thành công.</h3>
                    <a href="{{ route('home') }}">Trang chủ</a>
                @else
                <form action="{{ route('post-Profile') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row d-flex justify-content-center" style="margin-bottom:40px; position: relative;">
                        <img style="border-radius:50%;border: solid 1px #ccc;" src="{{ asset('assets/img/users') }}/{{ Auth::User()->avatar }}" width="200">
                        <label for="avatar_reup"><i class="fa-solid fa-camera" style="font-size: 25px;background: blue;color: #fff;padding: 20px;border-radius: 50%;cursor: pointer;position: absolute;bottom: 0;right: 40%;"></i></label>
                        <input type="file" name="avatar_reup" accept="image/*" id="avatar_reup" style="display:none;">

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="full_name">Họ và tên</label>
                            <input type="text" name="full_name" id="full_name" placeholder="Họ và tên" class="form-control " value="{{ Auth::User()->full_name }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" placeholder="Email" class="form-control " value="{{ Auth::User()->email }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="birth_date">Ngày sinh</label>
                            <input type="text" name="birth_date"  id="birth_date" class="form-control" value="@if($user->date_of_birth != null){{ $user->date_of_birth }} @else Chưa cập nhật @endif">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" name="phone" id="phone" disabled class="form-control" value="{{ Auth::User()->phone }}">
                        </div>
                        <div class="form-group col-md-4 ">
                            <label for="gender">Giới tính</label>
                            <div class="form-row d-flex justify-content-center">
                                <div class="form-group col-md-4">
                                    <input type="radio" name="gender" id="male" value="0" @if (Auth::User()->sex == 0)
                                    checked
                                    @endif>
                                    <label for="male">Nam</label>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="radio" name="gender" id="female" value="1" @if (Auth::User()->sex == 1)
                                    checked
                                    @endif>
                                    <label for="female">Nữ</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" id="address" placeholder="Địa chỉ" class="form-control" value="{{ Auth::user()->address }}">
                        </div>
                    </div>
                    <div class="form-row d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary "> Cập nhật </button>
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
    <script type="text/javascript">
        $( "#birth_date" ).datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "yy-mm-dd",
            dayNamesMin: ["T2","T3","T4","T5","T6","T7","CN"],
            monthNamesShort: [ "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5","Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12" ],
            monthNames: [ "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5","Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12" ],
            duration:"slow",
            changeMonth: "true",
            changeYear: "true",
            yearRange: "1980:2022"
        });
    </script>

@endsection
