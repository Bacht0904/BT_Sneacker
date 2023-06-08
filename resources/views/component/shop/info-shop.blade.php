@extends('layouts.master')
@section('title')
    Thông tin của shop
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
                    <h6 class="m-0 font-weight-bold text-primary">Thông tin của shop</h6>
                </div>
                <div class="float-right">
                    <a href="{{ route('get-editInfoStore') }}">Chỉnh sửa</a>
                </div>
            </div>
            @if (!empty($info))
            <div class="card-body">
                <div class="d-flex mb-lg-4">
                    <a title="Fanpage" href="{{ $info->page_fb }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook" style="font-size: 30px"></i></a>
                    <a title="Chat với khách hàng"class="ml-3" href="{{ $info->mess_manager }}" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook-messenger" style="font-size: 30px"></i></a>
                    <a title="Địa chỉ google map"class="ml-3" href="{{ $info->address_map }}" target="_blank" rel="noopener noreferrer"><i class="fa-solid fa-map-location" style="font-size: 30px"></i></a>

                </div>
                <ul style="list-style:none;line-height:2.0;">
                    <li><h4>Địa chỉ:</h4> {{ $info->address }}</li>
                    <li><h4>Số điện thoại:</h4> {{ $info->phone }}</li>
                </ul>
            </div>
            @else
                <div class="m-5">
                    <h2>Chưa có thông tin về cửa hàng. Bấm <a href="">vào đây</a> để thêm thông tin.</h2>
                </div>
            @endif

        </div>

    </div>



</div>
@endsection
@section('script')
    @parent
@endsection
