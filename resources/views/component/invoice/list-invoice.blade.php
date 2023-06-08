{{-- {{ dd($invoice_status) }} --}}

@extends('layouts.master')
@section('title')
    {{ $title }}
@endsection
@section('head')
    @parent

@endsection
@section('content')
    @if (session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif
    <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
            <div class="float-right col-4 mt-md-3 ">
                <form action="{{route('list-invoice')}}" method="post">
                    @csrf
                    <div class="d-flex align-items-center">
                        <span for="status_search" style="width:200px">Lọc trạng thái:</span>
                        <select name="status_search" id="status_search" class=" form-control">
                            <option value="-1"@if ($status_search == -1) selected @endif>Tất cả</option>
                            <option value="1" @if ($status_search == 1) selected @endif>Chờ xác nhận</option>
                            <option value="2" @if ($status_search == 2) selected @endif>Đã xác nhận</option>
                            <option value="3" @if ($status_search == 3) selected @endif>Đang vận chuyển</option>
                            <option value="4" @if ($status_search == 4) selected @endif>Đã giao</option>
                            <option value="0" @if ($status_search == 0) selected @endif>Đã hủy</option>
                        </select>
                        <button type = "submit"  class="ml-2 btn btn-sm btn-primary">Lọc</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%">STT</th>
                            <th>Tên KH</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Mã Voucher</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Loại thanh toán</th>
                            <th width="10%">Trạng thái</th>
                            <th>Thao tác</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($invoices))
                        @foreach ($invoices as $key=>$item)

                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->address }}</td>
                            <td>
                                @if (empty($item->voucher_id))
                                    <span>Không áp dụng</span>
                                @else
                                    {{ $item->voucher_code }}
                                @endif
                            </td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format( $item->until_price, 0, '', '.') }}</td>
                            <td>{{ $item->type_pay }}</td>
                            <td>@if ($item->status==0)
                                <span class="text-danger">Đã hủy </span>
                            @elseif($item->status==1)
                                <span class="text-warning">Chờ xác nhận</span>
                            @elseif($item->status==2)
                                <span class="text-success">Đã xác nhận</span>
                            @elseif($item->status==3)
                                <span class="text-warning">Đang vận chuyển</span>
                            @else
                                <span class="text-primary">Đã giao</span>
                            @endif</td>
                            <td>
                                @if($item->status == 1)
                                    <form action="{{ route('update-invoiceStatus',$item->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary">Xác nhận</button>
                                    </form>
                                @elseif ($item->status == 2)
                                    <form action="{{ route('update-invoiceStatus',$item->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary">Đang vận chuyển</button>
                                    </form>
                                @elseif ($item->status == 3)
                                    <form action="{{ route('update-invoiceStatus',$item->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary">Đã giao</button>
                                    </form>
                                @else
                                    <span class="text-success">Hoàn thành</span>
                                @endif
                            </td>
                            <td class="d-flex justify-content-around">
                                <a href="{{ route('detail-invoice',$item->id) }}" class="btn btn-sm btn-outline-primary" title="Chi tiết"><i class="fa-solid fa-file-lines"></i></a>
                                @if ($item->status!=0 && $item->status!=4)
                                {{-- <a href=""title="Chỉnh sửa" class="btn btn-sm btn-outline-warning"><i class="fa-solid fa-pen-to-square"></i></a> --}}
                                <a href="#removeModal{{ $item->id }}" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#removeModal{{ $item->id }}" title="Hủy"><i class="fa-solid fa-minus"></i></a>
                                {{-- Modal --}}
                                <div class="modal fade" id="removeModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hủy đơn hàng</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="modal-body">
                                                <span>Bạn có chắc muốn hủy đơn hàng {{ $item->invoice_code }}?</span>
                                                <form action="{{ route('cancel-invoice',$item->id) }}" method="post">
                                                    @csrf
                                                <input type="text" placeholder="Lý do hủy" name="reason" class="form-control" required>
                                            </div>
                                            <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">OK</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endif

                            </td>
                        </tr>


                        @endforeach
                        @else
                        <tr>
                            <td colspan="7">Không có đơn hàng nào</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection

@section('script')

   @parent


@endsection
