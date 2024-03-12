@extends('layouts.frontend.master')
@section('content')
<div class="row" style="padding: 31px;">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title">Kết quả thanh toán</h1>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <h2 @if($returnData['RspCode'] == '00') style="color: green;" @else style="color: red;" @endif>{{$returnData['Message']}}</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <h5>Mã đơn hàng</h5>
                            <div class='input-group date' id='fxRate'>
                                <input type="text" disabled name="orderId" value="{{ $returnData['vnp_TxnRef'] }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <h5>Mã giao dịch</h5>
                            <div class='input-group date' id='fxRate'>
                                <input type="text" disabled name="transId" value="{{ $returnData['vnp_TxnRef'] }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <h5>Phương thức thanh toán</h5>
                            <div class='input-group date' id='fxRate'>
                                <input type="text" disabled name="orderType" value="VNPAY" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <h5>Thông tin giao dịch</h5>
                            <div class='input-group date' id='fxRate'>
                                <input type="text" disabled name="orderInfo" value="{{ $returnData['vnp_OrderInfo'] }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <h5>Mã giao dịch tại VNPAY</h5>
                            <div class='input-group date' id='fxRate'>
                                <input type="text" disabled name="orderInfo" value="{{ $returnData['vnp_ResponseCode'] }}" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <h5>Mã ngân hàng</h5>
                            <div class='input-group date' id='fxRate'>
                                <input type="text" disabled name="orderInfo" value="{{ $returnData['vnp_BankCode'] }}" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <h5>Số tiền giao dịch</h5>
                            <div class='input-group date' id='fxRate'>
                                <input type="text" disabled name="amount" value="{{ number_format($returnData['vnp_Amount']/100) }} VNĐ" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <a href="{{route('home')}}" class="btn btn-primary">Quay lại trang chủ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection