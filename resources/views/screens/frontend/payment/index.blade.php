@extends('layouts.frontend.master')
@section('title', 'Trang chủ')

@section('content')
<br/>
<div class="container">

    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class=" d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Giỏ hàng</span>
                <span class="badge badge-secondary badge-pill">1</span>
            </h4>
            @include('screens.backend._alert')
            <ul class="list-group mb-3 sticky-top">
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Tên sản phẩm</h6>
                        <div>
                        <img src="https://thethaodonga.com/wp-content/uploads/2022/01/Sergi-Constance-4.jpg" alt="" width="70px">
                        </div>
                        <div>
                            <small class="text-muted">Gói tập áp dụng dành cho những người muốn giảm cân và có 1 cơ thể săn chắc</small>
                        </div>
                        <div>
                            <div class="text-black">
                                <label for="firstName">Phiếu giảm giá</label>
                                <input name="discount_code" type="text" class="form-control" id="firstName" placeholder="" value="" required="">
                                <div class="invalid-feedback"> Valid first name is required. </div>
                            </div>
                        </div>
                    </div>
                    <span class="text-muted">$12</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Tổng tiền</span>
                    <strong>$12</strong>
                </li>
            </ul>
            <form class="card p-2">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Mã giảm giá">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">Áp dụng</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Thanh toán gói tập</h4>
            <form action="{{route('payment.store', $package->id)}}" class="needs-validation" method="POST">
                @csrf
                @method('POST')
                <div class="row">
                   
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Họ và tên</label>
                        <input type="text" value="{{Auth::user()->name}}" disabled class="form-control" id="lastName" placeholder="">
                        <div class="invalid-feedback"> Valid last name is required. </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="username">Email</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                        </div>
                        <input type="text" value="{{Auth::user()->email}}" disabled class="form-control" id="username" placeholder="" >
                        <div class="invalid-feedback" style="width: 100%;"> Your username is required. </div>
                    </div>
                </div>
                {{-- <div class="mb-3">
                    <label for="username">Địa chỉ</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="username" placeholder="" required="">
                        <div class="invalid-feedback" style="width: 100%;"> Your username is required. </div>
                    </div>
                </div> --}}
                <div class="mb-3">
                    <label for="email">Số điện thoại<span class="text-muted"></span></label>
                    <input type="email" value="{{Auth::user()->phone}}" disabled class="form-control" id="email" placeholder="">
                    <div class="invalid-feedback"> Please enter a valid email address for shipping updates. </div>
                </div>
                <div id="weekday_package" class="mb-3">
                    <label for="email">Chọn ca tập<span class="text-muted"></span></label>
                    <select name="time_id"  class="form-select" aria-label="Default select example">
                        {{-- <option selected>Open this select menu</option> --}}
                        @foreach ($times as $time)
                            <option value="{{$time->id}}">{{$time->time_name}}</option>  
                        @endforeach 

                    </select>
                </div>

                <div id="coach_package" class="mb-3">
                    <label for="email">Chọn huấn luyện viên<span class="text-muted"></span></label>
                    <select  name="pt_id" class="form-select" aria-label="Default select example">
                        {{-- <option selected>Open this select menu</option> --}}
                        @foreach ($coachs as $coach)
                            <option value="{{$coach->id}}">{{$coach->name}}</option>  
                        @endforeach 
                    </select>
                </div>
                
                <div class="mb-3" id="time_package">
                    <label for="username">Thời gian bắt đầu</label>
                    <div class="input-group">
                        <input name="activate_day" type="date" class="form-control" id="username" placeholder="" required="">
                        <div class="invalid-feedback" style="width: 100%;"> Your username is required. </div>
                    </div>
                </div>
                <div id="weekday_package" class="mb-3">
                    <label for="email">Chọn thứ tập có PT<span class="text-muted"></span></label>
                    <select name="weekday_name[]" multiple class="form-select" aria-label="Default select example">
                        @foreach ($weekdays as $weekday)
                            <option value="{{$weekday->weekday_name}}">{{$weekday->weekday_name}}</option>  
                        @endforeach 
                    </select>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="save-info">
                    <label class="custom-control-label" for="save-info">Bạn đồng ý với điều kiện của chúng tôi ? </label>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Tiếp tục thanh toán</button>
            </form>
        </div>
    </div> 
</div>
<br>
@endsection

@section('js')

<script>
    packageId = {{$package->id}};
    console.log(packageId);
    console.log("{{route('admin.order.setPackage')}}");
        $.ajax({
            type: 'GET',
            url: "{{route('admin.order.setPackage')}}",
            data:{
                id: packageId
            },
            
            success:function(data){
            console.log("abc");
            if(data['result'] == 1){
                console.log(data['package'].price);
                console.log(data['result']);
                console.log("có pt");
                $('.discount_code').attr('disabled', false);
                $('.button_discount').attr('disabled', false);
                document.querySelector('#coach_package').style.display='block';
                document.querySelector('#weekday_package').style.display='block';
                document.querySelector('#time_package').style.display='block';
                document.querySelector('#total_money').innerHTML = `${data['package'].price}`;
            }
            if(data['result'] == 0){
                console.log("bằng 0");
                $('.discount_code').attr('disabled', false);
                $('.button_discount').attr('disabled', false);
                document.querySelector('#coach_package').style.display='none';
                document.querySelector('#weekday_package').style.display='none';
                document.querySelector('#time_package').style.display='none';
                // document.querySelector('#btn_disabled').classList.remove("disabled");
                document.querySelector('#total_money').innerHTML = `${data['package'].price}`;

            }
            }
        });
    
    

        
        $.ajax({
            type: 'GET',
            url: "{{route('admin.order.setCoach')}}",
            data:{
                id: {{$package->id}}
            },
            
            success:function(data){
            console.log("abc");
            if(data['result'] == true){
                console.log(data['package']);
                console.log(data['result']);
                document.querySelector(".set-coach").disabled = false;
                // document.querySelector('#total_money').innerHTML = `${data['total_money']}`;
            }
            else{
                // document.querySelector(".set-coach").innerHTML = `Gói tập này không có PT`;
            }
            }
        });
    
        $('.button_discount').on('click',function(){
            var package_id = $('#add_package').val();
            console.log("quân");
            var discount_code = $('.discount_code').val();
            $.ajax({
                type: 'GET',
                url: "{{route('admin.order.setTotalMoney')}}",
                data:{
                    package_id: package_id,
                    discount_code: discount_code
                },
                
                success:function(data){
                console.log("abc");
                console.log(data);
                if(data['result'] == true){
                    
                    // console.log(data['package']);
                    // console.log(data['result']);
                    // document.querySelector(".set-coach").disabled = false;
                    document.querySelector('#total_money').innerHTML = `${data['total_money']}`;
                }
                else{
                    // document.querySelector(".set-coach").innerHTML = `Gói tập này không có PT`;
                }
                }
            });
        })
    
    
    
</script>
    


@endsection