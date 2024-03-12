@extends('layouts.frontend.account.account')
@section('content')
<div class="card-header bg-white border-0">
    <div class="row align-items-center">
      <div class="col-8">
        <h3 style="font-size: 20px; font-weight: 900" class="mb-0">Đổi lịch</h3>
      </div>
      <div class="col-4 text-right">
        {{-- <a href="#!" class="btn btn-sm btn-primary">Settings</a>  --}}
      </div>
    </div>
</div>
<div class="card-body">
    <h4>Lịch tập theo lịch trình hiện tại</h4>
    <span>Ngày: {{$attendance->date}}</span>
    <br>
    <span>Ca tập: {{$attendance->time->time_name}}</span>
</div>
<div class="card-body">
    <form action="{{route('account.postReschedule', $attendanceId)}}" method="POST">
        @csrf
        {{-- <h6 class="heading-small text-muted mb-4">Đổi lịch</h6> --}}
        <div class="form-group">
            <h4>Chọn ngày bạn muốn tập bù</h4>
            <input min="{{strtotime($attendance->order->date_start) > strtotime(date('Y-m-d')) ? date ( 'Y-m-d' , strtotime ( $attendance->order->date_start ) ) : date('Y-m-d')}}" name="date" style="margin-bottom: 10px;" onchange="checkTimesCoach(this.value)" type="date" class="form-control" id="check-time" aria-describedby="emailHelp" placeholder="Enter email">
            @error('date')
                <span class="text-danger">{{ $message }}</span>    
            @enderror
            <br>
            <small id="emailHelp" class="form-text text-muted">Chọn ngày. chúng tôi sẽ kiểm tra cho bạn những ca bạn có thể tập bù hôm đó</small>
        </div>
        <div class="form-group">
            <h4>Mời bạn chọn ca tập bù (Dưới đây là những ca bạn có thể đổi lịch)</h4>
            <div id="list-times">
                <div style="color: red; margin-left: 20px">
                    bạn vui lòng hãy chọn ngày
                </div>

            </div>
            @error('time_id')
                <span class="text-danger">{{ $message }}</span>    
            @enderror
           
        </div>

        <button type="submit" style="background-color: #ff8800" class="btn btn-primary">Đổi lịch</button>
    </form>
</div>
     
@endsection

@section('js')
<script>
    function checkTimesCoach(date){
      console.log(date);
    //   var discount_code = $('#discount_code').val();
      $.ajax({
          type: 'GET',
          url: "{{route('account.checkTimesCoach')}}",
          data:{
                date: date,
                attendanceId: {{$attendanceId}}
            },
          
          success:function(data){
            console.log("abc");
            
            if(data['result'] == true){
                console.log(data);
                document.getElementById('list-times').innerHTML = '';
                $.each(data['arrayTimeId'], function(key, time) {
                    console.log(key);
                    document.getElementById('list-times').innerHTML += `<div>
                                                                            <input name="time_id" value="${key}" type="radio">
                                                                            <label for="">${time}</label>
                                                                        </div>`; 
                });
            }
            else{

            }
        }
    });
  }
</script>
@endsection