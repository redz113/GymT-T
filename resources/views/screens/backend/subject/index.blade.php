@extends('layouts.backend.master')
@section('title', 'Quản lý môn tập')
@section('content')
<div>
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Quản lý môn tập
                    <span class="d-block text-muted pt-2 font-size-sm">Danh sách</span>
                </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="{{route('admin.subject.create')}}" class="btn btn-primary font-weight-bolder">
                    <span class="svg-icon svg-icon-md">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <circle fill="#000000" cx="9" cy="15" r="6" />
                                <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>Thêm mới môn tập</a>
                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin::Search Form-->
            <form action="">
                <div class="mb-7">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-xl-8">
                            <div class="row align-items-center">
                                <div class="col-md-12 my-2 my-md-0">
                                    <div class="input-icon">
                                        <input name="keyword" type="text" class="form-control" @if(request('keyword')) value="{{ request('keyword') }}" @endif placeholder="Nhập tên môn học tìm kiếm" />
                                        <span>
                                            <i class="flaticon2-search-1 text-muted"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                            <button class="btn btn-light-primary px-6 font-weight-bold">Tìm kiếm</button>
                        </div>
                    </div>
                </div>
                <!--end::Search Form-->
            </form>
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Tên môn tập</th>
                        <th>Ảnh đại diện</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @if($subjects != null)
                    @foreach($subjects as $key=>$item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->subject_name}}</td>
                        <td>
                            <img width="100px" height="100px" src="{{asset($item->image)}}" alt="">
                        </td>
                        <td>
                            <a title="{{ ('View') }}" href="{{route('admin.subject.edit', $item->id)}}"><i class="flaticon-eye text-info"></i></a>
                            <a title="Xóa" class="btn-confirm" data-title="Bạn có chắc chắn muốn xóa không ?" data-url="{{route('admin.subject.delete', $item->id)}}" style="margin-left: 12px; cursor: pointer"><i class="flaticon2-trash text-danger"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            <!--end: Datatable-->
            <div>
                {{$subjects->appends(request()->input())->links()}}
            </div>
            @if(count($subjects) <= 0) <div class="card-body">
                <!--begin::Search Form-->
                <div class="mb-7">
                    <div class="row align-items-center">
                        <h2 style="color: #999999; text-align: center">{{ ('No records found') }}</h2>
                    </div>
                </div>
                <!--end::Search Form-->
        </div>
        @endif
    </div>
</div>
</div>
@endsection
@section('script')
@endsection