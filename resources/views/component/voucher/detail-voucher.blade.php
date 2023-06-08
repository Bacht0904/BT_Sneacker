@extends('layouts.master')
@section('title')
    Chi tiết Voucher
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
                    <a class="d-flex" href="{{ route('list-voucher') }}"><i class="fa-solid fa-chevron-left mr-2"></i><h6 class="mr-3">Trở lại</h6></a>
                    <h6 class="m-0 font-weight-bold text-primary">Chi tiết Voucher</h6>
                </div>
                <div class="float-right d-flex">
                    <a class="d-flex" href="{{ route('get-EditVoucher',$voucher->id) }}"><h6>Chỉnh sửa</h6> <i class="fa-solid fa-chevron-right ml-2"></i></a>
                </div>
            </div>
            <div class="card-body">
                <ul style="list-style:none;line-height:2.0;">
                    <li>Mã voucher: {{ $voucher->voucher_code }}</li>
                    <li>Giá yêu cầu: {{ $voucher->min_total_price }}</li>
                    <li>Giá giảm: {{ $voucher->discount_price }}</li>
                    <li>Ngày bắt đầu: {{ $voucher->start_date }}</li>
                    <li>Ngày kết thúc: {{ $voucher->end_date }}</li>
                    <li>Mô tả: {{ $voucher->description }}</li>
                    <li>Trạng thái: {{ $voucher->status==0?'Không hoạt động':'Hoạt động' }}</li>
                </ul>

            </div>
        </div>

    </div>



</div>
@endsection
@section('script')
    @parent
@endsection
