@extends('layouts.frontend.account.account')
@section('content')
<div class="card-header bg-white border-0">
  <div class="row align-items-center">
    <div class="col-8">
      <h3 style="font-size: 20px; font-weight: 900" class="mb-0">Đánh giá kết quả cuối môn</h3>
      <p>Nay là ngày cuối khoá tập. Huấn luyện viên đánh giá kết quả cuối môn cho hội viên trước khi xem lịch tập</p>
    </div>
    <div class="col-4 text-right">
      {{-- <a href="#!" class="btn btn-sm btn-primary">Settings</a>  --}}
    </div>
  </div>
</div>
<div class="card-body">

  <form action="{{route('accountPt.postEvaluateMember', $result)}}" method="POST">

    @csrf
    <!--  <h6 class="heading-small text-muted mb-4">User information</h6> -->
    <div class="pl-lg-4">
      @if(session()->has('error'))
      <div class="row">
        <span class="text-danger">{{session()->get('error')}}</span>
      </div>
      @endif
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group focused">
            <label class="form-control-label" for="input-username">Cân nặng (kg)</label>
            <input type="number" id="input-username" class="form-control form-control-alternative" name="weight" value="{{old('weight') ? old('weight') : $result->weight }}">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group focused">
            <label class="form-control-label" for="input-last-name">Chiều cao ( cm )</label>
            <input type="number" id="input-last-name" class="form-control form-control-alternative" name="height" value="{{old('height') ? old('height') : $result->height }}">
          </div>
        </div>

      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label" for="input-email">Chỉ số BMI</label>
            <input type="email" id="input-email" disabled class="form-control form-control-alternative" name="bmi" value="{{old('bmi') ? old('bmi') : $result->bmi }}">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="form-group focused">
            <label class="form-control-label" for="input-first-name">Tình trạng sức khỏe</label>
            <input type="text" id="input-first-name" disabled class="form-control form-control-alternative" name="health" value="{{old('health') ? old('health') : $result->comment }}">
          </div>
        </div>

      </div>
    </div>
    <hr class="my-4">
    <!-- Address -->
    <!-- <h6 class="heading-small text-muted mb-4">Contact information</h6>
    <div class="pl-lg-4">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group focused">
            <label class="form-control-label" for="input-address">Address</label>
            <input id="input-address" class="form-control form-control-alternative" placeholder="Home Address" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09" type="text">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4">
          <div class="form-group focused">
            <label class="form-control-label" for="input-city">City</label>
            <input type="text" id="input-city" class="form-control form-control-alternative" placeholder="City" value="New York">
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group focused">
            <label class="form-control-label" for="input-country">Country</label>
            <input type="text" id="input-country" class="form-control form-control-alternative" placeholder="Country" value="United States">
          </div>
        </div>
        <div class="col-lg-4">
          <div class="form-group">
            <label class="form-control-label" for="input-country">Postal code</label>
            <input type="number" id="input-postal-code" class="form-control form-control-alternative" placeholder="Postal code">
          </div>
        </div>
      </div>
    </div>
    <hr class="my-4"> -->
    <!-- Description -->
    <!-- <h6 class="heading-small text-muted mb-4">About me</h6>
    <div class="pl-lg-4">
      <div class="form-group focused">
        <label>About Me</label>
        <textarea rows="4" class="form-control form-control-alternative" placeholder="A few words about you ...">A beautiful Dashboard for Bootstrap 4. It is Free and Open Source.</textarea>
      </div>
    </div> -->
    <button style="float: right" class="btn btn-primary">Lưu</button>
  </form>
</div>

@endsection

@section('js')
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