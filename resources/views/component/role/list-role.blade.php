@extends('layouts.master')
@section('title')
    Danh sách Role
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
    <h1 class="h3 mb-2 text-gray-800">Danh sách Role </h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Danh sách Role </h6>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên role</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($roles))

                        @foreach ($roles as $key=>$item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->role_name }}</td>
                            <td>
                                @if($item->status==0)
                                    <span class="text-danger">Không hoạt động</span>
                                @else
                                    <span class="text-success">Hoạt động</span>
                                @endif
                            </td>

                        </tr>

                        @endforeach
                        @else
                        <tr>
                            <td colspan="5">Không có role nào</td>
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
