
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
                        <div class="row">
                            <div class="form-group col-md-9 picture">
                                <label class="" for="">Ảnh slide</label>
                                <label for="picture" class="mt-0 ml-2 btn btn-primary">Chọn hình ảnh</label>
                                <input type="file" accept="image/*" name="picture" id="picture" placeholder="Icon" required value="{{ old('picture') }}" style="display:none">
                            </div>

                            <div class="form-group col-md-2">
                                <button class="btn btn-primary float-right"  type="submit">Thêm mới</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="preview"></div>

                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Mô tả slide</label>
                                    <textarea required name="description" id="description" class=" form-control editor" >

                                    </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-start py-4 pr-4">
                            <a href="#removeModal" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#removeModal" title="Chọn sản phẩm">Chọn sản phẩm</i></a>
                        </div>
                        <div class="table">
                            <table class="table table-bordered" id="dataTableSlide" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Tên sản phẩm</th>
                                        <th>Loại sản phẩm</th>
                                        <th>Giá bán</th>
                                        <th></th>
                                        <th hidden></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                </form>

                @endif
            </div>
        </div>
        {{-- Modal --}}
        <div class="modal fade" id="removeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document" style="min-width: 75%!important;">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Chọn sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>

                    <div class="modal-body">
                        <div class="card-body col-12">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tên sản phẩm</th>
                                            <th>Loại sản phẩm</th>
                                            <th>Giá bán</th>
                                            <th></th>
                                            <th hidden></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($products))

                                        @foreach ($products as $key=>$item)
                                        <tr>
                                            <td>{{ $item->product_name}}</td>
                                            <td>{{ $item->product_type_name}}</td>
                                            <td>{{ number_format( $item->price, 0, '', '.') }}</td>
                                            <td>
                                                <button onclick="add_product(this);" type="button"  class="btn btn-info btn-color"><i class="fa-solid fa-circle-plus"></i></button>
                                            </td>
                                            <td hidden><input type="text" value="{{ $item->id }}" name="product_id[]" hidden></td>
                                        </tr>

                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="8">Không có sản phẩm nào</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('assets/js/add-and-remove-list.js') }}"></script>
<script>
    const ipnFileElement = document.querySelector('#picture')
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
                `<img class="mrl-3" height="200" src="${url}" alt="${file.name}">`
                )
            }
        }
    })
</script>
    @parent
@endsection
