@extends('layouts.master')
@section('title')
    Sửa thông tin shop
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
                <a href="{{ route('info-store') }}">Trở lại</a>
                <h6 class="m-0 font-weight-bold text-primary">Sửa thông tin shop</h6>
            </div>
            <div class="card-body">
                @if (!empty($success))
                    <h3>Cập nhật thành công.</h3>
                    <a href="{{ route('info-store') }}">Thông tin của shop</a>
                @else
                <form action="{{ route('post-editInfoStore') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="address">Địa chỉ:</label>
                        <input required class="form-control" type="text" value="{{ $info->address }}" placeholder="Địa chỉ shop" name="address" id="address">
                    </div>
                    <div class="form-group">
                        <label for="address_map">Địa chỉ (Google map):</label>
                        <input required class="form-control" type="text" value="{{ $info->address_map }}" placeholder="Copy đường dẫn vào đây.." name="address_map" id="address_map">
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại:</label>
                        <input required class="form-control" type="number" value="{{ $info->phone }}" placeholder="Số điện thoại liên lạc" name="phone" id="phone">
                    </div>
                    <div class="form-group">
                        <label for="fanpage">Link Fanpage:</label>
                        <input required class="form-control" type="text" value="{{ $info->page_fb }}" placeholder="Copy đường dẫn vào đây.." name="fanpage" id="fanpage">
                    </div>
                    <div class="form-group">
                        <label for="mess_chat">Link người dùng chat:</label>
                        <input required class="form-control" type="text" value="{{ $info->mess_chat }}" placeholder="Copy đường dẫn vào đây.." name="mess_chat" id="mess_chat">
                    </div>
                    <div class="form-group">
                        <label for="mess_manager">Link chat với khách hàng:</label>
                        <input required class="form-control" type="text" value="{{ $info->mess_manager }}" placeholder="Copy đường dẫn vào đây.." name="mess_manager" id="mess_manager">
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
