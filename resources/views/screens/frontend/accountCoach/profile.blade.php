@extends('layouts.frontend.account.account')
@section('content')
<div class="card-header bg-white border-0">
  <div class="row align-items-center">
    <div class="col-8">
      <h3 style="font-size: 20px; font-weight: 900" class="mb-0">Thông tin cá nhân</h3>
    </div>
  </div>
</div>
<div class="card-body">
  <form action="{{route('account.saveProfile')}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="pl-lg-4">
      @if(session()->has('error'))
      <div class="alert" style="background-color: #f44336;">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong>Error!</strong> {{session()->get('error')}}
      </div>
      @endif
      @if(session()->has('success'))
      <div class="alert" style="background-color: green;">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <strong>Success!</strong> {{session()->get('success')}}
      </div>
      @endif
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group focused">
            <label class="form-control-label" for="input-username">Ảnh đại diện</label>
            <input type="file" id="input-username" class="form-control form-control-alternative" name="avatar" value="{{Auth::user()->name}}">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group focused">
            <label class="form-control-label" for="input-username">Họ và tên</label>
            <input type="text" id="input-username" class="form-control form-control-alternative" name="name" value="{{Auth::user()->name}}">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group focused">
            <label class="form-control-label" for="input-last-name">Địa chỉ</label>
            <input type="text" id="input-last-name" class="form-control form-control-alternative" name="address" value="{{Auth::user()->address}}">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label" for="input-email">Email</label>
            <input type="email" id="input-email" class="form-control form-control-alternative" name="email" value="{{Auth::user()->email}}">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group focused">
            <label class="form-control-label" for="input-first-name">Số điện thoại</label>
            <input type="text" id="input-first-name" class="form-control form-control-alternative" name="phone" value="{{Auth::user()->phone}}">
          </div>
        </div>
      </div>
    </div>
    <hr class="my-4">
    <button style="float: right" class="btn btn-primary">Lưu</button>
  </form>
</div>
@endsection
@section('js')
<script>
  $(function() {
    $("input[name = 'avatar']").on('change', function(e) {
      e.preventDefault();
      var input = e.target;
      var reader = new FileReader();
      reader.onload = function() {
        var dataURL = reader.result;
        var output = $('#avatar').attr('src', dataURL);
      }
      reader.readAsDataURL(input.files[0]);
    })
  });
</script>
@endsection