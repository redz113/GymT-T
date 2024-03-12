@extends('layouts.backend.master')
@section('title', 'Quản lý ca tập')
@section('content')
    <div>
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Quản lý ca tập
                        <span class="d-block text-muted pt-2 font-size-sm">Danh sách</span></h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="{{route('admin.time.create')}}" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                         height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle fill="#000000" cx="9" cy="15" r="6"/>
                            <path
                                d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                fill="#000000" opacity="0.3"/>
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>Thêm mới ca tập</a>
                    <!--end::Button-->
                </div>
            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                    <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Tên ca tập</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    @if($times != null)
                        @foreach($times as $key=>$item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->time_name}}</td>
                                <td>{{$item->start_time}}</td>
                                <td>{{$item->end_time}}</td>
                                <td>
                                <a title="{{ ('View') }}"
                                       href="{{route('admin.time.edit', $item->id)}}"><i
                                            class="flaticon-eye text-info"></i></a>
                                    {{-- <a title="Xóa" class="btn-confirm" data-title="Bạn có chắc chắn muốn xóa không ?" data-url="{{route('admin.time.delete', $item->id)}}"
                                       style="margin-left: 12px; cursor: pointer"><i class="flaticon2-trash text-danger"></i></a> --}}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <!--end: Datatable-->
                <div>
                    {{$times->appends(request()->input())->links()}}
                </div>
                @if(count($times) <= 0)
                    <div class="card-body">
                        <!--begin::Search Form-->
                        <div class="mb-7">
                            <div class="row align-items-center">
                                <h2 style="color: #999999; text-align: center">Không tìm thấy bản ghi</h2>
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
