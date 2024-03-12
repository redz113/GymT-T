@extends('layouts.backend.master')

@section('title', 'Quản lý người dùng')

@section('content')
<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            Thêm mới người dùng
        </h3>
    </div>
    <!--begin::Form-->
    <form action="{{route('admin.user.postUser')}}" method="POST">
        @csrf
        @method('POST')
        <div class="card-body">

            <div class="form-group row">
                <label class="col-2 col-form-label">Họ và tên </label>
                <div class="col-10">
                    <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" value="{{ old('name') }}" placeholder="Họ và tên" id="example-text-input" />
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="example-email-input" class="col-2 col-form-label">Email</label>
                <div class="col-10">
                    <input class="form-control @error('email') is-invalid @enderror" name="email" type="email" value="{{ old('email') }}" placeholder="Email" id="example-email-input" />
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="example-tel-input" class="col-2 col-form-label">Số điện thoại</label>
                <div class="col-10">
                    <input class="form-control @error('phone') is-invalid @enderror" name="phone" type="tel" value="{{ old('phone') }}" placeholder="Số điẹn thoại" id="example-tel-input" />
                    @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="example-tel-input" class="col-2 col-form-label">Mật khẩu</label>
                <div class="col-10">
                    <input class="form-control @error('password') is-invalid @enderror" name="password" type="password" value="{{ old('password') }}" placeholder="Mật khẩu"/>
                    @error('password')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label class="col-lg-2 col-form-label">Giới tính</label>
                <div class="col-xl-8 col-lg-8 col-sm-12 col-md-12 d-flex align-items-center">
                    <select class="form-control" name="gender">
                        <option value="1">Nam</option>
                        <option value="2">Nữ</option>
                    </select>
                    @error('gender')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 col-form-label">Địa chỉ</label>
                <div class="col-10">
                    <input class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" type="text" placeholder="Địa chỉ" id="example-text-input" />
                    @error('address')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-2 col-form-label">Vai trò</label>
                <div class="col-lg-4 col-md-9 col-sm-12">
                    <select onchange="checkCoach()" id="check-role" name="role"  class="form-control">
                        @foreach ($roles as $role)
                        <option value="{{$role->name}}">{{$role->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div id="wage-coach" class="form-group row">
                
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-2">
                    </div>
                    <div class="col-10">
                        <button type="submit" class="btn btn-success mr-2">Lưu</button>
                        {{-- <button type="reset" class="btn btn-secondary">Đặt lại</button> --}}
                    </div>
                </div>
            </div>
    </form>
</div>

@endsection

@section('script')
    <script>
        function checkCoach(){
            var role = $('#check-role').val();
            console.log(role);
            if(role == 'coach'){
                $("#wage-coach").html(`<label class="col-2 col-form-label">Lương trên 1 ca</label>
                <div class="col-lg-4 col-md-9 col-sm-12">
                    <input class="form-control @error('wage') is-invalid @enderror" name="wage" value="{{ old('wage') }}" type="text" placeholder="" id="example-text-input" />
                </div>`);
            }
            else{
                $("#wage-coach").html(``);
            }
        }
        

    </script>
@endsection