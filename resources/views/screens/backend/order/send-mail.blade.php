@extends('layouts.backend.master')

@section('title', 'Gửi mail hỗ trợ')

@section('content')

<div>
    <div class="card card-custom">
        <div class="card-header">
         <h3 class="card-title">
          Gửi mail Support Order
         </h3>
         <div class="card-toolbar">
          <div class="example-tools justify-content-center">
           <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
           <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
          </div>
         </div>
        </div>
        <!--begin::Form-->
        <form action="{{route('admin.order.postSendMail', $order)}}" method="POST">
            @csrf
         <div class="card-body">
          <div class="form-group mb-8">
           <div class="alert alert-custom alert-default" role="alert">
            <div class="alert-icon"></div>
            <div class="alert-text">
                Gửi mail đến tài khoản 
            </div>
           </div>
          </div>
          <div class="form-group">
           <label>Tiêu đề</label>
           <input type="text" name="title" class="form-control" value="{{$title}}" placeholder="Tiêu đề"/>
          </div>
          
          <div class="form-group mb-1">
           <label for="exampleTextarea">Nội dung gửi mail</label>
           <textarea class="form-control" name="content" value="{{$content}}" placeholder="Nội dung" id="exampleTextarea" rows="3"></textarea>
          </div>
         </div>
         <div class="card-footer">
          <button type="submit" class="btn btn-primary mr-2">Gửi mail</button>

         </div>
        </form>
        <!--end::Form-->
       </div>
</div>
   
    
@endsection

@section('script')




@endsection