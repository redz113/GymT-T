@extends('layouts.backend.master')
@section('title', 'Quản lý gói tập')
@section('style')

<style>
    .star-style {
        background-repeat: no-repeat;
        width: 115%;
        height: 100%;
        margin-left: -7px;
    }

    .rating {
        position: absolute;
        top: -1px;
        left: 0;
    }

    .fa-star {
        margin: 5px;
        width: 20px;
        height: 10px;
    }

    .star-vote {
        width: 100px;
        height: 20px;
        position: relative;
        margin-right: 10px;
        margin-left: 10px;
    }

    .single_capt_left {
        font-size: 20px;
    }

    .alert {
        padding: 20px;
        color: white;
    }

    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .closebtn:hover {
        color: black;
    }
</style>

@endsection
@section('content')

<div>
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Quản lý gói tập
                    <span class="d-block text-muted pt-2 font-size-sm">Danh sách</span>
                </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Button-->
                <a href="{{route('admin.package.create')}}" class="btn btn-primary font-weight-bolder">
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
                    </span>Thêm mới gói tập</a>
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
                                <div class="col-md-6 my-2 my-md-0">
                                    <select name="subject_id" class="form-control select2 is-invalid" id="kt_select2_1_validate">
                                        <option selected disabled>Chọn môn tập</option>
                                        @php
                                        $subjects = \App\Models\Subject::all();
                                        @endphp
                                        @foreach ($subjects as $item)
                                        <option value="{{$item->id}}" @if(request('subject_id', -1)==$item->id) selected @endif>{{$item->subject_name}} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 my-2 my-md-0">
                                    <div class="d-flex align-items-center">
                                        <select class="form-control" name="status">
                                            <option selected disabled>Chọn trạng thái</option>
                                            <option value="0" @if(request('status', -1)==0) selected @endif>Khóa</option>
                                            <option value="1" @if(request('status', -1)==1) selected @endif>Hoạt động</option>
                                        </select>
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
            <!--end::Search Form-->
        </div>
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Tên gói tập</th>
                        <th>Tên môn tập</th>
                        <th>Ảnh đại diện</th>
                        <th>Giá niêm yiết</th>
                        <th>Giá khuyến mãi</th>
                        <th>Kiểu gói tập</th>
                        @if($cate_package == 2)
                        <th>Tổng số buổi tập có PT</th>
                        <th>Số buổi tập có PT / tuần</th>
                        @endif
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @if($packages != null)
                    @foreach($packages as $key=>$item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->package_name}}<div class="star-vote">
                                <div class="star-style rating" style="background-image: url({{asset('images/5star1.png')}}); width:{{(starPackage($item->id)/5*100)*1.16}}%"></div>
                                <div class="star-style star_background" style="background-image: url({{asset('images/5star2.png')}});"></div>
                            </div></td>
                        <td>{{$item->subject->subject_name}}</td>
                        <td>
                            <img width="100px" height="100px" src="{{asset($item->avatar)}}" alt="">
                        </td>
                        <td>{{number_format($item->price,0,'.','.')}}</td>
                        <td>{{number_format($item->into_price,0,'.','.')}}</td>
                        <td>
                            {{typePackage()[$item->type_package]}}
                        </td>
                        @if($cate_package == 2)
                        <td>{{$item->total_session_pt}}</td>
                        <td>{{$item->week_session_pt}}</td>
                        @endif
                        <td><span class="label label-inline {{$item->status == 1 ? 'label-light-primary': 'label-light-danger'}} font-weight-bold">{{ (config('status_package.'.$item->status) )}}</span>
                        </td>
                        <td>
                            <a title="Xem chi tiết" href="{{route('admin.package.edit', $item->id)}}"><i class="flaticon-eye text-info"></i></a>
                            <a title="Thay đổi trạng thái" class="btn-confirm" data-title="Bạn có chắc chắn muốn thay đổi trạng thái ?" data-url="{{route('admin.package.change_status', $item->id)}}" style="margin-left: 12px; cursor: pointer"><i class="flaticon-warning text-warning"></i></a>

                            <a title="Đánh giá" href="{{route('admin.package.evaluate', $item->id)}}" style="margin-left: 12px"><span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Flag.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path d="M3.5,3 L5,3 L5,19.5 C5,20.3284271 4.32842712,21 3.5,21 L3.5,21 C2.67157288,21 2,20.3284271 2,19.5 L2,4.5 C2,3.67157288 2.67157288,3 3.5,3 Z" fill="#000000" />
                                            <path d="M6.99987583,2.99995344 L19.754647,2.99999303 C20.3069317,2.99999474 20.7546456,3.44771138 20.7546439,3.99999613 C20.7546431,4.24703684 20.6631995,4.48533385 20.497938,4.66895776 L17.5,8 L20.4979317,11.3310353 C20.8673908,11.7415453 20.8341123,12.3738351 20.4236023,12.7432941 C20.2399776,12.9085564 20.0016794,13 19.7546376,13 L6.99987583,13 L6.99987583,2.99995344 Z" fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg><!--end::Svg Icon--></span></a>

                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            <div>
                {{$packages->appends(request()->input())->links()}}
            </div>
            <!--end: Datatable-->
            @if(count($packages) <= 0) <div class="card-body">
                <div class="mb-7">
                    <div class="row align-items-center">
                        <h2 style="color: #999999; text-align: center">Không tìm thấy bản ghi</h2>
                    </div>
                </div>
        </div>
        @endif
    </div>
</div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('.select2').select2()
    });
</script>
@endsection