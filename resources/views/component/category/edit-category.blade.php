@extends('layouts.master')
@section('title')
    Sửa danh mục
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
                <h6 class="m-0 font-weight-bold text-primary">Sửa danh mục</h6>
            </div>
            <div class="card-body">
                @if (!empty($success))
                    <h3>Cập nhật thành công.</h3>
                    <a href="{{ route('list-category') }}">Danh mục</a>
                @else
                <form action="{{ route('post-EditCategory',$category->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if ($errors->any())
                    @endif
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="icon_category">Icon</label><br>
                                <img width="50" src="{{ asset('assets/img/categories') }}/{{ $category->icon }}" alt="">
                                <button class="btn btn-info" type="button"><label class="m-0" for="icon_category">Đổi</label></button>
                                <input style="display:none;" type="file" accept="image/*" name="icon_category" id="icon_category" value="" >

                                @error('icon_category')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="category_name">Tên danh mục</label>
                                <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Tên danh mục" value="{{ $category->category_name }}" >

                                @error('category_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="status">Trạng thái</label>
                                <select name="status" class="form-control">
                                    @if ($category->status == 0)
                                    <option value="1">Đang hoạt động</option>
                                    <option value="0" selected>Ngưng hoạt động</option>
                                    @else
                                    <option value="1" selected>Đang hoạt động</option>
                                    <option value="0">Ngưng hoạt động</option>
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
