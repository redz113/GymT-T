@extends('layouts.frontend.account.account')
@section('content')
<div class="card-header bg-white border-0">
    <div class="row align-items-center">
      <div class="col-8">
        <h3 style="font-size: 20px; font-weight: 900" class="mb-0">Lịch trình</h3>
      </div>
      <div class="col-4 text-right">
        {{-- <a href="#!" class="btn btn-sm btn-primary">Settings</a>  --}}
      </div>
    </div>
</div>
<div style="padding-bottom: 0px;" class="card-body">
    <form action="" method="GET">
        <div class="row">
          <div class="col mx-sm-3">
            <label for="">Date start</label>
            <input type="date" name="start_date" class="form-control" placeholder="First name">
          </div>
          <div class="col mx-sm-3">
            <label for="">Date end</label>
            <input type="date" class="form-control" name="end_date" placeholder="Last name">
          </div>
          <div class="col mx-sm-3">
            <label for="">Submit</label>
            <div class="col">
                <button type="submit" style="background-color: #FF8800" class="btn btn-primary mb-2">Tìm kiếm</button>
            </div>
          </div>
          
        </div>
        
      </form>
</div>
<hr style="background-color: rgb(71, 67, 67); margin-bottom: 0px; margin-top: 10px">
<div class="card-body">
    
    <table class="table">
        <thead>
            <tr align="center">
                <th scope="col" class="text-center">Id</th>
                <th scope="col" class="m-3">Tên Huấn luyện viên</th>
                <th scope="col" class="m-3">Ca Tập</th>
                <th scope="col" class="m-3">Ngày tập</th>
                <th scope="col" class="m-3">Thứ tập</th>
                <th scope="col" class="m-3">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1 ?>
            @foreach($schedules as $schedule)
            <tr class="">
                <th scope="row" class="text-center">{{$schedule->id}}</th>
                <td class="text-center">{{$schedule->pt->name}}</td>
                <td class="text-center">{{$schedule->time->time_name}} ({{$schedule->time->start_time}} - {{$schedule->time->end_time}})</td>
                <td class="text-center">{{date('d-m-Y', strtotime($schedule->date))}}</td>
                <td class="text-center">{{$schedule->weekday_name}}</td>
                {{-- <td class="text-center">tập bụng</td> --}}
                <td class="text-center">
                  {{-- {{dd($schedule->status)}} --}}
                  @if(date('Y-m-d', strtotime($schedule->date)) > date('Y-m-d'))
                    <a href="{{route('account.reschedule', $schedule->id)}}" class="btn btn-primary">Đổi lịch</a>
                  @elseif(date('Y-m-d', strtotime($schedule->date)) <= date('Y-m-d') && $schedule->status == 0)
                    <p style="color: red; font-weight: bold;">Chưa điểm danh</p>
                  @elseif(date('Y-m-d', strtotime($schedule->date)) <= date('Y-m-d') && $schedule->status == 1)
                    <p style="color: green; font-weight: bold;">Đã điểm danh</p>
                  @else
                    <p style="color: rgb(62, 95, 211); font-weight: bold;">Chờ cập nhật</p>
                  @endif
                </td>
              </tr>
            @endforeach

        </tbody>
    </table> 
    <div>
        {{$schedules->appends(request()->input())->links()}}
    </div>
</div>
     
@endsection