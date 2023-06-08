@extends('layouts.master')
@section('title')
    Chi tiết đơn hàng
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
                    <a class="d-flex" href="{{ route('list-invoice') }}"><i class="fa-solid fa-chevron-left mr-2"></i><h6 class="mr-3">Trở lại</h6></a>
                    <h6 class="m-0 font-weight-bold text-primary">Chi tiết đơn hàng</h6>
                </div>
                {{-- <div class="float-right d-flex">
                    <a class="d-flex" href="{{ route('get-EditBrand',$invoice->id) }}"><h6>Chỉnh sửa</h6> <i class="fa-solid fa-chevron-right ml-2"></i></a>
                </div> --}}
            </div>
            <div class="card-body">
                <ul style="list-style:none;line-height:2.0;">

                    <li><h3>Đơn hàng: #{{ $invoice->invoice_code }}</h3></li>
                    <li>Tình trạng:
                        @if ($invoice->status==0)
                                <span class="text-danger">Đã hủy lúc
                                    @if ($invoice->destroy_status == 1)
                                        chờ xác nhận
                                    @elseif ($invoice->destroy_status == 2)
                                        đã xác nhận
                                    @elseif ($invoice->destroy_status == 3)
                                        đang giao
                                @endif</span>
                            @elseif($invoice->status==1)
                                <span class="text-warning">Chờ xác nhận</span>
                            @elseif($invoice->status==2)
                                <span class="text-success">Đã xác nhận</span>
                            @elseif($invoice->status==3)
                                <span class="text-warning">Đang vận chuyển</span>
                            @else
                                <span class="text-primary">Đã giao</span>
                            @endif
                    </li>
                    @if ($invoice->status==0)
                        <li>Người hủy: @if ($user_cancel[0]->role == 1)
                            Admin
                        @elseif ($user_cancel[0]->role == 2)
                            Nhân viên
                        @else
                            Khách hàng
                        @endif - {{ $user_cancel[0]->full_name }}</li>
                        
                    @endif
                    <li><hr></li>
                    @foreach ($invoice_details as $key=>$item)
                        <li class="mt-5">Sản phẩm {{ $key+1 }}: {{ $item->product_name }} </li>
                        <li>Giá sản phẩm: {{ number_format($item->price, 0, '', '.')." VNĐ"; }}</li>
                        <li>Số lượng: {{ $item->quantity }}</li>
                        <li>Kích thước: {{ $item->size_name }}</li>
                        <li>Màu: {{ $item->color_name }}</li>
                        <li>Hình ảnh: <br> <img src="{{ asset('assets/img/product_colors') }}/{{ $item->picture }}" height="200"></li>
                        <li><hr></li>
                    @endforeach

                    <li class="mt-5">Mã giảm giá: @if(!empty($invoice->voucher_id)){{ $invoice_v[0]->voucher_code }}@else Không áp dụng @endif</li>
                    <li>Tổng số tiền({{ $invoice->quantity }} sản phẩm): {{ number_format($sum_price , 0, '', '.')." VNĐ"}}</li>
                    <li>Giá giảm: @if(!empty($invoice->voucher_id)){{ number_format($invoice_v[0]->discount_price, 0, '', '.')." VNĐ"; }}@else 0 VNĐ @endif</li>
                    <li>Phí ship: @if ($invoice->ship_price != 0)
                        {{ number_format($invoice->ship_price, 0, '', '.')." VNĐ"; }}
                    @else
                        Free ship
                    @endif </li>
                    <li>Tổng : {{ number_format($invoice->until_price, 0, '', '.')." VNĐ"; }}</li>
                </ul>

            </div>
        </div>

    </div>



</div>
@endsection
@section('script')
    @parent
@endsection
