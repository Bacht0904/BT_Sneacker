@extends('layouts.master')
@section('title')
    Sửa loại sản phẩm
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
                <a href="{{ route('list-productType') }}">Trở lại</a>
                <h6 class="m-0 font-weight-bold text-primary">Sửa loại sản phẩm</h6>
            </div>
            <div class="card-body">
                @if (!empty($success))
                    <h3>Cập nhật thành công.</h3>
                    <a href="{{ route('list-productType') }}">Danh sách loại sản phẩm</a>
                @else
                <form action="{{ route('post-EditProductType',$product_type->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="categorie_id">Danh mục</label>
                                <select name="categorie_id" id="categorie_id" class="form-control">
                                    <option value="">-- Chọn danh mục --</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" @if ($product_type->categorie_id == $item->id) selected @endif>{{ $item->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="product_type_name">Tên loại</label>
                                <input type="text" name="product_type_name" id="product_type_name" placeholder="Tên loại" class="form-control" value="{{ $product_type->product_type_name }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="status">Trạng thái</label>
                                <select name="status" class="form-control">
                                    @if ($product_type->status == 0)
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
