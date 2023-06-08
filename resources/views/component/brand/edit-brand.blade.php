@extends('layouts.master')
@section('title')
    Chỉnh sửa thương hiệu
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
                <h6 class="m-0 font-weight-bold text-primary">Chỉnh sửa thương hiệu</h6>
            </div>
            <div class="card-body">
                @if (!empty($success))
                    <h3>Cập nhật thành công.</h3>
                    <a href="{{ route('list-brand') }}">Danh sách thương hiệu</a>
                @else
                <form action="{{ route('post-EditBrand',$brand->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="brand_name">Tên thương hiệu</label>
                                <input type="text" class="form-control" name="brand_name" id="brand_name" placeholder="Tên thương hiệu" value="{{ $brand->brand_name}}" >
                                </div>
                            <div class="form-group col-md-4">
                            <label for="company">Tên công ty</label>
                            <input type="text" class="form-control" name="company" id="company" placeholder="Tên công ty" value="{{ $brand->company }}" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="company_code">Mã thuế</label>
                                <input type="number" class="form-control" name="company_code" id="company_code" placeholder="Mã thuế công ty" value="{{$brand->company_code }}" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="bank_name">Tên ngân hàng</label>
                                <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Tên ngân hàng" value="{{ $brand->bank_name }}" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="bank_num">Số tài khoản</label>
                                <input type="number" class="form-control" name="bank_num" id="bank_num" placeholder="Số tài khoản ngân hàng" value="{{ $brand->bank_num }}" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="bank_account_name">Tên tài khoản</label>
                                <input type="text" class="form-control" name="bank_account_name" id="bank_account_name" placeholder="Tên tài khoản ngân hàng" value="{{ $brand->bank_account_name }}" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phone_number">Số điện thoại</label>
                                <input type="number" class="form-control" name="phone_number" id="phone_number" placeholder="Số điện thoại" value="{{ $brand->phone_number }}" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="{{ $brand->email }}" >
                            </div>
                        </div>
                        <div class="from-row">
                            <div class="form-group">
                                <label for="status">Trạng thái</label>
                                <select name="status" id="status" class="form-control">
                                    @if ($brand->status==0)
                                    <option value="0" selected>Ngưng hoạt động</option>
                                    <option value="1">Hoạt động</option>
                                @else
                                    <option value="0" >Ngưng hoạt động</option>
                                    <option value="1" selected>Hoạt động</option>
                                @endif
                                </select>
                            </div>
                        </div>

                    <div class="d-flex justify-content-end p-4">
                        <button class="btn btn-primary col-2"  type="submit">Cập nhật</button>

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
