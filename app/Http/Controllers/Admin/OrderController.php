<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Utility\PackageUtility;
use App\Mail\SendMailSupportOrder;
use App\Models\Contract;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Package;
use App\Models\Time;
use App\Models\User;
use App\Models\Weekday;
use App\Models\Attendance;
use App\Models\Schedule;
use App\Models\ResultContract;
use App\Models\TrainingPackage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use PDF;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function createSimple(){
        $users = User::role('member')->get();
        $packages = Package::where('set_pt', '=', 0)->where('type_package', '=', 2)->get();

        return view('screens.backend.order.create-simple', ['users' => $users, 'packages' => $packages]);
    }

    public function createComplex(){
        $arrayWeekdays = PackageUtility::$arrayWeekday;
        $users = User::role('member')->get();
        // dd($users);
        $packages = Package::where('set_pt', '=', 1)->where('type_package', '=', 1)->get();
        $times = Time::all();
        $coachs = User::role('coach')->get();
        $weekdays = Weekday::all();
        return view('screens.backend.order.create-complex', ['arrayWeekdays' => $arrayWeekdays,'users' => $users, 'packages' => $packages, 'times' => $times, 'coachs' => $coachs, 'weekdays' => $weekdays]);
    }



    public function add(){
        $users = User::role('member')->get();
        $packages = Package::all();
        $times = Time::all();
        $coachs = User::role('coach')->get();
        $weekdays = Weekday::all();
        return view('screens.backend.order.test', ['users' => $users, 'packages' => $packages, 'times' => $times, 'coachs' => $coachs, 'weekdays' => $weekdays]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = new Order();
        if($request->orderBy){
            $orders = $orders->orderBy('created_at',$request->orderBy);
        }
        if(isset($request->status)){
            $orders = $orders->where('status', $request->status);
        }
        // $orders = Order::select('order.*');
        // // if(isset($request->key)){
        // //     $orders = $orders->where('package_name', 'like', '%' . $request->keyword . '%')
        // //                     ->paginate(12);
        // // }
        $orders = $orders->paginate(12);
        return view('screens.backend.order.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::role('member')->get();
        $packages = Package::all();
        $times = Time::all();
        $coachs = User::role('coach')->get();
        $weekdays = Weekday::all();
        return view('screens.backend.order.create', ['users' => $users, 'packages' => $packages, 'times' => $times, 'coachs' => $coachs, 'weekdays' => $weekdays]);
    }


    public function setPackage(Request $request){
        // dd($request);
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

    public function setMember(Request $request){
        $user = User::find($request->userId);
        return response()->json([
            'result' => true,
            'user' => $user,
            
        ]);
    }

    public function setCoach(Request $request){
        $package = Package::find($request->id);
        
        if($package->set_pt == 1){
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

    public function setTotalMoney(Request $request){
        $package = Package::find($request->package_id);
        $discount = Discount::where('discount_code', '=' , $request->discount_code)->first();
        if(isset($discount)){
            $discount_packages =  explode('|', $discount->package_id);
            
            if($discount->status == 0){
                return response()->json([
                    'result' => false,
                    'message' => 'Phiếu giảm giá này đã hết hạn'
                ]);
            }
            if(in_array($package->id, $discount_packages)){
                
                return response()->json([
                    'result' => true,
                    'message' => 'Áp dụng phiếu giảm giá thành công',
                    'total_money' => $package->into_price - $package->into_price*$discount->price_sale/100,
                ]);

            }
        }
        else{
            return response()->json([
                'result' => false,
                'message' => 'Phiếu giảm giá không tồn tại',
                'total_money' => $package->into_price
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {   
        // dd($request->all());
        // dd($request->payment_method);
        $order = new Order();
        
        $package = Package::find($request->package_id);
        // dd($package->type_package);  
        if($package->type_package == 1){
            $rule = [
                'weekday' =>'required',
                'pt_id' =>'required',
            ];
            $messages = [
                'required' => ':attribute không được để chống',
            ];
            $request->validate($rule,$messages);
            if(count($request->weekday) != $package->week_session_pt){
                return back()->with('msg',"bạn phải chọn $package->week_session_pt buổi tập trên tuần");
            }
            $total_session_pt = $package->total_session_pt;
            $week_session_pt = $package->week_session_pt;
            $total_session = $total_session_pt/$week_session_pt*7;
            // dd($total_session);
            $newdate = strtotime ( '+'.$total_session.'day' , strtotime ( $request->activate_date ) ) ;
            $end_date = date ( 'Y-m-j' , $newdate );
            $order->date_start = $request->activate_date;
            $order->date_end = $end_date;
            
        }

        elseif($package->type_package == 2) {
            $rule = [
                'month_package' => 'required',
            ];
            $messages = [
                'required' => ':attribute không được để chống',
            ];
            $request->validate($rule,$messages);
            if(isset($request->month_package)){
                $month = $request->month_package;
                $newdate = strtotime ( '+'.$month.' month' , strtotime ( $request->activate_date ) );
                $end_date = date ( 'Y-m-j' , $newdate );
                $order->date_start = $request->activate_date;
                $order->date_end = $end_date;
            }
        }
        
        $order->package_id = $request->package_id;
        $order->payment_method = 2;
        if($package->set_pt == 1){
            $order->pt_id = $request->pt_id;
            
        }

        if($request->discount_code != ""){
            $discount = Discount::where('discount_code', '=' , $request->discount_code)->first();
            if(isset($discount)){
                $discount_packages =  explode('|', $discount->package_id);
                if($discount->status == 0){
                    return back()->with('msg', 'Xin lỗi. Phiếu giảm giá này đã hết hạn'); 
                }
                if(in_array($package->id, $discount_packages)){
                    $order->total_money = $package->into_price - $package->into_price*$discount->price_sale/100;
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
                }
                else{
                    return back()->with('msg', 'Phiếu giảm giá không đúng'); 
                }
                
            }
            else{
                return back()->with('msg', 'Phiếu giảm giá không đúng'); 
            }
        }
        else{
            $order->discount_id = 0;
            $order->total_money = $package->into_price;
        }
        
        
        $order->save();
        if($package->set_pt == 1){
            foreach ($request->weekday as $key => $value) {
                TrainingPackage::create([
                    'order_id' => $order->id,
                    'weekday_id' => $key,
                    'time_id' => $value
                ]);
            }
            
        }
        $order->users()->attach($request->user_id);
        if($package->set_pt == 1 && $package->type_package == 1){
            $this->createSchedule($order->id, $request->user_id);
            
        }
        else{
            $order->status = 1;
            $order->save();
        }
        
        
        return back()->with('success', 'Thêm order thành công');
    }


    function createSchedule($orderId, $userId){
        $order = Order::find($orderId);
        $contract = new Contract();
        $attendance = new Attendance();
        $schedule = new Schedule();
        $arrayWeekdays = PackageUtility::$arrayWeekday;
        $trainings = $order->trainings;
        // $weekday 

        $begin = new DateTime($order->date_start);
        $end = new DateTime($order->date_end);
        $interval = DateInterval::createFromDateString('1 day');
        $period = new DatePeriod($begin, $interval, $end);
        
        foreach ($period as $dt) {
            
            foreach($trainings as $training){
                // dd($training->id);
                if($arrayWeekdays[$training->weekday_id] == $dt->format("l")){
                    $schedule = $schedule->create([
                        'pt_id' => $order->pt_id,
                        'order_id' => $order->id,
                        'time_id' => $training->time_id,
                        'weekday_name' => $dt->format("l"),
                        'date' => $dt->format("Y-m-d"),
                        'status' => 0,
                    ]);

                        //  dd('for');               
                    $attendance->create([
                        'user_id' => $userId,
                        'order_id' => $order->id,
                        'schedule_id' =>  $schedule->id,
                        'time_id' => $training->time_id,
                        'weekday_name' => $dt->format("l"),
                        'pt_id' => $order->pt_id,
                        'date' => $dt->format("Y-m-d"),
                        'status' => 0,
                        
                    ]);
                    
                }

            }
        }
        // dd('status');
        $order->status = 1;
        $order->save();
    }


    // public function momoPayment($orderId){
    //     // dd($request->id);
    //     $order=Order::find($orderId);
    //     session(['cost_id' => 5]);
    //     session(['url_prev' => url()->previous()]);
    //     $vnp_TmnCode = "UDOPNWS1"; //Mã website tại VNPAY 
    //     $vnp_HashSecret = "EBAHADUGCOEWYXCMYZRMTMLSHGKNRPBN"; //Chuỗi bí mật
    //     $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    //     $vnp_Returnurl = "http://127.0.0.1:8000/admin/order/checkPayment";
    //     $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
    //     $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
    //     $vnp_OrderType = 'billpayment';
    //     $vnp_Amount = $order->total_money * 100;
    //     $vnp_Locale = 'vn';
    //     $vnp_IpAddr = request()->ip();

    //     $inputData = array(
    //         "vnp_Version" => "2.0.0",
    //         "vnp_TmnCode" => $vnp_TmnCode,
    //         "vnp_Amount" => $vnp_Amount,
    //         "vnp_Command" => "pay",
    //         "vnp_CreateDate" => date('YmdHis'),
    //         "vnp_CurrCode" => "VND",
    //         "vnp_IpAddr" => $vnp_IpAddr,
    //         "vnp_Locale" => $vnp_Locale,
    //         "vnp_OrderInfo" => $vnp_OrderInfo,
    //         "vnp_OrderType" => $vnp_OrderType,
    //         "vnp_ReturnUrl" => $vnp_Returnurl,
    //         "vnp_TxnRef" => $orderId,
    //     );

    //     if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    //         $inputData['vnp_BankCode'] = $vnp_BankCode;
    //     }
    //     ksort($inputData);
    //     $query = "";
    //     $i = 0;
    //     $hashdata = "";
    //     foreach ($inputData as $key => $value) {
    //         if ($i == 1) {
    //             $hashdata .= '&' . $key . "=" . $value;
    //         } else {
    //             $hashdata .= $key . "=" . $value;
    //             $i = 1;
    //         }
    //         $query .= urlencode($key) . "=" . urlencode($value) . '&';
    //     }

    //     $vnp_Url = $vnp_Url . "?" . $query;
    //     if (isset($vnp_HashSecret)) {
    //        $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
    //         $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
    //         $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
    //     }
    //     return $vnp_Url;
    //     // return redirect($vnp_Url);
    // }

    // function returnUrl(){

    //     $vnp_HashSecret = "EBAHADUGCOEWYXCMYZRMTMLSHGKNRPBN";   //Chuỗi bí mật
    //     $inputData = array();
    //     $returnData = array();

    //     foreach ($_GET as $key => $value) {
    //         if (substr($key, 0, 4) == "vnp_") {
    //             $inputData[$key] = $value;
    //         }
    //     }
    //     $vnp_SecureHash = $inputData['vnp_SecureHash'];
    //     unset($inputData['vnp_SecureHash']);
    //     ksort($inputData);
    //     $i = 0;
    //     $hashData = "";
    //     foreach ($inputData as $key => $value) {
    //         if ($i == 1) {
    //             $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
    //         } else {
    //             $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
    //             $i = 1;
    //         }
    //     }
    //     // dd($inputData);
    //     $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
    //     $vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
    //     $vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
    //     $vnp_Amount = $inputData['vnp_Amount'] / 100; // Số tiền thanh toán VNPAY phản hồi
    //     $Status = 0; // Là trạng thái thanh toán của giao dịch chưa có IPN lưu tại hệ thống của merchant chiều khởi tạo URL thanh toán.
    //     $orderId = $inputData['vnp_TxnRef'];

    //     try {
    //         //Check Orderid
    //         //Kiểm tra checksum của dữ liệu
    //         $order=Order::find($orderId);
    //         // dd($order);
    //         // dd($secureHash == $vnp_SecureHash);
    //         // if ($secureHash == $vnp_SecureHash) {
    //             if ($order != NULL) {
    //                     if ( $order->status_contract == 0) {
    //                         if ($inputData['vnp_ResponseCode'] == '00' 
    //                         // && $inputData['vnp_TransactionStatus'] == '00'
    //                         ) {
    //                             $order->status_contract=1;
    //                             $returnData['RspCode'] = '00';
    //                             $returnData['Message'] = 'Giao dịch thành công';
    //                         } else {

    //                             $returnData['RspCode'] = '24';
    //                             $returnData['Message'] = 'Giao dịch không thành công do: Khách hàng hủy giao dịch';
    //                             $order->status_contract=0;
    //                         }
    //                         // dd($order->id);
    //                         $order->save();
    //                         $order = Order::find($order->id);
    //                         $contract = new Contract();
    //                         $attendance = new Attendance();
    //                         $schedule = new Schedule();
                    
    //                         $month = $order->package->month_package;
    //                         $newdate = strtotime ( '+'.$month.' month' , strtotime ( $order->activate_day ) );
    //                         $end_date = date ( 'Y-m-j' , $newdate );
                    
    //                         $contract->package_id = $order->package->id;
    //                         if (isset($order->pt_id)) {
    //                             $contract->pt_id = $order->pt_id;
    //                             $contract->weekday_name = $order->weekday_name;
    //                         }
    //                         $contract->activate_date = $order->activate_day;
    //                         $contract->order_id = $order->id;
    //                         $contract->start_date = $order->activate_day;
    //                         $contract->end_date = $end_date;
                            
    //                         $contract->save();
    //                         $user_contract = $order->users->pluck('id')->toArray();
    //                         // dd($user_contract);
    //                         foreach ($user_contract as $key => $user_id) {
    //                             $result_contract = ResultContract::where('user_id', '=', $user_id )
    //                                                 ->Where('order_id', '=', $order->id)->first();
    //                             $result_contract->update([
    //                                 'contract_id' => $contract->id,
    //                             ]);
    //                         }
                            
    //                         $begin = new DateTime($contract->start_date);
    //                         $end = new DateTime($contract->end_date);
                    
    //                         $interval = DateInterval::createFromDateString('1 day');
    //                         $period = new DatePeriod($begin, $interval, $end);
    //                         $weekdays = Weekday::all();
    //                         $weekday_contract = $contract->weekday_name;
    //                         $weekdays_pt =  explode('|', $weekday_contract);
                    
    //                         $order->status_contract = 1;
    //                         $order->save();
                            
    //                         // tạo lịch trình pt và điểm danh hội viên
    //                         foreach ($period as $dt) {
    //                             // echo $dt->format("l Y-m-d \n");
    //                             // echo "<br>";
    //                             // dd($dt->format("l"));
                    
    //                             $attendance->date = $dt->format("Y-m-d");
    //                             foreach ($weekdays_pt as $key => $weekday_name) {
                                    
    //                                 if($weekday_name ==  $dt->format("l")){
    //                                     $schedule = $schedule->create([
    //                                         'pt_id' => $contract->pt_id,
    //                                         'contract_id' => $contract->id,
    //                                         'time_id' => $contract->order->time_id,
    //                                         'weekday_name' => $dt->format("l"),
    //                                         'date' => $dt->format("Y-m-d"),
    //                                         'status' => 1,
    //                                     ]);
    //                                     foreach ($user_contract as $key => $user_id) {
                                           
    //                                         $attendance->create([
    //                                             'user_id' => $user_id,
    //                                             'contract_id' => $contract->id,
    //                                             'schedule_id' =>  $schedule->id,
    //                                             'time_id' => $contract->order->time_id,
    //                                             'weekday_name' => $dt->format("l"),
    //                                             'pt_id' => 1,
    //                                             'date' => $dt->format("Y-m-d"),
    //                                             'status' => 0,
                                                
    //                                         ]);
    //                                     }
                                       
                                       
    //                                 }
                    
                    
    //                             }
                    
    //                         }
                    
    //                         return back()->with('success', 'Mua hang thanh cong');
    //                     } else {
    //                         $returnData['RspCode'] = '02';
    //                         $returnData['Message'] = 'Giao dịch thất bại';
    //                     }

    //             } else {
    //                 $returnData['RspCode'] = '01';
    //                 $returnData['Message'] = 'Đơn hàng không tồn tại';
    //             }
    //         // }
    //         //  else {
    //         //     $returnData['RspCode'] = '97';
    //         //     $returnData['Message'] = 'Chữ ký không hợp lệ';
    //         // }
    //     }
    //      catch (Exception $e) {
    //         $returnData['RspCode'] = '99';
    //         $returnData['Message'] = 'Unknow error';
    //     }
    //     //Trả lại VNPAY theo định dạng JSON


    //     return view('screens.backend.order.payment',compact('returnData'));
    // }


    // public function createMulti(){
    //     $users = User::role('member')->get();
    //     $packages = Package::all();
    //     $times = Time::all();
    //     $coachs = User::role('coach')->get();
    //     $weekdays = Weekday::all();
    //     return view('screens.backend.order.create-multi', ['users' => $users, 'packages' => $packages, 'times' => $times, 'coachs' => $coachs, 'weekdays' => $weekdays]);
    // }

    // public function postOrderMulti(Request $request){
    //     // dd($request->user_id);
    //     $order = new Order();
    //     $package = Package::find($request->package_id);
    //     $order->fill($request->all());
    //     if($request->discount_code != ""){
    //             $discount = Discount::where('discount_code', '=' , $request->discount_code)->first();
    //             if(isset($discount)){
    //                 $discount_packages =  explode('|', $discount->package_id);
                
    //                 if($discount->status == 0){
    //                     return back()->with('msg', 'Xin lỗi. Phiếu giảm giá này đã hết hạn'); 
    //                 }
    //                 if(count($request->user_id)){
    //                     if(in_array($package->id, $discount_packages)){
    //                         foreach ($request->user_id as $key => $user) {
    //                             // $order->user_id = $user;
    //                             // $order->total_money = $package->price - $package->price*$discount->price_sale/100;
    //                             // $order->discount_id = $discount->id;
    //                             $order->create([
    //                                 'user_id' => $user,
    //                                 'discount_id' => $discount->id,
    //                                 'package_id' => $request->package_id,
    //                                 'weekday_name' => implode("|",$request->weekday_name),
    //                                 'time_id' => $request->time_id, 
    //                                 'activate_day' => $request->activate_day,
    //                                 'pt_id' => $request->pt_id,
    //                                 'total_money' => $package->price - $package->price*$discount->price_sale/100,
    //                                 'payment_method' => $request->payment_method,
    //                             ]);
    //                             // $order->save();
    //                         }
    //                             $quantity_discount = $discount->quantity - 1;
    //                             $discount->update([
    //                                 'quantity' => $quantity_discount,
    //                             ]);
                             
    //                             if($discount->quantity == 0){
    //                                 $discount->update([
    //                                     'status' => 0,
    //                                 ]);
    //                             }
    //                         return back()->with('success', 'Thêm Order thành công'); 
    //                     }
    //                 }
                    
    //                 else{
    //                     return back()->with('msg', 'Phiếu giảm giá không đúng'); 
    //                 }
                    
    //             }
    //             else{
    //                 return back()->with('msg', 'Phiếu giảm giá không đúng'); 
    //             }
    //         }
    //         foreach ($request->user_id as $key => $user) {
  
    //             $order->create([
    //                 'user_id' => $user,
    //                 'package_id' => $request->package_id,
    //                 'weekday_name' => implode("|",$request->weekday_name),
    //                 'time_id' => $request->time_id, 
    //                 'activate_day' => $request->activate_day,
    //                 'pt_id' => $request->pt_id,
    //                 'total_money' => $package->price,
    //                 'payment_method' => $request->payment_method,
    //             ]);
    //         }
    //         return back()->with('success', 'Thêm Order thành công');
        
    // }

    public function mailOrder(){
        $title = "BẠN ĐANG GẶP KHÓ KHĂN VỀ VẤN ĐỀ THANH TOÁN, HAY CÒN ĐIỀU GÌ BẠN CHƯA HÀI LÒNG VỀ CHÚNG TÔI";
        $content = "Chào bạn Nguyễn Văn A";
        return view('screens.backend.order.mail-order', ['title'=>$title, 'content'=>$content]);
    }

    public function postMailOrder(Request $request){
        $orders = Order::where('status', '=', 0);
        $data = [
            'title' => $request->title,
            'content' => $request->content,
        ];
        foreach ($orders as $order) {
            $users = $order->users;
            foreach ($users as $user) {
                Mail::to("$user->email")->send(new SendMailSupportOrder($data)); 
            }
            $order->update([
                'status' => 3,
            ]);
            
        }
        return redirect()->route('admin.order.list')->with('success','Gửi mail thành công');
    }



    public function sendMail($order){
        $order = decrypt($order);
        $title = "BẠN ĐANG GẶP KHÓ KHĂN VỀ VẤN ĐỀ THANH TOÁN, HAY CÒN ĐIỀU GÌ BẠN CHƯA HÀI LÒNG VỀ CHÚNG TÔI";
        $content = "Chào bạn Nguyễn Văn A";
        return view('screens.backend.order.send-mail', ['title'=>$title, 'content'=>$content, 'order' => encrypt($order)]);
    }

    public function postSendMail($order,Request $request){
        $order = Order::find(decrypt($order));
        $data = [
            'title' => $request->title,
            'content' => $request->content,
        ];
        // dd($data);
        $users = $order->users;
        foreach ($users as $user) {
            Mail::to("legend.cay@gmail.com")->send(new SendMailSupportOrder($data));
        }
        $order->status = 3;
        $order->save();
        return redirect()->route('admin.order.list')->with('success','Gửi mail thành công');
        
    }
}
