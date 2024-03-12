@extends('layouts.backend.master')
@section('title', 'Quản lý chỉ số BMI')
@section('content')

    <div>
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h3 class="card-label">Quản lý chỉ số BMI
                </div>
                <div class="card-toolbar">
                    <!--begin::Button-->
                    <a href="#" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                         height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle fill="#000000" cx="9" cy="15" r="6"/>
                            <path
                                d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z"
                                fill="#000000" opacity="0.3"/>
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>Danh sách người dùng</a>
                    <!--end::Button-->
                </div>
            </div>
            <form action="{{route('admin.user.updateBMI', $bmi->user_id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="card-body">
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Cân nặng ( kg )<span class="text-danger">*</span></label>
                        <div class="col-10">
                            <input class="form-control" name="weight" type="text"
                                   value="{{old('weight') ? old('weight') : $bmi->weight }}"/>
                            @error('weight')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Chiều cao ( cm )<span class="text-danger">*</span></label>
                        <div class="col-10">
                            <input class="form-control" name="height" type="text"
                                   value="{{old('height') ? old('height') : $bmi->height }}"/>
                            @error('height')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Chỉ số BMI</label>
                        <div class="col-10">
                            <input disabled class="form-control" type="text" name="bmi"
                                   value="{{ $bmi->bmi }}"/>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label class="col-2 col-form-label">Tình trạng sức khỏe</label>
                        <div class="col-10">
                            <input disabled class="form-control" name="health" type="text"
                            value="{{config('bmi.'.$bmi->health)}}"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-password-input" class="col-2 col-form-label"></label>
                        <div class="col-10">
                            <button type="submit" class="btn btn-success mr-2">Lưu</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(function (){
        function test_bmi(bmi){
            let health = 0;
            if(bmi<16){
                health ='Gầy độ III';
            }else if(bmi<17){
                health ='Gầy độ II';
            }else if(bmi<18.5){
                health ='Gầy độ I';
            }else if(bmi<25){
                health ='Bình thường';
            }else if(bmi<30){
                health ='Thừa cân';
            }else if(bmi<35){
                health ='Béo phì độ I';
            }else if(bmi<40){
                health ='Béo phì độ II';
            }else{
                health ='Béo phì độ III';
            }
            return health;
        }
        let weight = $("input[name = 'weight']").val() ? $("input[name = 'weight']").val() : 0;
        let height = $("input[name = 'height']").val() ? $("input[name = 'height']").val() : 0;
        let bmi = 0;
       $("input[name = 'weight']").on('change', function(){
           weight = $(this).val();
           if(weight !=0 && height!=0){
            bmi = (weight / ((height/100)*(height/100))).toFixed(1);
               $("input[name = 'bmi']").val(bmi);
               $("input[name = 'health']").val(test_bmi(bmi));
               console.log(bmi);
           }
       });
        $("input[name = 'height']").on('change', function(){
            height = $(this).val();
            if(weight !=0 && height!=0){
                bmi = (weight / ((height/100)*(height/100))).toFixed(1);
                $("input[name = 'bmi']").val(bmi);
                $("input[name = 'health']").val(test_bmi(bmi));
                console.log(bmi);
            }
        });
    })
</script>
@endsection


