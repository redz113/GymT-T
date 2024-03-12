@extends('layouts.frontend.account.account')
@section('content')
<div class="card-header bg-white border-0">
  <div class="row align-items-center">
    <div class="col-8">
      <h3 style="font-size: 20px; font-weight: 900" class="mb-0">Hãy cho chúng tôi biết về mức độ hài lòng của bạn</h3>
    </div>
    <div class="col-4 text-right">

      <a href="#!" class="btn btn-sm btn-primary">Settings</a>
    </div>
  </div>
</div>
<div class="card-body">
  <div class="input-group">
    <h3>ĐÁNH GIÁ GÓI TẬP</h3>
  </div>
  <div style="display: grid;grid-template-columns:1fr 1fr 1fr 1fr 1fr">
    @foreach(evaluate() as $key=>$item )
    <div style="margin-top: 10px" class="input-group">
      <div class="evaluate_package" val="{{$key}}" style="width:120px; background-color:yellow;cursor:pointer;text-align:center">
        <input hidden value="{{$key}}" type="radio" id="{{$key}}">
        <div style="margin-left: 10px">
          {{$item}}
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <br>
  <div class="form-group">
    <textarea placeholder="Ý kiến của bạn về gói tập này" id="note_pack" class="form-control" name="" id="" style="height: 120px;"></textarea>
  </div>


  <div class="input-group">
    <h3>ĐÁNH GIÁ HUẤN LUYỆN VIÊN</h3>
  </div>
  <div style="display: grid;grid-template-columns:1fr 1fr 1fr 1fr 1fr">
    @foreach(evaluate() as $key=>$item )
    <div style="margin-top: 10px" class="input-group">
      <div class="evaluate_pt" val="{{$key}}" style="width:120px; background-color:yellow;cursor:pointer;text-align:center">
        <input hidden value="{{$key}}" type="radio" id="{{$key}}">
        <div style="margin-left: 10px">
          {{$item}}
        </div>
      </div>

    </div>
    @endforeach
  </div>
  <br>
  <div class="form-group">
    <textarea placeholder="Ý kiến của bạn về huấn luyện viên" id="note_pt" class="form-control" name="" id="" style="height: 120px;"></textarea>
  </div>
  <button id="btn_evaluate" style="float: right" class="btn btn-primary">Lưu</button>
</div>

@endsection
@section('js')
<script>
  $(function() {
    var cls_pack = null;
    var cls_pt = null;
    $('#btn_evaluate').on('click', function() {

      var note_pack = $('#note_pack').val();
      var note_pt = $('#note_pt').val();


      if (cls_pack == null || cls_pt == null) {
        alert('Bạn cần đánh giá gói tập và huấn luyện viên trước khi gửi');
      } else {
        $.ajax({
          url: "{{route('rate.store')}}",
          method: 'post',
          data: {
            cls_pack: cls_pack,
            cls_pt: cls_pt,
            note_pack: note_pack,
            note_pt: note_pt,
            order_id: {{$id}},
          },
          success: function(res) {
            alert('Cảm ơn bạn đã đánh giá');
            window.location.replace("{{route('account.profile')}}");
          }
        })
      }


      console.log(cls_pack, cls_pt, note_pack, note_pt);
    })
    $('.evaluate_package').on('click', function() {
      $('.evaluate_package').css('border', '1px solid yellow');
      cls_pack = $(this).attr('val');
      $(this).css('border', '1px solid red');
    })

    $('.evaluate_pt').on('click', function() {
      $('.evaluate_pt').css('border', '1px solid yellow');
      cls_pt = $(this).attr('val');
      $(this).css('border', '1px solid red');
    })



  })
</script>
@endsection