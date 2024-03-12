<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Package;
use App\Models\Time;
use App\Models\User;
use App\Models\Weekday;
use Exception;
use Illuminate\Support\Facades\Cookie;
use PDF;
class OrderController extends Controller
{


    public function setPackage(Request $request){
        $package = Package::find($request->id);
        if(isset($package)){
            if($package->set_pt == 1){
                return response()->json([
                    'result' => 1,
                    'package' => $package,
                    
                ]);
            }
            else{
                return response()->json([
                    'result' => 0,
                    'package' => $package,
                ]);
            }
            
        }
        return response()->json([
            'result' => false,
            'message' => 'Gói tập không tồn tại !'
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // dd($request->payment_method);
        $order = new Order();
        // dd($request->discount_code);
        $user = User::find($request->user_id);
        $package = Package::find($request->package_id);
        if($package->set_pt == 1){
            $rule = [
                'time_id' => 'required',
                'pt_id' =>'required',
                'weekday_name' =>'required',
            ];
            $messages = [
                'required' => ':attribute không được để chống',
            ];
            $request->validate($rule,$messages);
            $order->fill($request->all());
            $order->weekday_name = implode("|",$request->weekday_name);
        }
        elseif($package->set_pt == 0){
            $order->package_id = $request->package_id;
            $order->activate_day = $request->activate_day;
            $order->payment_method = $request->payment_method;
        }
        
        if($request->discount_code != ""){
            $discount = Discount::where('discount_code', '=' , $request->discount_code)->first();
            if(isset($discount)){
                $discount_packages =  explode('|', $discount->package_id);
                if($discount->status == 0){
                    return back()->with('msg', 'Xin lỗi. Phiếu giảm giá này đã hết hạn'); 
                }
                if(in_array($package->id, $discount_packages)){
                    $order->total_money = $package->price - $package->price*$discount->price_sale/100;
                    // dd($package->price);
                    $order->discount_id = $discount->id;
                    $quantity_discount = $discount->quantity - 1;
                    $discount->update([
                        'quantity' => $quantity_discount,
                    ]);
                    if($discount->quantity == 0){
                        $discount->update([
                            'status' => 0,
                        ]);
                    }
                    $order->save();
                    $order->users()->attach($request->user_id);
                    // dd($request->payment_method == 2);
                    if($request->payment_method == 2){
                        // dd(123);
                        $vnp_Url = $this->momoPayment($order->id); 
                        return redirect($vnp_Url);
                    }
                    
                    return back()->with('success', 'Thêm Order thành công'); 
                }
                else{
                    return back()->with('msg', 'Phiếu giảm giá không đúng'); 
                }
                
            }
            else{
                return back()->with('msg', 'Phiếu giảm giá không đúng'); 
            }
        }

        $order->discount_id = 0;
        $order->total_money = $package->price;
        $order->save();
        $order->users()->attach($request->user_id);
        if($request->payment_method == 2){
            // dd(123);
            $vnp_Url = $this->momoPayment($order->id); 
            return redirect($vnp_Url);
        }
        return back()->with('success', 'Thêm order thành công');
    }

    public function momoPayment($orderId){
        // dd($request->id);
        $order=Order::find($orderId);
        session(['cost_id' => 5]);
        session(['url_prev' => url()->previous()]);
        $vnp_TmnCode = "UDOPNWS1"; //Mã website tại VNPAY 
        $vnp_HashSecret = "EBAHADUGCOEWYXCMYZRMTMLSHGKNRPBN"; //Chuỗi bí mật
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/admin/order/checkPayment";
        $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $order->total_money * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $orderId,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
           $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        return $vnp_Url;
        return response()->json([
            'status'=>404,
            'vnp' => $inputData
        ]);
        // return redirect($vnp_Url);
    }

}
