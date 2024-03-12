@extends('layouts.frontend.master')
@section('title', 'Trang chủ')
@section('style')
<link href="https://fonts.googleapis.com/css?family=Karla:400,700&amp;display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/%40mdi/font%404.8.95/css/materialdesignicons.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="{{asset('frontend/assets/css/bd-wizard.css')}}">
@endsection

@section('content')
<br />
<div class="container">

  <div style="border: 2px solid #e63a34;margin-bottom: 30px;" class="item-gym pricing-wrap-2 mb-80">
    <div class=" row no-gutters align-items-center pt-0">
      <div class=" col-lg-4">
        <div style="border-right: 2px solid #e63a34;" class="pricing-title">
          <h3>{{$package->package_name}}</h3>
          <span style="font-size: 55px">{{number_format($package->into_price, 0, '.','.')}} <sup>đ</sup></span>
          
        </div>
      </div>
      <div class="col-lg-4">
        <div style="border-right: 2px solid #e63a34;" class="pricing-list">
          <ul>
            <li><i class="far fa-check-circle"></i> Môn tập : {{$package->subject->subject_name}}</li>
            @if($package->set_pt == 1)
            <li><i class="far fa-check-circle"></i> {{$package->total_session_pt }} buổi tập có PT </li>
            <li><i class="far fa-check-circle"></i> {{$package->week_session_pt}} buổi PT / tuần</li>
            @else
            <li><i class="far fa-check-circle"></i> Gói tập không PT</li>
            @endif
          </ul>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="pricing-content">
          <p>
            {{$package->short_description}}
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-12 order-md-1">
    <h4 class="mb-3">Hóa đơn gói tập</h4>
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Well done: </strong> {!! session('success') !!}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    @if(session('failed'))
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>Warning: </strong> {!! session('failed') !!}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->all())
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>Warning: </strong> Vui lòng kiểm tra lại. Lưu ý các trường không được để chống
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('msg'))
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>Error: </strong> {{ session('msg') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if($package->type_package == 1)
    <form action="{{route('order.postOrder', $package->id)}}" method="POST" enctype="multipart/form-data" id="wizard">
      @csrf
      <h3>
        <div class="media">
          <div class="bd-wizard-step-icon"><i class="mdi mdi-account-outline"></i></div>
          <div class="media-body">
            <div class="bd-wizard-step-title">Time kích hoạt</div>
            <div class="bd-wizard-step-subtitle">Step 1</div>
          </div>
        </div>
      </h3>
      <section>
        @if($package->type_package == 1)
        {{-- <div class="content-wrapper">
                  <h4 class="section-heading mt-0">Thời gian đăng ký gói tập</h4>
                
                  <div class="row pt-10">
                    <div class="form-group col-md-6 ">
                      <label for="phoneNumber" class="sr-only"></label>
                    <p class="fw-bold">Bắt đầu</p> 
                    <div class="md-form md-outline input-with-post-icon datepicker" id="customDays">
                      <input style="border-color: black" name="activate_date" placeholder="Select date" type="date" id="Customization" class="form-control">
                    </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="emailAddress" class="sr-only"></label>
                      <p class="fw-bold">Kết thúc</p>
                      <div class="md-form md-outline input-with-post-icon datepicker" id="customDays">
                        <input style="border-color: black" name="date_end" placeholder="Select date" type="date" id="Customization" class="form-control">
                      </div>
                    </div>
                  </div>
                </div> --}}

        <h4 class="section-heading mt-0">Chọn thời gian kích hoạt và gia hạn gói tập</h4>
        <div class="content-wrapper">
          <div style="width: 100%;" class="form-group">
            <label style="color: black" for="exampleInputEmail1">Ngày kích hoạt</label>
            {{-- <input type="date" name="activate_date" id="activate_date_input"> --}}
            <input type="date" min="{{date ( 'Y-m-d' , strtotime ( '+1 day' , strtotime ( date('Y-m-d') ) ) )}}"
              max="{{date ( 'Y-m-d' , strtotime ( '+30 day' , strtotime ( date('Y-m-d') ) ) )}}"
             name="activate_date" class="form-control activate_date_input" id="activate_date_input">
            <small id="emailHelp" class="form-text text-muted">chọn ngày kích hoạt, chúng tôi sẽ tạo lịch cho bạn.</small>
          </div>
        </div>
        @elseif($package->type_package == 2)
        <h4 class="section-heading mt-0">Chọn thời gian kích hoạt và gia hạn gói tập</h4>
        <div class="content-wrapper">
          <div style="width: 100%;" class="form-group">
            <label style="color: black" for="exampleInputEmail1">Ngày kích hoạt</label>
            <input type="date" name="activate_date" class="form-control" class="activate_date" id="exampleInputEmail1 activate_date" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">chọn ngày kích hoạt, chúng tôi sẽ tạo lịch cho bạn.</small>
          </div>
          <div style="margin-top: 20px" class="input-group mb-3">
            <label style="color: black">Chọn số tháng gia hạn</label>
            <div style="width: 80%;" class="form-group">
              <select name="month_package" class="custom-select" id="inputGroupSelect02">
                <option selected>Choose...</option>
                <option value="1">1 Tháng</option>
                <option value="2">3 tháng</option>
                <option value="3">6 tháng</option>
                <option value="3">12 tháng</option>
              </select>
            </div>

          </div>
        </div>
        @endif
      </section>
      <h3>
        <div class="media">
          <div class="bd-wizard-step-icon"><i class="mdi mdi-bank"></i></div>
          <div class="media-body">
            <div class="bd-wizard-step-title">Thời gian tập</div>
            <div class="bd-wizard-step-subtitle">Step 2</div>
          </div>
        </div>
      </h3>
      <section>
        <div class="content-wrapper">
          <h4 class="section-heading">Lịch trình tập </h4>
          <div>
            <span class="text-danger"><strong>Chọn lịch({{$package->week_session_pt}} buổi) tập với PT / tuần </strong></span><br>
          </div>
          <div>
            @error('weekday')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="row">
            <div class="row">
              <div class="col-xl-12">
                <div class="schedule-table">
                  <table class="table bg-white">
                    <thead>
                      <tr>
                        <th>Thời Gian</th>
                        @foreach ($times as $time)
                        <th>{{$time->time_name}}</th>
                        @endforeach
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($arrayWeekdays as $key => $weekday)
                      <tr>
                        <td class="day">
                          {{$weekday}}
                          <div>
                            <input id="{{$weekday}}_pt check_weekday_pt" onclick="checkWeekday(this.id)" class="checkboxclass" name="weekday[{{$key}}]" value="{{$key}}" type="checkbox">
                          </div>
                        </td>
                        @foreach ($times as $time)
                        <td class="active">
                          <label>
                            <input id="check_weekday_pt" onclick="checkWeekdayPt({{$key}}, {{$time->id}})" type="radio" class="option-input radio {{$weekday}}_pt" name="weekday[{{$key}}]" value="{{$time->id}}" disabled/>
                          </label>
                        </td>
                        @endforeach

                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <h3>
        <div class="media">
          <div class="bd-wizard-step-icon"><i class="mdi mdi-account-check-outline"></i></div>
          <div class="media-body">
            <div class="bd-wizard-step-title">Chọn PT</div>
            <div class="bd-wizard-step-subtitle">Step 3</div>
          </div>
        </div>
      </h3>
      <section>
        <div class="content-wrapper">
          <h4 class="section-heading mb-5">Lựa chọn PT theo yêu cầu</h4>


           {{-- <select name="pt_id" id="pet-select" class="fs-90 p-2-5 w-100 text-center"> --}}
          <select id="setCheckCoach" name="pt_id" class="form-select" aria-label="Default select example">
           @foreach($coachs as $coach)
                      <option value="{{$coach->id}}">{{$coach->name}}</option>
            @endforeach 

          </select>
      </section>
      <h3>
        <div class="media">
          <div class="bd-wizard-step-icon"><i class="mdi mdi-emoticon-outline"></i></div>
          <div class="media-body">
            <div class="bd-wizard-step-title">Thanh toán</div>
            <div class="bd-wizard-step-subtitle">Step 4</div>
          </div>
        </div>
      </h3>
      <section>
        <div class="content-wrapper">
          <h4 class="section-heading mb-5">Bill thanh toán</h4>
          <div class="card p-2">
            <div class="input-group">
              <input name="discount_code" id="discount_code" type="text" class="form-control" placeholder="Mời nhập mã giảm giá" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <div class="input-group-append w-20">
                <button onclick="checkDiscount()" id="button_discount" class="btn btn-secondary btn-md waves-effect m-0 button_discount" type="button">Áp
                  dụng</button>
              </div>
            </div>
            <div>
              <span id="msg_package"></span>
            </div>
            <div>
              <span></span>
            </div>
          </div>

          <div style="margin-top: 20px; width: 30%;" class="list-group-item d-flex justify-content-between">
            <span>Tổng tiền</span>
            <strong id="total_money">{{$package->into_price}}</strong>
          </div>

          <div style="margin-top: 20px; width: 60%; border: none" class="list-group-item d-flex justify-content-between">
            <button name="payment_vnp" value="1" class="btn btn-secondary btn-md waves-effect m-0" type="submit">Thanh toán VNPAY</button>
            <button name="payment_momo" value="1" id="redirect" class="btn btn-warning">Thanh toán MOMO</button>
          </div>
           
        </div>
      </section>


    </form>
    @elseif($package->type_package == 2)
    <form action="{{route('order.postOrder', $package->id)}}" method="POST" enctype="multipart/form-data" id="wizard">
      @csrf
      <h3>
        <div class="media">
          <div class="bd-wizard-step-icon"><i class="mdi mdi-account-outline"></i></div>
          <div class="media-body">
            <div class="bd-wizard-step-title">Personal Details</div>
            <div class="bd-wizard-step-subtitle">Step 1</div>
          </div>
        </div>
      </h3>
      <section>
        <h4 class="section-heading mt-0">Chọn thời gian kích hoạt và gia hạn gói tập</h4>
        <div class="content-wrapper">
          <div style="width: 100%;" class="form-group">
            <label style="color: black" for="exampleInputEmail1">Ngày kích hoạt</label>
            <input type="date" name="activate_date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">chọn ngày kích hoạt, chúng tôi sẽ tạo lịch cho bạn.</small>
          </div>
          <div style="margin-top: 20px" class="input-group mb-3">
            <label style="color: black">Chọn số tháng gia hạn</label>
            <div style="width: 80%;" class="form-group">
              <select name="month_package" class="custom-select" id="inputGroupSelect02">
                <option selected>Choose...</option>
                <option value="1">1 Tháng</option>
                <option value="2">3 tháng</option>
                <option value="3">6 tháng</option>
                <option value="3">12 tháng</option>
              </select>
            </div>

          </div>
        </div>
      </section>

      <h3 style="float: left;">
        <div class="media">
          <div class="bd-wizard-step-icon"><i class="mdi mdi-emoticon-outline"></i></div>
          <div class="media-body">
            <div class="bd-wizard-step-title">Thanh toán</div>

          </div>
        </div>
      </h3>
      <section>
        <div class="content-wrapper">
          <h4 class="section-heading mb-5">Bill thanh toán</h4>


          <div class="card p-2">
            <div class="input-group">
              <input name="discount_code" id="discount_code" type="text" class="form-control" placeholder="Mời nhập mã giảm giá" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <div class="input-group-append w-20">
                <button onclick="checkDiscount()" id="button_discount" class="btn btn-secondary btn-md waves-effect m-0 button_discount" type="button">Áp
                  dụng</button>
              </div>
            </div>
            <div>
              <span id="msg_package"></span>
            </div>
            <div>
              <span></span>
            </div>
          </div>

          <div style="margin-top: 20px; width: 30%;" class="list-group-item d-flex justify-content-between">
            <span>Tổng tiền</span>
            <strong id="total_money">{{$package->into_price*$package->total_session_pt}}</strong>
          </div>

          <div style="margin-top: 20px; width: 30%; border: none" class="list-group-item d-flex justify-content-between">
            <button name="payment_vnp" value="1" class="btn btn-secondary btn-md waves-effect m-0" type="submit">Thanh toán VNPAY</button>
          </div>

          <button name="payment_momo" value="1" id="redirect" class="btn btn-warning">Thanh toán MOMO</button>


        </div>
      </section>


    </form>
    @endif

  </div>

</div>
<br>
@endsection

@section('js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

  let weekdayPt = {}
  function checkWeekday(weekday_id){
    checkbox_weekday = document.getElementById(weekday_id);
    let value = checkbox_weekday.value
    if(checkbox_weekday.checked == true){
      weekdayPt[value] = null
      console.log($(checkbox_weekday).closest('tr').find('.active input'))
      // return
      $(checkbox_weekday).closest('tr').find('.active input').prop('disabled', false)
      // checkbox_weekday.style.background-color=#959595;
    } else {
      delete weekdayPt[value]
      $(checkbox_weekday).closest('tr').find('.active input').prop('disabled', true)
      console.log("checked false");
    }
    console.log(weekdayPt)
  }
$package_id = {{$package->id}};
// $(document).change('#activate_date_input', function (e) {
//     console.log(document.getElementById("activate_date_input").value);
//   })
  function checkWeekdayPt(key, time){
    console.log(document.getElementById("activate_date_input").value);
    activate_date = document.getElementById("activate_date_input").value
    if(weekdayPt.hasOwnProperty(key)) weekdayPt[key] = time 
    console.log(weekdayPt);
    $.ajax({
        type: 'GET',
        url: "{{route('order.checkWeekdayPt')}}",
        data:{
          weekdayPt: weekdayPt,
          activate_date: activate_date,
          package_id : {{$package->id}}
        },
        
        success:function(data){
          console.log("abc");
          if(data['result'] == true){
            console.log(data['arrayPt']);
            document.getElementById('setCheckCoach').innerHTML = '';
            $.each(data['arrayPt'], function(key, pt) {
              console.log(key);
              document.getElementById('setCheckCoach').innerHTML += `<option value="${key}">${pt}</option>`; 
            });
          }
          else{
            swal({
              title: "Lỗi!",
              text: "Vui lòng chọn ngày kích hoạt",
              icon: "error",
              button: "Ok!",
            });
          }
          
        }
    });
  }
    $package_id = {{$package->id}};
    // $('#button_discount').on('click',function(){
  function checkDiscount(){
      console.log("quân");
      var discount_code = $('#discount_code').val();
      $.ajax({
          type: 'GET',
          url: "{{route('order.setTotalMoneyClient')}}",
          data:{
                package_id: $package_id,
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
                document.querySelector('#msg_package').innerHTML = `${data['message']}`;
              }
            else{
              document.querySelector('#msg_package').innerHTML = `${data['message']}`;
              document.querySelector('#total_money').innerHTML = `${data['total_money']}`;
            }
        }
    });
  }
  // })
      
</script>



<script src="https://cdn.jsdelivr.net/npm/popper.js%401.16.0/dist/umd/popper.min.js"></script>
<script src="{{asset('frontend/assets/js/jquery.steps.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/bd-wizard.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
@endsection