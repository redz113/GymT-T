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
                                <span class="label label-inline {{$item->status == 1 ? 'label-light-success': 'label-light-danger'}} font-weight-bold">{{config('status_schedule.'.$item->status)}}</span>

                        </td>
                        <td class="text-center">
                            {{-- <div class="update_attendance" data-url="{{'admin.attendance.editStatus'}}" data-id="{{$item->id}}" style="cursor: pointer;">
                                <i style="font-size: 20px; " class="ki ki-reload text-warning"></i>
                            </div> --}}
                            <div class="form-check form-switch text-center" style="padding-left: 100px;">
                                <input disabled style="font-size: 23px" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                            </div>
                            
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table> 
    <button style="float: right" type="button" class="btn btn-primary">Lưu điểm danh</button>
    <div>
        {{$attendances->appends(request()->input())->links()}}
    </div>
</div>
     
@endsection