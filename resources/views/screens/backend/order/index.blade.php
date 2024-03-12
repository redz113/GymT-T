@extends('layouts.backend.master')

@section('title', 'Quản lý đơn hàng')

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
@endsection

@section('content')
<div>

    <div class="card card-custom">
        @include('screens.backend._alert')
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Quản lý đơn hàng
                    <span class="d-block text-muted pt-2 font-size-sm">Danh sách</span>
                </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <div class="dropdown dropdown-inline mr-2">
                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                    <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>Export</button>
                    <!--begin::Dropdown Menu-->
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <!--begin::Navigation-->
                        <ul class="navi flex-column navi-hover py-2">
                            <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-print"></i>
                                    </span>
                                    <span class="navi-text">Print</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-copy"></i>
                                    </span>
                                    <span class="navi-text">Copy</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <div wire:click="exportUser()" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-file-excel-o"></i>
                                    </span>
                                    <span class="navi-text">Excel</span>
                                </div>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-file-text-o"></i>
                                    </span>
                                    <span class="navi-text">CSV</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="{{route('admin.order.pdf')}}" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-file-pdf-o"></i>
                                    </span>
                                    <span class="navi-text">PDF</span>
                                </a>
                            </li>
                        </ul>
                        <!--end::Navigation-->
                    </div>
                    <!--end::Dropdown Menu-->
                </div>
                <!--end::Dropdown-->
                <!--begin::Button-->
                <a href="{{route('admin.order.mailOrder')}}" class="btn btn-primary font-weight-bolder">
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
                    </span>Gửi mail đến đơn hàng thất bại</a>
                <!--end::Button-->
                {{-- <a style="margin-left: 8px" href="{{route('admin.order.add')}}" class="btn btn-primary font-weight-bolder">
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
                </span>Thêm mới đơn hàng</a> --}}

                <div style="margin-left: 8px" class="dropdown dropdown-inline mr-2">
                    <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="svg-icon svg-icon-md">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Design/PenAndRuller.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                                    <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>Thêm mới đơn hàng</button>
                    <!--begin::Dropdown Menu-->
                    <div style="width: 100%;" class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <!--begin::Navigation-->
                        <ul class="navi flex-column navi-hover py-2">
                            <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Chọn loại gói tập</li>
                            <li style="width: 100%;" class="navi-item">
                                <a href="{{route('admin.order.createSimple')}}" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="fa-solid fa-dumbbell"></i>
                                    </span>
                                    <span class="navi-text">Đơn hàng gói tập thường</span>
                                </a>
                            </li>
                            <li style="width: 100%;" class="navi-item">
                                <a href="{{route('admin.order.createComplex')}}" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="fa-solid fa-dumbbell"></i>
                                    </span>
                                    <span class="navi-text">Đơn hàng gói theo lộ trình</span>
                                </a>
                            </li>

                        </ul>
                        <!--end::Navigation-->
                    </div>
                    <!--end::Dropdown Menu-->
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="">
                <div class="mb-7">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-xl-8">
                            <div class="row align-items-center">
                                
                                <div class="col-md-4 my-2 my-md-0">
                                    <div class="d-flex align-items-center">
                                    <label class="mr-3 mb-0 d-none d-md-block">Thời gian</label>
                                        <select wire:model="role" class="form-control" name="orderBy" id="kt_datatable_search_type">
                                            <option @if(request('orderBy', -1)=='asc') selected @endif value="asc">Lâu nhất</option>
                                            <option @if(request('orderBy', -1)=='desc') selected @endif value="desc">Gần nhất</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 my-2 my-md-0">
                                    <div class="d-flex align-items-center">
                                        <label class="mr-3 mb-0 d-none d-md-block">Trạng thái TT</label>
                                        <select wire:model="role" class="form-control" name="status" id="kt_datatable_search_type">
                                            @foreach(statusTT() as $key=>$item)
                                            <option @if(request('status', -1)==$key) selected @endif value="{{$key}}">{{$item}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                            <button class="btn btn-light-primary px-6 font-weight-bold">Tìm kiếm</button>
                        </div>
                            </div>
                        </div>
                       
            </form>
        </div>
    </div>
    <!--end::Search Form-->
    <!--end: Search Form-->
    <!--begin: Datatable-->
    <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
    <!--end: Datatable-->
</div>
<div class="card-body">
    <!--begin: Datatable-->
    <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên hội viên</th>
                {{-- <th>Ca tập</th>
                        <th>Thứ tập</th> --}}
                <th>Ngày bắt đầu</th>
                <th>Huấn luyện viên</th>
                <th>Tổng tiền</th>
                <th>Trạng thái TT</th>
                <th>Actions</th>

                {{-- <th>Edit Permission</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)


            <tr>
                <td>{{$order->id}}</td>
                <td>
                    {{-- {{$order->users()->name}} --}}
                    @foreach($order->users as $user)
                    {{$user->name}}
                    @endforeach
                </td>
                {{-- <td>
                            @if(isset($order->time->time_name))
                            {{$order->time->time_name}}
                @else
                Gói tập không có pt
                @endif
                </td>
                <td>
                    @if(isset($order->weekday_name))
                    {{$order->weekday_name}}
                    @else
                    Gói tập không có pt
                    @endif
                </td> --}}
                <td>
                    @if(isset($order->date_start))
                    {{$order->date_start}}
                    @else
                    Gói tập không có pt
                    @endif
                </td>
                <td>
                    @if(isset($order->pt->name))
                    {{$order->pt->name}}
                    @else
                    Gói tập không có pt
                    @endif

                </td>
                <td>{{$order->total_money}}</td>
                <td>
                    @if ($order->status == 1)
                    <span class="label label-inline label-light-success font-weight-bold">Đã thanh toán</span>
                    @else
                    <span class="label label-inline label-light-danger font-weight-bold">Chưa thanh toán</span>
                    @endif
                </td>
                <td nowrap="nowrap">
                    @if ($order->status == 1)
                    <a class="btn btn-primary" href="{{route('admin.order.contract_order', $order->id)}} ">Xem hợp đồng</a>
                    @elseif($order->status == 3)
                    <button type="button" disabled class="btn btn-dark">Đã gửi mail</button>
                    @else
                    {{-- <a href="{{route('admin.contract.create', [encrypt($order->id)])}}" class="btn btn-success mr-2">Gửi mail hỗ trợ</a> --}}
                    <a href="{{route('admin.order.sendMail', [encrypt($order->id)])}}" class="btn btn-danger mr-2">Gửi mail hỗ trợ</a>

                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!--end: Datatable-->
</div>
{{$orders->appends(request()->input())->links()}}
</div>

</div>

@endsection

@section('script')

<script>

</script>

@endsection