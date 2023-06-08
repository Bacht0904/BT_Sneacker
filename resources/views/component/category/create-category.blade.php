@extends('layouts.master')
@section('title')
    Tạo danh mục
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
                <h6 class="m-0 font-weight-bold text-primary">Tạo danh mục</h6>
            </div>
            <div class="card-body">
                @if (!empty($success))
                    <h3>Thêm danh mục thành công.</h3>
                    <a href="{{ route('list-category') }}">Danh mục</a>
                @else
                <form action="{{ route('post-CreateCategory') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="icon_category">Icon</label>
                                <input required type="file" accept="image/*" name="icon_category" id="icon_category" placeholder="Icon" value="{{ old('icon_category') }}" >

                            </div>
                            <div class="form-group col-md-4">
                                <label for="category_name">Tên danh mục</label>
                                <input required type="text" class="form-control" name="category_name" id="category_name" placeholder="Tên danh mục" value="{{ old('category_name') }}" >

                            </div>
                        </div>


                    <div class="d-flex justify-content-end p-4">
                        <button class="btn btn-primary col-2"  type="submit">Thêm danh mục</button>

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
