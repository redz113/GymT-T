@extends('layouts.frontend.account.account')
@section('content')
<div class="card-header bg-white border-0">
    <div class="row align-items-center">
      <div class="col-8">
        <h3 style="font-size: 20px; font-weight: 900" class="mb-0">Kết quả gói tập của tôi</h3>
      </div>
      <div class="col-8 text-left">
        @if($result->status_package == 1)
        <h3 style="margin-top: 10px">Trạng thái: Đã hoàn thành</h3>
        @elseif($result->status_package == 0)
        <h3 style="margin-top: 10px">Trạng thái: Chưa hoàn thành</h3>
        @endif
      </div>
      <div class="col-4 text-right">
        {{-- <a href="#!" class="btn btn-sm btn-primary">Settings</a>  --}}
      </div>
    </div>
</div>
<div class="card-body"> 
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Thông số</th>
            <th scope="col">Kết quả của bạn</th>

          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Chiều cao</td>
            <td>{{$result->height}} (cm)</td>
          </tr>
          <tr>
            <td>Cân nặng</td>
            <td>{{$result->weight}} (kg)</td>
          </tr>
          <tr>
            <td>Chỉ số BMI</td>
            <td>{{$result->bmi}}</td>
          </tr>
          <tr>
            <td>Đánh gái chung</td>
            <td>{{$result->comment}}</td>
          </tr>
        </tbody>
    </table>

    {{-- <div>
        <h3>Nhận xét của PT</h3>
    </div> --}}
</div>
     
@endsection