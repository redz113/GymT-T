<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Attendance;
use App\Models\Contract;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Package;
use App\Models\ResultContract;
use App\Models\Schedule;
use App\Models\Time;
use App\Models\User;
use App\Models\Weekday;
use DateInterval;
use DatePeriod;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index($id)
    {
        $users = User::role('member')->get();
        $times = Time::all();
        $coachs = User::role('coach')->get();
        $weekdays = Weekday::all();
        $package = Package::find($id);
        return view('screens.frontend.payment.index',  ['users' => $users, 'package' => $package, 'times' => $times, 'coachs' => $coachs, 'weekdays' => $weekdays]);
    }

    public function setPackage(Request $request)
    {
        $package = Package::find($request->id);
        if (isset($package)) {
            if ($package->set_pt == 1) {
                return response()->json([
                    'result' => 1,
                    'package' => $package,

                ]);
            } else {
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

    public function setCoach(Request $request)
    {
        $package = Package::find($request->id);

        if ($package->set_pt == 1) {
            return response()->json([
                'result' => true,
                'package' => $package,

            ]);
        }
        return response()->json([
            'result' => false,
            'message' => 'Gói tập không có huấn luyện viên !'
        ]);
    }

    public function setTotalMoney(Request $request)
    {
        $package = Package::find($request->package_id);
        $discount = Discount::where('discount_code', '=', $request->discount_code)->first();
        if (isset($discount)) {
            $discount_packages =  explode('|', $discount->package_id);

            if ($discount->status == 0) {
                return response()->json([
                    'result' => false,
                    'message' => 'Phiếu giảm giá này đã hết hạn'
                ]);
            }
            if (in_array($package->id, $discount_packages)) {

                return response()->json([
                    'result' => true,
                    'message' => 'Phiếu giảm tồn tại',
                    'total_money' => $package->price - $package->price * $discount->price_sale / 100,
                ]);
            }
        } else {
            return response()->json([
                'result' => false,
                'message' => 'Phiếu giảm giá không tồn tại',
            ]);
        }
    }



    public function store($id, Request $request)
    {
        // dd(Auth::id());
        // dd($request->payment_method);
        $order = new Order();
        // dd($request->discount_code);
        $user = User::find(Auth::id());
        $package = Package::find($id);
        if ($package->set_pt == 1) {
            $rule = [
                'time_id' => 'required',
                'pt_id' => 'required',
                'weekday_name' => 'required',
            ];
            $messages = [
                'required' => ':attribute không được để chống',
            ];
            $request->validate($rule, $messages);
            $order->fill($request->all());
            $order->package_id = $id;
            $order->payment_method = 2;
            $order->weekday_name = implode("|", $request->weekday_name);
        } elseif ($package->set_pt == 0) {
            $order->package_id = $id;
            $order->activate_day = $request->activate_day;
            $order->payment_method = 2;
        }

        if ($request->discount_code != "") {
            $discount = Discount::where('discount_code', '=', $request->discount_code)->first();
            if (isset($discount)) {
                $discount_packages =  explode('|', $discount->package_id);
                if ($discount->status == 0) {
                    return back()->with('msg', 'Xin lỗi. Phiếu giảm giá này đã hết hạn');
                }
                if (in_array($package->id, $discount_packages)) {
                    $order->total_money = $package->price - $package->price * $discount->price_sale / 100;
                    // dd($package->price);
                    $order->discount_id = $discount->id;
                    $quantity_discount = $discount->quantity - 1;
                    $discount->update([
                        'quantity' => $quantity_discount,
                    ]);
                    if ($discount->quantity == 0) {
                        $discount->update([
                            'status' => 0,
                        ]);
                    }
                    $order->save();
                    $order->users()->attach(Auth::id());

                    // dd($order->id);
                    dd($order->id);
                    $vnp_Url = $this->vpnPayment($order->id);
                    $this->create($order->id);
                    return redirect($vnp_Url);
                    // dd($request->payment_method == 2);
                    // if($request->payment_method == 2){
                    //     // dd(123);
                    //     $this->create($order->id);
                    //     $vnp_Url = $this->vpnPayment($order->id); 
                    //     return redirect($vnp_Url);
                    // }

                    return back()->with('success', 'Thêm Order thành công');
                } else {
                    return back()->with('msg', 'Phiếu giảm giá không đúng');
                }
            } else {
                return back()->with('msg', 'Phiếu giảm giá không đúng');
            }
        }

        $order->discount_id = 0;
        $order->total_money = $package->price;
        $order->save();

        $order->users()->attach(Auth::id());

        // dd(123);

        $vnp_Url = $this->momoPayment($order->id);
        // $this->create($order->id);
        return redirect($vnp_Url);

        return back()->with('success', 'Thêm order thành công');
    }

    public function vpnPayment($orderId)
    {
        // dd($request->id);
        $order = Order::find($orderId);
        session(['cost_id' => 5]);
        session(['url_prev' => url()->previous()]);
        $vnp_TmnCode = "UDOPNWS1"; //Mã website tại VNPAY 
        $vnp_HashSecret = "EBAHADUGCOEWYXCMYZRMTMLSHGKNRPBN"; //Chuỗi bí mật
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/payment/checkPayment";
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
        // return redirect($vnp_Url);
    }

    function returnUrl()
    {
        dd(123);
        $vnp_HashSecret = "EBAHADUGCOEWYXCMYZRMTMLSHGKNRPBN";   //Chuỗi bí mật
        $inputData = array();
        $returnData = array();

        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }
        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }
        // dd($inputData);
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        $vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
        $vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
        $vnp_Amount = $inputData['vnp_Amount'] / 100; // Số tiền thanh toán VNPAY phản hồi
        $Status = 0; // Là trạng thái thanh toán của giao dịch chưa có IPN lưu tại hệ thống của merchant chiều khởi tạo URL thanh toán.
        $orderId = $inputData['vnp_TxnRef'];

        try {
            //Check Orderid
            //Kiểm tra checksum của dữ liệu
            $order = Order::find($orderId);
            // dd($order);
            // dd($secureHash == $vnp_SecureHash);
            // if ($secureHash == $vnp_SecureHash) {
            if ($order != NULL) {
                dd($order->id);
                if ($order->status_contract == 0) {
                    if (
                        $inputData['vnp_ResponseCode'] == '00'
                        // && $inputData['vnp_TransactionStatus'] == '00'
                    ) {
                        $order->status_contract = 1;
                        $order->save();
                        dd($order->id);
                        $this->create($order->id);
                        $returnData['RspCode'] = '00';
                        $returnData['Message'] = 'Giao dịch thành công';
                    } else {
                        $returnData['RspCode'] = '24';
                        $returnData['Message'] = 'Giao dịch không thành công do: Khách hàng hủy giao dịch';
                        $order->status_contract = 0;
                        $order->save();
                    }
                    // dd($order);


                } else {
                    $returnData['RspCode'] = '02';
                    $returnData['Message'] = 'Giao dịch thất bại';
                }
            } else {
                $returnData['RspCode'] = '01';
                $returnData['Message'] = 'Đơn hàng không tồn tại';
            }
            // }
            //  else {
            //     $returnData['RspCode'] = '97';
            //     $returnData['Message'] = 'Chữ ký không hợp lệ';
            // }
        } catch (Exception $e) {
            $returnData['RspCode'] = '99';
            $returnData['Message'] = 'Unknow error';
        }
        //Trả lại VNPAY theo định dạng JSON

        return view('screens.backend.order.payment', compact('returnData'));
    }

    public function create($id)
    {
        $order = Order::find($id);
        $contract = new Contract();
        $attendance = new Attendance();
        $schedule = new Schedule();

        $month = $order->package->month_package;
        $newdate = strtotime('+' . $month . ' month', strtotime($order->activate_day));
        $end_date = date('Y-m-j', $newdate);

        $contract->package_id = $order->package->id;
        if (isset($order->pt_id)) {
            $contract->pt_id = $order->pt_id;
            $contract->weekday_name = $order->weekday_name;
        }
        $contract->activate_date = $order->activate_day;
        $contract->order_id = $order->id;
        $contract->start_date = $order->activate_day;
        $contract->end_date = $end_date;

        $contract->save();
        $user_contract = $order->users->pluck('id')->toArray();
        // dd($user_contract);
        foreach ($user_contract as $key => $user_id) {
            $result_contract = ResultContract::where('user_id', '=', $user_id)
                ->Where('order_id', '=', $order->id)->first();
            $result_contract->update([
                'contract_id' => $contract->id,
            ]);
        }

        $begin = new DateTime($contract->start_date);
        $end = new DateTime($contract->end_date);

        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);
        $weekdays = Weekday::all();
        $weekday_contract = $contract->weekday_name;
        $weekdays_pt =  explode('|', $weekday_contract);

        $order->status_contract = 1;
        $order->save();

        // tạo lịch trình pt và điểm danh hội viên
        foreach ($period as $dt) {
            // echo $dt->format("l Y-m-d \n");
            // echo "<br>";
            // dd($dt->format("l"));

            $attendance->date = $dt->format("Y-m-d");
            foreach ($weekdays_pt as $key => $weekday_name) {

                if ($weekday_name ==  $dt->format("l")) {
                    $schedule = $schedule->create([
                        'pt_id' => $contract->pt_id,
                        'contract_id' => $contract->id,
                        'time_id' => $contract->order->time_id,
                        'weekday_name' => $dt->format("l"),
                        'date' => $dt->format("Y-m-d"),
                        'status' => 1,
                    ]);
                    foreach ($user_contract as $key => $user_id) {

                        $attendance->create([
                            'user_id' => $user_id,
                            'contract_id' => $contract->id,
                            'schedule_id' =>  $schedule->id,
                            'time_id' => $contract->order->time_id,
                            'weekday_name' => $dt->format("l"),
                            'pt_id' => 1,
                            'date' => $dt->format("Y-m-d"),
                            'status' => 0,

                        ]);
                    }
                }
            }
        }

        // return back();

    }


    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    //MOMO
    public function momoPayment($order_Id)
    {
        $order = Order::where('id', $order_Id)->first();
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = 'MOMOBQRE20220907';
        $accessKey = 'K5KI6gT11qQOvSNb';
        $secretKey = 'LeKe8s0zVfMBSiOUzyWA3VGtmJsTSC3e';
        $orderInfo = "Đăng ký gói tập";
        $amount = $order->total_money;
        $orderId = $order->id . '';
        $redirectUrl = route('ipn');
        $ipnUrl = route('ipn');
        $extraData = "";

        $requestId = time() . "";
        $requestType = "captureWallet";
        $extraData = ("");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));

        $jsonResult = json_decode($result, true);  // decode json
        //Just a example, please check more in there
        if (isset($jsonResult['payUrl'])) {
            header('Location: ' . $jsonResult['payUrl']);
            die();
        } else {
            echo json_encode($jsonResult);
        }
    }

    public function resetPayment($order)
    {
        $new_order = new Order();
        $new_order->discount_id = $order->discount_id;
        $new_order->package_id = $order->package_id;
        $new_order->date_start = $order->date_start;
        $new_order->date_end = $order->date_end;
        $new_order->pt_id = $order->pt_id;
        $new_order->total_money = $order->total_money;
        $new_order->payment_method = $order->payment_method;
        $new_order->status = $order->status;
        $new_order->save();
    }
    public function ipn(Request $request)
    {
        $accessKey = 'K5KI6gT11qQOvSNb';
        $secretKey = 'LeKe8s0zVfMBSiOUzyWA3VGtmJsTSC3e';
        $response = array();
        try {
            $partnerCode = $_GET["partnerCode"];
            $orderId = $_GET["orderId"];
            $requestId = $_GET["requestId"];
            $amount = $_GET["amount"];
            $orderInfo = $_GET["orderInfo"];
            $orderType = $_GET["orderType"];
            $transId = $_GET["transId"];
            $resultCode = $_GET["resultCode"];
            $message = $_GET["message"];
            $payType = $_GET["payType"];
            $responseTime = $_GET["responseTime"];
            $extraData = $_GET["extraData"];
            $m2signature = $_GET["signature"]; //MoMo signature\
            //Checksum
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&message=" . $message . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo .
                "&orderType=" . $orderType . "&partnerCode=" . $partnerCode . "&payType=" . $payType . "&requestId=" . $requestId . "&responseTime=" . $responseTime .
                "&resultCode=" . $resultCode . "&transId=" . $transId;

            $partnerSignature = hash_hmac("sha256", $rawHash, $secretKey);
            $order = Order::where('id', $orderId)->first();
            if ($m2signature == $partnerSignature) {

                if ($resultCode == '0') {
                    $result = 'Giao dịch thành công';
                    if ($order != null) {
                        $order->status = 1;
                        $order->save();
                    }
                } else {
                    if ($order != null) {
                        $this->resetPayment($order);
                        $order->delete();
                    }
                    $result =  $message;
                }
            } else {
                if ($order != null) {
                    $this->resetPayment($order);
                    $order->delete();
                }
                $result = 'Giao dịch bị nghi ngờ. Vui lòng check lại giao dịch';
            }
        } catch (Exception $e) {
            echo $response['message'] = $e;
        }

        $debugger = array();
        $debugger['rawData'] = $rawHash;
        $debugger['momoSignature'] = $m2signature;
        $debugger['partnerSignature'] = $partnerSignature;

        if ($m2signature == $partnerSignature) {
            $response['message'] = "Nhận kết quả thanh toán thành công";
        } else {
            $response['message'] = "LỖI ! Tổng kiểm tra thất bại";
        }
        $response['debugger'] = $debugger;

        return view('screens.frontend.payment.resultPayment', compact('result', 'orderId', 'transId', 'orderInfo', 'orderType', 'resultCode', 'amount'));
    }
}
