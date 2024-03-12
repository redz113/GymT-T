@extends('layouts.backend.master')
@section('title', 'Quản lý lịch trình')
@section('content')
    <div>
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Quản lý lịch trình
                        <span class="d-block text-muted pt-2 font-size-sm">{{ $user->name }}</span></h3>
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
            </div>

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
                                                        @if(request('status', -1) == 0) selected @endif>Chuẩn bị</option>
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
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                    <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Ngày</th>
                        <th>Ca tập</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    @if(count($schedules) >0)
                        @foreach($schedules as $item)
                            @php
                            $shift = \App\Models\Time::where('id', $item->time_id)->first();
                            @endphp
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ (getdate(strtotime($item->date))['weekday']) }}<br>
                                    <span style="color: #999999">{{ date('d-m-Y', strtotime($item->date)) }}</span>
                                </td>
                                <td>
                                    {{--  --}}
                                    {{$item->time->id}}
                                </td>
                                <td></td>
                                <td>
                                @if($item->status == 0)
                                    <span
                                        class="label label-inline label-light-primary font-weight-bold"> {{ (config('status_schedule.'.$item->status)) }}</span>

                                @else
                                        <span
                                            class="label label-inline {{$item->status == 1 ? 'label-light-danger': 'label-light-success'}} font-weight-bold">{{(config('status_schedule.'.$item->status))}}</span>
                                @endif
                                </td>
                                <td>
                                    <span title="{{ $item->status == 2 ? 'Vắng mặt : 'Có mặt' }}" style="cursor: pointer">
                                        <i class="fas fa-spinner"></i>
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                <!--end: Datatable-->
                <div>
                    {{$schedules->appends(request()->input())->links()}}
                </div>
                @if(count($schedules) <= 0)
                    <div class="card-body">
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
