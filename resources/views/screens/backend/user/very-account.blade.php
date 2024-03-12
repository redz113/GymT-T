@extends('layouts.backend.master')

@section('title', 'Quản lý người dùng')

@section('content')
<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            Vui lòng kiểm tra email và nhập mã xác minh tài khoản
        </h3>
    </div>

    <div class="card-body">
        @include('screens.backend._alert')
    </div>

    <!--begin::Form-->
    <form action="{{route('admin.user.postVeryAccount', $user)}}" method="POST">
        @csrf
        @method('POST')
        <div class="card-body">

            <div class="form-group row">
                <label class="col-2 col-form-label">Nhập mã</label>
                <div class="col-10">
                    <input class="form-control @error('code') is-invalid @enderror" name="code" type="text" value="{{ old('code') }}" placeholder="mã code" id="example-text-input" />
                    @error('code')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
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
