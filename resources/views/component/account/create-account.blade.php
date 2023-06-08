@extends('layouts.master')
@section('title')
    Tạo tài khoản
@endsection
@section('head')
    @parent
@endsection

@section('content')
<div class="row">

    <div class="col-lg">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tạo tài khoản</h6>
            </div>
            <div class="card-body">
                @if (!empty($success))
                    <h3>Thêm tài khoản thành công.</h3>
                    <a href="{{ route('list-user') }}">Danh sách người dùng</a>
                @else
                <form action="{{ route('post-CreateAccount') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-row">
                            {{-- <div class="form-group col-md-6">
                            <label for="product_code">Mã người dùng</label>
                            <input required type="text" class="form-control" name="product_code" id="product_code" value="{{ $productCode }}" placeholder="Mã sản phẩm" readonly >
                            </div> --}}
                            <div class="form-group col-md-6">
                            <label for="full_name">Họ và tên</label>
                            <input required type="text" class="form-control" name="full_name" id="full_name" placeholder="Họ và tên" value="{{ old('full_name') }}" >
                            </div>
                            <div class="form-group col-md-4 ">
                                <label for="gender">Giới tính</label>
                                <div class="form-row d-flex justify-content-center">
                                    <div class="form-group col-md-4">
                                        <input required type="radio" name="gender" id="male" value="0" checked>
                                        <label for="male">Nam</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input required type="radio" name="gender" id="female" value="1" >
                                        <label for="female">Nữ</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                      <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="role">Loại tài khoản</label>
                                <select required name="role" id="role" class="form-control">
                                    <option value="">-- Loại tài khoản --</option>
                                    @foreach ($roles as $role)
                                        @if ($role->role_value > 0)
                                            <option value="{{ $role->role_value }}">{{ $role->role_name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="email">Email</label>
                                <input required type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="phone">Số điện thoại</label>
                                <input required type="number" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" value="{{ old('phone') }}">
                            </div>
                            <div class="form-group col-md-3">
                                <label for="password">Mật khẩu</label>
                                <input required type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu" value="{{ old('password') }}">
                            </div>

                        </div>
                    </div>

                    {{-- <div class="form-row pl-4">
                        <div class="form-group col-md-3">
                        <input required type="file" name="avatar" value="{{ old('avatar') }}" accept="image/*" multiple required name="image">

                        </div>
                    </div> --}}
                    <div class="d-flex justify-content-end p-4">
                        <button class="btn btn-primary col-2"  type="submit">Thêm tài khoản</button>

                    </div>
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
@endsection
