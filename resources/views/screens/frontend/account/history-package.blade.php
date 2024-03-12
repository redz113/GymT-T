@extends('layouts.frontend.account.account')
@section('content')
<div class="card-header bg-white border-0">
    <div class="row align-items-center">
      <div class="col-8">
        <h3 style="font-size: 20px; font-weight: 900" class="mb-0">Lịch sử gói tập của tôi</h3>
      </div>
      <div class="col-4 text-right">
        {{-- <a href="#!" class="btn btn-sm btn-primary">Settings</a>  --}}
      </div>
    </div>
</div>
<div class="card-body">
    <div class="tab-content" id="course-pills-tabContent">
        <!-- Content START -->
        <div class="tab-pane fade show active" id="course-pills-tabs-1" role="tabpanel" aria-labelledby="course-pills-tab-1">
            <h3 align="center" style="margin: 10px;font-size: 20px">Gói tập đang học</h3>
            <div class="row g-4">
                @foreach ($orders as $order)
                    @foreach($order->results as $result)
                    {{-- date('Y-m-d', strtotime($order->date_end))  > date('Y-m-d') && --}}
                        @if(  $result->status_package == 0 && $order->status == 1)
                        <!-- Card item START -->
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <div class="card shadow h-100">
                                <!-- Image -->
                                <img src="{{asset($order->package->avatar)}}" class="card-img-top" alt="course image">
                                <!-- Card body -->
                                <div class="card-body pb-0">

                                    <!-- Title -->
                                    <h5 class="card-title fw-normal"><a href="#">{{$order->package->package_name}}</a></h5>
                                    <p class="mb-2 text-truncate-2">{{$order->package->short_description}}.</p>
                                    <!-- Rating star -->
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
                                        <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
                                        <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
                                        <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
                                        <li class="list-inline-item me-0 small"><i class="far fa-star text-warning"></i></li>
                                        {{-- <li class="list-inline-item ms-2 h6 fw-light mb-0">4.0/5.0</li> --}}
                                    </ul>
                                    {{-- <button style="float: right;margin-bottom: 10px;" type="button" class="btn btn-primary">Xem thêm</button> --}}

                                </div>
                                <!-- Card footer -->
                                {{-- <div class="card-footer pt-0 pb-3">
                                    <hr>
                                </div> --}}
                            </div>
                        </div>
                        <!-- Card item END -->
                        @endif
                    @endforeach
                @endforeach
               

                

                <!-- Card item END -->
            </div> <!-- Row END -->
        </div>
        <!-- Content END -->

    </div>
    <hr style="background-color: rgb(63, 60, 60); height: 2px;">
    <div class="tab-content" id="course-pills-tabContent">
        <!-- Content START -->
        <div class="tab-pane fade show active" id="course-pills-tabs-1" role="tabpanel" aria-labelledby="course-pills-tab-1">
            <h3 align="center" style="margin: 10px;font-size: 20px">Gói tập đã học</h3>
            <div class="row g-4">
                @foreach ($orders as $order)
                    @foreach($order->results as $result)
                    {{-- date('Y-m-d', strtotime($order->date_end))  <= date('Y-m-d') && --}}
                        @if($result->status_package == 1 && $order->status == 1)
                        <!-- Card item START -->
                        <div class="col-sm-6 col-lg-4 col-xl-3">
                            <div class="card shadow h-100">
                                <!-- Image -->
                                <img src="{{asset($order->package->avatar)}}" class="card-img-top" alt="course image">
                                <!-- Card body -->
                                <div class="card-body pb-0">

                                    <!-- Title -->
                                    <h5 class="card-title fw-normal"><a href="#">{{$order->package->package_name}}</a></h5>
                                    <p class="mb-2 text-truncate-2">{{$order->package->short_description}}.</p>
                                    <!-- Rating star -->
                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
                                        <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
                                        <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
                                        <li class="list-inline-item me-0 small"><i class="fas fa-star text-warning"></i></li>
                                        <li class="list-inline-item me-0 small"><i class="far fa-star text-warning"></i></li>
                                        {{-- <li class="list-inline-item ms-2 h6 fw-light mb-0">4.0/5.0</li> --}}
                                    </ul>
                                    @foreach ($order->results as $result)
                                        @if($order->package->type_package == 1)
                                            @if($result->status_package == 0)
                                                <span style="color: red">Chưa có kết quả</span>
                                            @else
                                                <a href="{{route('account.resultPackage', $result->id)}}" style="float: right;margin-bottom: 10px;" type="button" class="btn btn-primary">Xem kết quả</a>
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                                <!-- Card footer -->
                                {{-- <div class="card-footer pt-0 pb-3">
                                    
                                </div> --}}
                            </div>
                        </div>
                        <!-- Card item END -->
                        @endif
                    @endforeach
                @endforeach
               

                

                <!-- Card item END -->
            </div> <!-- Row END -->
        </div>
        <!-- Content END -->

    </div>
</div>
     
@endsection