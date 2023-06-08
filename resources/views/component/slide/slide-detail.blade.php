@extends('layouts.master')
@section('title')
    Chi tiết slide
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
                    <a class="d-flex" href="{{ route('list-slide') }}"><i class="fa-solid fa-chevron-left mr-2"></i><h6 class="mr-3">Trở lại</h6></a>
                    <h6 class="m-0 font-weight-bold text-primary">Chi tiết slide</h6>
                </div>
                <div class="float-right d-flex">
                    <a class="d-flex" href="{{ route('get-EditSlide',$slide->id) }}"><h6>Chỉnh sửa</h6> <i class="fa-solid fa-chevron-right ml-2"></i></a>
                </div>
            </div>
            <div class="card-body">
                <ul style="list-style:none;line-height:2.0;">
                    <li><h4>Hình ảnh:</h4> <br> <img height="150" src="{{ asset('assets/img/slideshows') }}/{{ $slide->picture }}"></li>
                    <li><h4>Mô tả:</h4> {!! Str::limit( $slide->description, 20000) !!}</li>
                </ul>

            </div>
        </div>

    </div>



</div>
@endsection
@section('script')
    @parent
@endsection
