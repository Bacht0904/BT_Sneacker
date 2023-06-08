@extends('layouts.master')
@section('title')
    Danh sách Slide
@endsection
@section('head')
    @parent
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    @if (session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif
    <h1 class="h3 mb-2 text-gray-800">Danh sách Slide </h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách Slide </h6>
            <a href="{{ route('get-CreateSlide') }}" rel="noopener noreferrer" style="float:right">Thêm mới</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Hình ảnh</th>
                            <th>Nội dung</th>
                            <th>Ngày tạo</th>
                            <th width="15%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($slides))
                        @foreach ($slides as $key=>$item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td><img width="100" src="{{ asset('assets/img/slideshows') }}/{{ $item->picture }}"></td>
                                <td>{!! Str::limit( $item->description, 150 ) !!}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    
                                    <a href="{{ route('detail-slide',$item->id) }}" class="btn btn-outline-primary" title="Chi tiết"><i class="fa-solid fa-file-lines"></i></a>
                                    <a href="{{ route('get-EditSlide',$item->id) }}"title="Chỉnh sửa" class="btn btn-outline-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="#removeModal{{ $item->id }}" class="btn btn-outline-danger" data-toggle="modal" data-target="#removeModal{{ $item->id }}" title="Xóa"><i class="fa-solid fa-minus"></i></a>
                                    {{-- Modal --}}
                                    <div class="modal fade" id="removeModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Xóa slide</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <span>Bạn có chắc muốn xóa slide này?</span>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('cancel-slide',$item->id) }}" method="post">
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
                            <td colspan="5">Không có slide nào</td>
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
