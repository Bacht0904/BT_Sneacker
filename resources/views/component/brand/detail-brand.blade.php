@extends('layouts.master')
@section('title')
    Chi tiết thương hiệu
@endsection
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
                    <a class="d-flex" href="{{ route('list-brand') }}"><i class="fa-solid fa-chevron-left mr-2"></i><h6 class="mr-3">Trở lại</h6></a>
                    <h6 class="m-0 font-weight-bold text-primary">Chi tiết thương hiệu</h6>
                </div>
                <div class="float-right d-flex">
                    <a class="d-flex" href="{{ route('get-EditBrand',$brand->id) }}"><h6>Chỉnh sửa</h6> <i class="fa-solid fa-chevron-right ml-2"></i></a>
                </div>
            </div>
            <div class="card-body">
                <ul style="list-style:none;line-height:2.0;">

                    <li>Tên thương hiệu: {{ $brand->brand_name }}</li>
                    <li>Tên công ty: {{ $brand->company }}</li>
                    <li>Mã số thuế: {{ $brand->company_code }}</li>
                    <li>Số tài khoản: {{ $brand->bank_num }}</li>
                    <li>Tên ngân hàng: {{ $brand->bank_name }}</li>
                    <li>Tên tài khoản ngân hàng: {{ $brand->bank_account_name }}</li>
                    <li>Số điện thoại: {{ $brand->phone_number }}</li>
                    <li>Email: {{ $brand->email }}</li>
                </ul>

            </div>
        </div>

    </div>



</div>
@endsection
@section('script')
    @parent
@endsection
