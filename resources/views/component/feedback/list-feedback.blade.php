@extends('layouts.master')
@section('title')
    Phản hồi từ người dùng
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
    <h1 class="h3 mb-2 text-gray-800">Phản hồi từ người dùng</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Phản hồi từ người dùng</h6>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên người dùng</th>
                            <th>Góp ý</th>
                            <th>Ngày tạo</th>
                            <th>Phản hồi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($feedbacks))

                        @foreach ($feedbacks as $key=>$item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->full_name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                @if ($item->check == 0)
                                    <a href="#removeModal{{ $item->id }}" class="btn btn-outline-primary" data-toggle="modal" data-target="#removeModal{{ $item->id }}" title="Hủy"><i class="fa-solid fa-envelope"></i></a>
                                    {{-- Modal --}}
                                    <div class="modal fade" id="removeModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Gửi phản hồi khách hàng</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('rep-feedback',$item->id) }}" method="post">
                                                        @csrf
                                                    <input type="text" placeholder="Nội dung" name="reason" class="form-control" required>
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
                            <td colspan="5">Không có phản hồi nào</td>
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
