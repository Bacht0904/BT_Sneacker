@extends('layouts.master')
@section('title')
    Thêm sản phẩm mới
@endsection
@section('head')
    @parent
    <style>
        .sizes{
            display:flex;
        }
        .btn-color{
            float: right;
            right: 2%;
            width: 200px;
            margin-bottom:20px;
        }
        /* .card-body{
            padding-bottom: 110px !important;
        } */
        select{
            border: none;
        }
    </style>
@endsection

@section('content')
<div class="row">

    <div class="col-lg">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <a href="{{ route('products') }}">Danh sách</a>
                <h6 class="m-0 font-weight-bold text-primary">Thêm sản phẩm mới</h6>
            </div>
            <div class="card-body">
                @if (!empty($success))
                    <h3>Thêm sản phẩm thành công.</h3>
                    <div class="row">
                        <a href="{{ route('get-AddProduct') }}">Tiếp tục</a>
                        <a href="{{ route('products') }}">Danh sách sản phẩm</a>
                    </div>
                @else
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{route('post-AddProduct')}}" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="product_code">Mã sản phẩm</label>
                            <input type="text" class="form-control" required = "Mã sản phẩm không được để trống" name="product_code" id="product_code" value="{{ $productCode }}" placeholder="Mã sản phẩm" readonly >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="product_name">Tên sản phẩm</label>
                            <input type="text" class="form-control" required = "Tên sản phẩm không được để trống" name="product_name" id="product_name" placeholder="Tên sản phẩm" value="{{ old('product_name') }}" >
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label for="price">Giá bán</label>
                            <input type="text" class="form-control" id="price" required = "Giá bán không được để trống" min="0" name="price" placeholder="Giá bán" value="{{ old('price') }}">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="brand">Thương hiệu</label>
                            <select name="brand" id="brand" class="form-control" required = "Thương hiệu không được để trống">
                                <option value="">-- Chọn thương hiệu --</option>
                                @foreach ($brand as $item)
                                    @if ($item->status ==1)
                                        <option value="{{ $item->id }}">{{ $item->brand_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="product_type">Loại sản phẩm</label>
                            <select name="product_type" id="product_type" class="form-control" required = "Loại sản phẩm không được để trống">
                                <option value="">-- Loại sản phẩm --</option>
                                @foreach ($product_type as $item)
                                    <option value="{{ $item->id }}">{{ $item->product_type_name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-2 pt-2">
                            <label for="images" class="mt-4 btn btn-primary">Chọn hình ảnh</label>
                            <input type="file" id="images" accept="image/*" multiple required name="images[]" style="display:none">
                        </div>
                    </div>


                    <div class="form-row pl-4">
                        <div class="form-group col-md-3">
                            <div class="d-flex preview">
                            </div>
                        </div>
                    </div>
                    <div class="row ml-1">
                        <button onclick="add_append();" type="button"  class="btn btn-info btn-color"><i class="fa-solid fa-circle-plus mr-2"></i>Thêm màu</button>
                    </div>
                    <div class="row">
                        <div class="add_color_and_size" >
                            <div class="form-group form-inline ml-md-4 img-color">
                                <label for="color"> Tên màu :</label>
                                <input type="text" name="color_id[]" placeholder="" value="-1" class="form-control col-md-3 mx-sm-3" hidden>
                                <input type="text" id="color" name="color_name[]" placeholder="Tên màu" class="form-control col-md-3 mx-sm-3">
                                <input type="file" accept="image/*" required="" name="image_colors[]" id='img' onchange="imgaa(this);">
                                <button type="button" class="btn-xoa btn btn-outline-danger" onclick="deleteRow(this);"><i class="fa-solid fa-minus"></i></button>
                                <div class="form-group ml-3" hidden>
                                    <label for="status">Trạng thái </label> &ensp;
                                    <select name="color_status[]" class="form-control">
                                        <option value="0" >Ngưng hoạt động</option>
                                        <option value="1" selected>Đang hoạt động</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-2 ml-2">
                        <input type="button"  class="btn btn-secondary" id="num-size" value="Size số"/>
                        <input type="button"  class="btn btn-secondary ml-2" id="text-size" value="Size chữ"/>
                    </div>
                    <div class="row ml-1">
                        <button id="btn-add-text" onclick="add_size_text();" type="button"  class="btn btn-info btn-color"><i class="fa-solid fa-circle-plus mr-2"></i>Thêm size chữ</button>
                        <button id="btn-add-num" onclick="add_size_num();" type="button"  class="btn btn-info btn-color"><i class="fa-solid fa-circle-plus mr-2"></i>Thêm size số</button>
                    </div>
                    <div class="add_size"></div>
                    <div class="form-group m-4">
                        <label for="editor">Nội dung</label>
                        <textarea class="editor" name="description" class="form-control ckeditor" value="{{ old('description') }}">
                        </textarea>
                    </div>
                    <div class="d-flex justify-content-end p-4">
                        <button class="btn btn-primary col-2"  type="submit">Thêm sản phẩm</button>
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
<script src="{{ asset('assets/js/add-and-remove-list.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">



   function chooseImage(fileInput){
       if(fileInput.files && fileInput.files[0]){
           var reader = new FileReader();
           reader.onload = function (e){
               $('#image').attr('src',e.target.result);
           }
           reader.readAsDataURL(fileInput.files[0]);
       }
   }


    const ipnFileElement = document.querySelector('#images')
    const resultElement = document.querySelector('.preview')
    const validImageTypes = ['image/gif', 'image/jpeg', 'image/png']

    ipnFileElement.addEventListener('change', function(e) {
        const files = e.target.files
        const file = files[0]
        const fileType = file['type']

        if (!validImageTypes.includes(fileType)) {
            resultElement.insertAdjacentHTML(
            'beforeend',
            '<span class="preview-img">Chọn ảnh đi :3</span>'
            )
            return
        }
        document.querySelectorAll(".preview img").forEach(img => img.remove());
        for (let index = 0; index < files.length; index++) {
            const fileReader = new FileReader()
            fileReader.readAsDataURL(files[index])

            fileReader.onload = function() {
                const url = fileReader.result
                resultElement.insertAdjacentHTML(
                'beforeend',
                `<img class="mr-2" height="150" width="200" src="${url}" alt="${file.name}">`
                )
            }
        }
    })

    function imgaa(btn) {
        console.log(btn);
        var row = img.parentNode.parentNode;
        row = '<button onclick="remove_product(this);" type="button"  class="btn btn-danger"><i class="fa-solid fa-minus"></i>aaa</button>';
        document.getElementById("dataTableSlide").append(row);

        var row = img.parentNode;
        const ipnFileElement = row.fileInput('#img');
        const resultElement = document.querySelector('.img-color')
        const validImageTypes = ['image/gif', 'image/jpeg', 'image/png']

        ipnFileElement.addEventListener('change', function(e) {
            const files = e.target.files
            const file = files[0]
            const fileType = file['type']

            if (!validImageTypes.includes(fileType)) {
                row.insertAdjacentHTML(
                'beforeend',
                '<span class="">Chọn ảnh đi :3</span>'
                )
                return
            }
            // document.querySelectorAll(".img-color img").forEach(img => img.remove());

            for (let index = 0; index < files.length; index++) {
                const fileReader = new FileReader()
                fileReader.readAsDataURL(files[index])

                fileReader.onload = function() {
                    const url = fileReader.result
                    row.insertAdjacentHTML(
                    'beforeend',
                    `<img class="mr-2" height="50" width="50" src="${url}" alt="${file.name}">`
                    )
                }
            }
        })
        row.remove(row);
    }
</script>
@parent
@endsection
