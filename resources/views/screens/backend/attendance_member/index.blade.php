@extends('layouts.backend.master')
@section('title', 'Quản lý lịch trình')
@section('content')
    <div>
        <div class="card card-custom">
            {{-- <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Quản lý lịch trình
                        <span class="d-block text-muted pt-2 font-size-sm"></span></h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="#" class="btn btn-primary font-weight-bolder">
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
                </span>Thêm mới lịch trình</a>
                    <!--end::Button-->
                </div>
            </div> --}}

            <div class="card-body">
                <!--begin::Search Form-->
                <form action="">
                    <div class="mb-7">
                        <div class="row align-items-center">
                            <div class="col-lg-9 col-xl-8">
                                <div class="row align-items-center">
                                    <div class="col-md-4 my-2 my-md-0">
                                        <div class="d-flex align-items-center">
                                            
                                            <select class="form-control" name="status">
                                                <option selected disabled>Chọn trạng thái</option>
                                                <option value="0"
                                                        @if(request('status', -1) == 0) selected @endif>Sắp tới</option>
                                                <option value="1"
                                                        @if(request('status', -1) == 1) selected @endif>Vắng mặt</option>
                                                <option value="2"
                                                        @if(request('status', -1) == 2) selected @endif>Có mặt</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 my-2 my-md-0">
                                        <div class="d-flex align-items-center">
                                            <label class="mr-3 mb-0 d-none d-md-block">Từ</label>
                                            <input name="start_date" @if(request('start_date')) value="{{ request('start_date') }}" @endif type="date"
                                                   class="form-control"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4 my-2 my-md-0">
                                        <div class="d-flex align-items-center">
                                            <label class="mr-3 mb-0 d-none d-md-block">Đến</label>
                                            <input name="end_date" @if(request('end_date')) value="{{ request('end_date') }}" @endif type="date" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                                <button
                                    class="btn btn-light-primary px-6 font-weight-bold">Tìm kiếm</button>
                            </div>
                        </div>
                    </div>
                    <!--end::Search Form-->
                </form>
            </div>
            <form action="" method="POST" class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                    <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Tên hội viên</th>
                        <th>Ngày tập</th>
                        <th>Kiểu gói tập</th>
                        <th>Ca tập</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                        <th>Trạng thái</th>
                        <th>Điểm danh</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    @if(count($attendances) > 0)
                        @foreach($attendances as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->user->name}}</td>
                                <td>{{ getdate(strtotime($item->date))['weekday'] }}<br>
                                    <span style="color: #999999">{{ date('d-m-Y', strtotime($item->date)) }}</span>
                                </td>
                                <td>{{$item->time->time_name}}</td>
                                <td>{{$item->time->start_time}}</td>
                                <td>{{$item->time->end_time}}</td>
                                <td class="view_status">
                                        <span class="label label-inline {{$item->status == 1 ? 'label-light-success': 'label-light-danger'}} font-weight-bold">{{config('status_schedule.'.$item->status)}}</span>

                                </td>
                                <td align="center">
                                    {{-- <div class="update_attendance" data-url="{{'admin.attendance.editStatus'}}" data-id="{{$item->id}}" style="cursor: pointer;">
                                        <i style="font-size: 20px; " class="ki ki-reload text-warning"></i>
                                    </div> --}}
                                    <div class="form-check form-switch">
                                        <input style="font-size: 23px" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    </div>
                                    
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <!--end: Datatable-->
                <div>
                    {{$attendances->appends(request()->input())->links()}}
                </div>
                @if(count($attendances) <= 0)
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
                <div align="center">
                    <button type="button" class="btn btn-primary">Primary</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(".update_attendance").click(function(){
    console.log("quân");
      var id = $(this).data("id");
      var link = $(this).data("url");
        $.ajax(
        {
            url: link,
            type: 'GET',
            dataType: "JSON",
            data: {
                "id": id,
            },
            success: function ()
            {
                $('.view_status').html(` <span class="label label-inline {{$item->status == 1 ? 'label-light-success': 'label-light-danger'}} font-weight-bold">{{config('status_schedule.'.$item->status)}}</span>`);
            }
        });

        console.log("It failed");
    });


    //     $('.update_attendance').on('click', function() {
    //     $id = $(this).data("id");
    //     console.log($id);
    //     $.ajax({
    //         type: 'GET',
    //         url: "{{route('admin.attendance.editStatus')}}",
    //         data: {
    //             'id': $id,
    //         },
    //         success: function(data) {
    //             console.log($data);
    //             $('.view_status').html(` <span class="label label-inline {{$item->status == 1 ? 'label-light-success': 'label-light-danger'}} font-weight-bold">{{config('status_schedule.'.$item->status)}}</span>`);
    //             if (data == '') {
    //                 window.location.reload()
    //             }
    //         }
    //     });
    // })
    </script>
@endsection
