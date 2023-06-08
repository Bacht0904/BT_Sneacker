@extends('layouts.master')
@section('title')
    Sửa đơn hàng
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
                <h6 class="m-0 font-weight-bold text-primary">Sửa đơn hàng</h6>
            </div>
            <div class="card-body">
                @if (!empty($success))
                    <h3>Cập nhật thành công.</h3>
                    <a href="{{ route('list-invoice') }}">Danh sách đơn hàng</a>
                @else
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="invoice_id">Mã đơn hàng</label>
                                <input type="text" class="form-control" name="invoice_id" id="invoice_id" readonly value="{{ $invoice->id }}" >
                                </div>
                            <div class="form-group col-md-4">
                            <label for="customer_name">Tên KH</label>
                            <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Tên khách hàng" value="{{ $invoice->user }}" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="status">Trạng thái</label>
                                <select name="status" class="form-control">
                                    @if ($invoice->status == 0)
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
