
@extends('layouts.master')
@section('title')
    Tạo slide
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
                <h6 class="m-0 font-weight-bold text-primary">Tạo slide</h6>
            </div>
            <div class="card-body">
                @if (!empty($success))
                    <h3>Thêm slide thành công.</h3>
                    <a href="{{ route('list-slide') }}">Danh sách slide</a>
                @else
                <form action="{{ route('post-CreateSlide') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="picture">Ảnh slide</label>
                                <input type="text" placeholder="Tên role">
                            </div>
                        </div>
                        <div class="d-flex justify-content-end p-4">
                            <button class="btn btn-primary col-2"  type="submit">Thêm mới</button>

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
