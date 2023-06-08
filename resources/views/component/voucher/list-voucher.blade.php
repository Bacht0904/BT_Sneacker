@extends('layouts.master')
@section('title')
    Danh sách voucher
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
    <h1 class="h3 mb-2 text-gray-800">Danh sách voucher</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách voucher</h6>
                <a href="{{ route('get-CreateVoucher') }}" rel="noopener noreferrer" style="float:right">Thêm mới</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Code</th>
                                <th>Giá yêu cầu</th>
                                <th>Giá giảm</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th>Mô tả</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($voucher))
                            @foreach ($voucher as $key=>$item)

                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->voucher_code }}</td>
                                    <td>{{ $item->min_total_price }}</td>
                                    <td>{{ $item->discount_price }}</td>
                                    <td>{{ $item->start_date }}</td>
                                    <td>{{ $item->end_date }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        @if ($item->status==0)
                                            <span class="text-danger">Ngưng hoạt động</span>
                                        @elseif ($item->status == -1)
                                            <span class="text-warning">Chưa hoạt động</span>
                                        @else
                                            <span class="text-success">Hoạt động</span>
                                        @endif
                                    </td>
                                    <td class="d-flex align-items-center">
                                        @if ($item->status != 0)
                                            <a href="{{ route('detail-voucher',$item->id) }}" class="btn btn-outline-primary" title="Chi tiết"><i class="fa-solid fa-file-lines"></i></a>
                                            <a href="{{ route('get-EditVoucher',$item->id) }}"title="Chỉnh sửa" class="btn btn-outline-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="#removeModal{{ $item->id }}" class="btn btn-outline-danger" data-toggle="modal" data-target="#removeModal{{ $item->id }}" title="Xóa"><i class="fa-solid fa-minus"></i></a>

                                        @else
                                        <a href="{{ route('detail-voucher',$item->id) }}" class="btn btn-outline-primary" title="Chi tiết"><i class="fa-solid fa-file-lines"></i></a>
                                        <a href="{{ route('get-EditVoucher',$item->id) }}"title="Chỉnh sửa" class="btn btn-outline-warning"><i class="fa-solid fa-pen-to-square"></i></a>

                                        @endif
                                        {{-- Modal --}}
                                        <div class="modal fade" id="removeModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Ngưng hoạt động voucher</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span>Bạn có chắc muốn ngưng hoạt động voucher {{ $item->voucher_code }}?</span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('cancel-voucher',$item->id) }}" method="post">
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
                                <td colspan="9">Không có voucher nào</td>
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
