@extends('layouts.master')
@section('title')
    Tạo loại sản phẩm
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
                <h6 class="m-0 font-weight-bold text-primary">Tạo loại sản phẩm</h6>
            </div>
            <div class="card-body">
                @if (!empty($success))
                    <h3>Thêm loại sản phẩm thành công.</h3>
                    <a href="{{ route('list-productType') }}">Danh sách loại</a>
                @else
                <form action="{{ route('post-CreateProductType') }}" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                            <label for="category_id">Danh mục</label>
                            <select required name="category_id" id="category_id" class="form-control">
                                <option value="">-- Chọn danh mục --</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                @endforeach
                            </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="product_type_name">Tên loại</label>
                                <input required type="text" name="product_type_name" id="product_type_name" placeholder="Tên loại" class="form-control">
                            </div>

                        </div>


                    <div class="d-flex justify-content-end p-4">
                        <button class="btn btn-primary col-2"  type="submit">Thêm loại</button>

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
