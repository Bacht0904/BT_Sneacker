@extends('layouts.master')
@section('title')
    Tạo voucher
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
                <a href="{{ route('list-voucher') }}">Trở lại</a>
                <h6 class="m-0 font-weight-bold text-primary">Tạo voucher</h6>
            </div>
            <div class="card-body">
                @if (!empty($success))
                    <h3>Thêm voucher thành công.</h3>
                    <a href="{{ route('list-voucher') }}">Danh sách voucher</a>
                @else
                <form action="{{ route('post-CreateVoucher') }}" method="post" autocomplete="off">
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="voucher_code">Code</label>
                                <input type="text" class="form-control text-uppercase" readonly name="voucher_code" id="voucher_code" value="{{ Str::random(13) }}" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="min_total_price">Giá yêu cầu</label>
                                <input type="number" class="form-control" required name="min_total_price" id="min_total_price" placeholder="Giá yêu cầu" value="{{ old('min_total_price') }}" >
                            </div>
                            <div class="form-group col-md-4">
                                <label for="discount_price">Giá giảm</label>
                                <input type="number" class="form-control" required name="discount_price" id="discount_price" placeholder="Giá giảm" value="{{ old('discount_price') }}" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="start_date">Ngày bắt đầu</label>
                                <input type="text" class="form-control" required name="start_date" id="start_date" placeholder="Ngày bắt đầu" value="{{ old('start_date') }}" >
                            </div>
                            <div class="form-group col-md-6">
                                <label for="end_date">Ngày kết thúc</label>
                                <input type="text" class="form-control" required name="end_date" id="end_date" placeholder="Ngày kết thúc" value="{{ old('end_date') }}" >
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="description">Mô tả</label>
                                    <input type="text" class="form-control" required name="description" id="description" placeholder="Mô tả" value="{{ old('description') }}" >
                                </div>
                            </div>

                        </div>
                    <div class="d-flex justify-content-end p-4">
                        <button class="btn btn-primary col-2"  type="submit">Thêm Voucher</button>

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

{{-- datepicker --}}

<script type="text/javascript">
    $( function() {
        $( "#start_date" ).datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "yy-mm-dd",
            dayNamesMin: ["T2","T3","T4","T5","T6","T7","CN"],
            monthNames: [ "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5","Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12" ],
            duration:"slow",
            minDate: new Date(),
        });
        $( "#end_date" ).datepicker({
            prevText: "Tháng trước",
            nextText: "Tháng sau",
            dateFormat: "yy-mm-dd",
            dayNamesMin: ["T2","T3","T4","T5","T6","T7","CN"],
            monthNames: [ "Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5","Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12" ],
            duration:"slow",
            minDate: new Date()
        });
    } );
</script>
@endsection
