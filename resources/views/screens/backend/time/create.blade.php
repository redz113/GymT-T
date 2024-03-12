@extends('layouts.backend.master')
@section('title', 'Quản lý ca tập')
@section('content')

    <div>
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Quản lý ca tập
                        <span class="d-block text-muted pt-2 font-size-sm">Thêm mới</span></h3>
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="{{route('admin.time.list')}}" class="btn btn-primary font-weight-bolder">
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
                </span>Danh sách ca tập</a>
                    <!--end::Button-->
                </div>
            </div>
            <form action="{{route('admin.time.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Tên ca tập <span class="text-danger">*</span></label>
                        <div class="col-10">
                            <input class="form-control" name="time_name" type="text"
                                   value="{{old('time_name')}}"/>
                            @error('time_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-password-input" class="col-2 col-form-label">Thời gian bắt đầu <span
                                class="text-danger">*</span></label>
                        <div class="col-10">
                            <input type="time" class="form-control" name="start_time" value="{{old('start_time')}}"/>
                            @error('start_time')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-password-input" class="col-2 col-form-label">Thời gian kết thúc <span
                                class="text-danger">*</span></label>
                        <div class="col-10">
                            <input type="time" class="form-control" name="end_time" value="{{old('end_time')}}"/>
                            @error('end_time')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-password-input" class="col-2 col-form-label"></label>
                        <div class="col-10">
                            <button type="submit" class="btn btn-success mr-2">Lưu</button>
                            <button type="reset" class="btn btn-secondary">Đặt lại</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')

@endsection


