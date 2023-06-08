@extends('layouts.master')
@section('title')
    Danh sách thương hiệu
@endsection
@section('head')
    @parent
    {{-- <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> --}}
@endsection
@section('content')
    @if (session('msg'))
    <div class="alert alert-success">
        {{ session('msg') }}
    </div>
    @endif
    <h1 class="h3 mb-2 text-gray-800">Danh sách thương hiệu</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Danh sách thương hiệu</h6>
                            <a href="{{ route('get-CreateBrand') }}" rel="noopener noreferrer" style="float:right">Thêm mới</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên thương hiệu</th>
                                            <th>Tên công ty</th>
                                            <th>Số tài khoản</th>
                                            <th>Tên ngân hàng</th>
                                            <th>Tên tài khoản thẻ</th>
                                            <th>Số điện thoại</th>
                                            <th>Email</th>
                                            <th>Trạng thái</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($brand))
                                        @foreach ($brand as $key=>$item)

                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $item->brand_name }}</td>
                                                <td>{{ $item->company }}</td>
                                                <td>{{ $item->bank_num }}</td>
                                                <td>{{ $item->bank_name }}</td>
                                                <td>{{ $item->bank_account_name }}</td>
                                                <td>{{ $item->phone_number }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>@if ($item->status==0)
                                                    <span class="text-danger">Ngưng hoạt động</span>
                                                @else
                                                    <span class="text-success">Hoạt động</span>
                                                @endif</td>
                                                <td>
                                                    <div class="d-flex justify-content-xl-between">
                                                        <a href="{{ route('detail-brand',$item->id) }}" class="btn btn-sm btn-outline-primary" title="Chi tiết"><i class="fa-solid fa-file-lines"></i></a>
                                                        <a href="{{ route('get-EditBrand',$item->id) }}"title="Chỉnh sửa" class="btn btn-sm btn-outline-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                                        <a href="#removeModal{{ $item->id }}" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#removeModal{{ $item->id }}" title="Xóa"><i class="fa-solid fa-minus"></i></a>

                                                    </div>
                                                    {{-- Modal --}}
                                                    <div class="modal fade" id="removeModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Ngưng hoạt động thương hiệu sản phẩm</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <span>Bạn có chắc muốn ngưng hoạt động {{ $item->brand_name }}?</span>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('cancel-brand',$item->id) }}" method="post">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-primary">OK</button>
                                                                    </form>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="10">Không có thương hiệu nào</td>
                                        </tr>
                                        @endif
                                        <!-- Modal content -->


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

@endsection
@section('script')
    @parent
    <script>

    </script>

@endsection
{{-- <div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Thông báo</h3>
        <p>Bạn có chắc xóa không?</p>
        <div class="d-flex justify-content-sm-around">
          <a href="{{ route('delete-brand',$brand->id) }}" class="btn btn-primary" id="btn-ok">OK</a>
          <a id="btn-cancel" class="btn btn-outline-primary">Cancle</a>
        </div>
    </div>
</div> --}}
