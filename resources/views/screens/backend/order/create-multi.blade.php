@extends('layouts.backend.master')

@section('title', 'Thêm phiếu giảm giá')

@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="btn-group" role="group" aria-label="Third group">
            <a class="btn btn-info" href="">Thêm order PT kèm 1:2 ,1:3</a>
        </div>
    </div>
  </nav>
<div class="card card-custom">
    @include('screens.backend._alert')
    <div class="card-header">
     <h3 class="card-title">
      Thêm mới Order
     </h3>
    </div>
    <!--begin::Form-->
    <form action="{{route('admin.order.postOrderMulti')}}" method="POST">
        @csrf
        @method('POST')
     <div class="card-body">
      
        {{-- <div class="form-group row">
            <label class="col-2 col-form-label">Chọn người dùng</label>
            <div class=" col-lg-4 col-md-9 col-sm-12">
             <select name="user_id" class="form-control select2" id="kt_select2_11">
              <option label="Label"></option>
              <optgroup label="Chọn người dùng">
                @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
              </optgroup>

             </select>
             @error('user_id')
                <span class="text-danger">{{ $message }}</span>    
            @enderror
            </div>
        </div> --}}

        <div class="form-group row">
            <label class="col-2 col-form-label">Chọn người dùng</label>
            <div class=" col-lg-4 col-md-9 col-sm-12">
             <select name="user_id[]" class="form-control select2" id="kt_select2_11" multiple name="param">
              <option label="Label"></option>
              <optgroup label="Chọn người dùng">
                @foreach ($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
              </optgroup>

             </select>
             @error('user_id')
                <span class="text-danger">{{ $message }}</span>    
            @enderror
             </select>
            </div>
           </div>
        
        <div class="form-group row">
            <label class="col-2 col-form-label">Chọn gói tập</label>
            <div class="col-lg-4 col-md-9 col-sm-12">
             {{-- <select id="add_package" placeholder="" class="form-control select2" id="kt_select2_1" > --}}
                <select name="package_id"  class="form-control select2 is-invalid add_package" id="kt_select2_1_validate" >
                <option value=""><strong>Chọn gói tập</strong></option>
                @foreach ($packages as $package)
                    <option  value="{{$package->id}}">{{$package->package_name}}  </option>  
                @endforeach  
                   
             </select>
             @error('package_id')
                <span class="text-danger">{{ $message }}</span>    
            @enderror
            </div>
        </div>

        <div id="time_package" class="form-group row">
            <label class="col-2 col-form-label">Chọn ca tập</label>
            <div class=" col-lg-4 col-md-9 col-sm-12">
                <select name="time_id" class="form-control select2 is-invalid" id="kt_select2_2_validate" >

                    <option style="display: none;" value=""></option>
                    @foreach ($times as $time)
                        <option value="{{$time->id}}">{{$time->time_name}}</option>  
                    @endforeach 

                
                </select>
                @error('time_id')
                    <span class="text-danger">{{ $message }}</span>    
                @enderror
            </div>
        </div>


        <div id="coach_package"  class="form-group row set-coach" >
            <label class="col-2 col-form-label">Chọn huấn viện viên</label>
            <div class=" col-lg-4 col-md-9 col-sm-12">
                <select name="pt_id" class="form-control select2 is-invalid" id="kt_select2_3_validate" >
                    <option style="display: none;" value=""></option>
                    <option >Không có</option>
                    @foreach ($coachs as $coach)
                        <option value="{{$coach->id}}">{{$coach->name}}</option>  
                    @endforeach 
                </select> 
                @error('pt_id')
                    <span class="text-danger">{{ $message }}</span>    
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label class="col-2 col-form-label">Thời gian bắt đầu</label>
                <div class="col-lg-4 col-md-9 col-sm-12">
                    <div class="input-group date" >
                        <input type="date" class="form-control" name="activate_day" placeholder="Select time" id="kt_datetimepicker_7"/>
                        <div class="input-group-append">
                        <span class="input-group-text">
                        <i class="la la-calendar glyphicon-th"></i>
                        </span>
                        </div>
                    </div>
                <span class="form-text text-muted">Thời gian bắt đầu</span>
                @error('activate_day')
                 <span class="text-danger">{{ $message }}</span>    
                @enderror
            </div>
        </div> 
        <div id="weekday_package"  class="form-group row">
            <label class="col-2 col-form-label">Chọn thứ tập PT</label>
            <div class=" col-lg-4 col-md-9 col-sm-12">
             <select name="weekday_name[]" class="form-control select2" id="kt_select2_9"  multiple>
              <option label="Label"></option>
              <optgroup label="Chọn 3 ngày">
                @foreach ($weekdays as $weekday)
                    <option value="{{$weekday->weekday_name}}">{{$weekday->weekday_name}}</option>  
                @endforeach 
              </optgroup>

             </select>
                @error('weekday_name')
                    <span class="text-danger">{{ $message }}</span>    
                @enderror
            </div>
           </div>
        
        <div class="form-group row">
            <label  class="col-2 col-form-label">Nhập phiếu giảm giá</label>
            <div style="display: flex" class="col-10">
                <input disabled name="discount_code" style="width: 60%" class="form-control discount_code @error('discount_title') is-invalid @enderror" name="discount_title"  type="text" value="{{ old('discount_code') }}" placeholder="title" id="example-text-input "/>
                @error('discount_title')
                    <span class="text-danger">{{ $message }}</span>    
                @enderror
                <button disabled style="margin-left: 10px" type="button" class="btn btn-outline-info button_discount">Áp dụng</button>
            </div>
            
        </div>
            

      {{-- <div class="form-group row">
       <label for="example-email-input" class="col-2 col-form-label">Code</label>
       <div class="col-10">
        <input class="form-control @error('discount_code') is-invalid @enderror" name="discount_code" type="text" value="{{ old('discount_code') }}" placeholder="dvbFGJvasjF" id="example-email-input"/>
        @error('discount_code')
            <span class="text-danger">{{ $message }}</span>    
        @enderror
       </div>
      </div> --}}
        {{-- style="visibility: hidden; transform: translateY(-20px); opacity:0"  --}}
      <div  class="form-group row">
        <label class="col-2 col-form-label">Chọn phương thức thanh toán</label>
        <div class=" col-lg-4 col-md-9 col-sm-12">
            <select name="payment_method" class="form-control select2" id="kt_select2_10" name="param">


                <option value="1">Thanh toán trực tiếp</option>
                <option value="2">Chuyển khoản ngân hàng</option>

            </select>
                
        </div>
    </div>

    <div  class="form-group row">
        <label class="col-2 col-form-label"><strong>Tổng tiền</strong></label>
        <div class=" col-lg-4 col-md-9 col-sm-12">
            <strong id="total_money" style="color: red"></strong>
                
        </div>
    </div>
      
     <div class="card-footer">
      <div class="row">
       <div class="col-2">
       </div>
       <div class="col-10">
        <button type="submit" id="btn_disabled" class="btn btn-success mr-2 disabled">Submit</button>
        {{-- <button type="reset" class="btn btn-secondary">Cancel</button> --}}
       </div>
      </div>
     </div>
    </form>
   </div>




   
    
@endsection

@section('script')

<script>

$('.add_package').on('change',function(){
    console.log("quân");
      $package_id = $(this).val();
      $.ajax({
          type: 'GET',
          url: "{{route('admin.order.setPackage')}}",
          data:{
                id: $package_id
            },
          
          success:function(data){
            console.log("abc");
            if(data['result'] == 1){
                console.log(data['package'].price);
                console.log(data['result']);
                $('.discount_code').attr('disabled', false);
                $('.button_discount').attr('disabled', false);
        
                document.querySelector('#btn_disabled').classList.remove("disabled");
                document.querySelector('#total_money').innerHTML = `${data['package'].price}`;
            }
            if(data['result'] == 0){
                $('.discount_code').attr('disabled', false);
                $('.button_discount').attr('disabled', false);

                document.querySelector('#btn_disabled').classList.remove("disabled");
                document.querySelector('#total_money').innerHTML = `${data['package'].price}`;

            }
          }
      });
  });


  $('.add_package').on('change',function(){
    console.log("quân");
      $package_id = $(this).val();
      $.ajax({
          type: 'GET',
          url: "{{route('admin.order.setCoach')}}",
          data:{
                id: $package_id
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
    })

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

<script>
    $(document).ready(function(){
        $('.select2').select2()
    })


    // Class definition
var KTSelect2 = function() {
 // Private functions
    var demos = function() {
    // basic
    $('#kt_select2_1_validate').select2({
    placeholder: "Chọn gói tập"
    });

    // nested
    $('#kt_select2_2_validate').select2({
    placeholder: "Chọn ca tập"
    });

    // multi select
    $('#kt_select2_3_validate').select2({
    placeholder: "Select a state",
    });
    }

    // Public functions
    return {
    init: function() {
    demos();
    }
    };
    }();

    // Initialization
    jQuery(document).ready(function() {
    KTSelect2.init();
    });







</script>

@endsection