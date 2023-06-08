@extends('layouts.master')
@section('title')
    {{ $title }}
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
                    <a class="d-flex" href="{{ route('products') }}"><i class="fa-solid fa-chevron-left mr-2"></i><h6 class="mr-3">Trở lại</h6></a>
                    <h6 class="m-0 font-weight-bold text-primary">{{$title}}</h6>
                </div>
                <div class="float-right d-flex">
                    <a class="d-flex" href="{{ route('edit-product',$product->id) }}"><h6>Chỉnh sửa</h6> <i class="fa-solid fa-chevron-right ml-2"></i></a>
                </div>
            </div>
            <div class="card-body">
                <ul style="list-style:none;line-height:2.0;">
                    <li>@foreach ($pics as $pro)
                        <img height="150" src="{{ asset('assets/img/products') }}/{{ $pro->picture_value }}">
                    @endforeach </li>
                    <li>Mã sản phẩm: {{ $product->product_barcode }}</li>
                    <li>Tên sản phẩm: {{ $product->product_name }}</li>
                    <li>Giá bán: {{ $product->price }}</li>
                    <li>Lượt thích: {{ $product->num_like }}</li>
                    <li>Lượt đánh giá: {{ $product->num_rate }}</li>
                    <li>Mô tả: {!! Str::limit( $product->description, 20000) !!}</li>
                </ul>

            </div>
        </div>

    </div>



</div>
@endsection
@section('script')
    @parent
@endsection
