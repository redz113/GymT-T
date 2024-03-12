@extends('layouts.backend.master')
@section('title', 'Quản lý bảng lương')
@section('content')

<div>
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Quản lý bảng lương
                    <span class="d-block text-muted pt-2 font-size-sm">Bảng lương tháng {{request('year') && request('month') ? request('month').'/'.request('year'):date('m/Y')}}</span>
                </h3>
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
                                    <select name="month" class="form-control select2 is-invalid" id="kt_select2_1_validate">
                                        <option selected disabled>Chọn tháng</option>
                                        @php
                                        $month = [1,2,3,4,5,6,7,8,9,10,11,12];
                                        @endphp
                                        @foreach ($month as $item)
                                        <option value="{{$item}}" @if(request('month', -1)==$item) selected @endif>Tháng {{$item}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 my-2 my-md-0">
                                    <div class="d-flex align-items-center">
                                        <input class="form-control" type="text" placeholder="Nhập năm" value="{{request('year')}}" name="year">
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
                        <th>Họ và tên</th>
                        <th>Lương / ca</th>
                        <th>Số ca đã dạy</th>
                        <th>Lương thực nhận</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    @if($wages != null)

                    @foreach($wages as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->user->name}}</td>
                        <td>{{number_format($item->wage_month,0,'.','.')}} VNĐ</td>
                        <td>{{$item->session}}</td>
                        <td>{{number_format($item->total_wage,0,'.','.')}} VNĐ</td>
                        <td><span class="label label-inline {{$item->status == 1 ? 'label-light-primary': 'label-light-danger'}} font-weight-bold">{{statusWage()[$item->status]}}</span></td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
            @if(count($wages) <= 0) <div class="card-body">
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