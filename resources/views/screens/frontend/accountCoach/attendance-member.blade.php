@extends('layouts.frontend.account.account')
@section('content')
<div class="card-header bg-white border-0">
    <div class="row align-items-center">
        <div class="col-8">
            <h3 style="font-size: 20px; font-weight: 900" class="mb-0">Điểm danh hội viên</h3>
        </div>
        <div class="col-4 text-right">
            {{-- <a href="#!" class="btn btn-sm btn-primary">Settings</a>  --}}
        </div>
    </div>
</div>
<div style="padding-bottom: 0px;" class="card-body">

</div>
<hr style="background-color: rgb(71, 67, 67); margin-bottom: 0px; margin-top: 10px">
<div class="card-body">

    <form action="{{route('accountPt.postAttendanceMember', $scheduleId)}}" method="POST">
    @csrf
        <table class="table">
            <thead>
                <tr align="center">
                    <th scope="col" class="text-center">Id</th>
                    <th scope="col" class="m-3">Tên hội viên</th>
                    <th scope="col" class="m-3">Ngày tập</th>
                    <th scope="col" class="m-3">Ca tập</th>
                    <th scope="col" class="m-3">Thời gian bắt đầu</th>
                    <th scope="col" class="m-3">Thời gian kết thúc</th>
                    <th scope="col" class="m-3">Trạng thái</th>
                    <th scope="col" class="m-3">Điểm danh</th>
                </tr>
            </thead>
            <tbody>
                @if(count($attendances) > 0)
                @foreach($attendances as $item)
                <tr>
                    <td class="text-center">{{ $item->id }}</td>
                    <td class="text-center">{{ $item->user->name}}</td>
                    <td class="text-center">{{ getdate(strtotime($item->date))['weekday'] }}<br>
                        <span style="color: #999999">{{ date('d-m-Y', strtotime($item->date)) }}</span>
                    </td>
                    <td class="text-center">{{$item->time->time_name}}</td>
                    <td class="text-center">{{$item->time->start_time}}</td>
                    <td class="text-center">{{$item->time->end_time}}</td>
                    <td class="view_status text-center">
                    @if($item->status == 0)
                        <span style="color: blue;"  class="label label-inline label-light-primary font-weight-bold"> 
                          Chưa điểm danh
                        </span>

                    @elseif($item->status == 1)
                      <span style="color: green;" class="label label-inline label-light-success font-weight-bold"> 
                        Đã điểm danh
                      </span>
                    @else
                          <span class="label label-inline font-weight-bold">
                           N/A
                          </span>
                    @endif
                    </td>
                    <td class="text-center">
                        <div class="form-check form-switch text-center" style="padding-left: 100px;">
                            <input @if(date('d-m-Y', strtotime($item->date)) != date('d-m-Y')) disabled @endif style="font-size: 23px" name="attendance[{{$item->id}}]" class="form-check-input" type="checkbox" @if($item->status == 1) checked @endif>
                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        <div>
        {{$attendances->appends(request()->input())->links()}}
    </div>
        <button @if(date('d-m-Y', strtotime($attendances[0]['date']))  != date('d-m-Y')) disabled @endif style="float: right" class="btn btn-primary">Lưu điểm danh</button>
    </form>
   
</div>

@endsection