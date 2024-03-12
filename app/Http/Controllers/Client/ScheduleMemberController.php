<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaveProfileRequest;
use App\Mail\SendMailReschedule;
use App\Models\Attendance;
use App\Models\Order;
use App\Models\Rate;
use App\Models\ResultContract;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use File;

class ScheduleMemberController extends Controller
{
    public function scheduleMember(Request $request)
    {
        $schedules = Attendance::where('user_id', '=', Auth::id());
        if ($schedules->count() != 0) {
            $date_end = Attendance::where('user_id', '=', Auth::id())->orderBy('id', 'desc')->first()->date;
            if (isset($request->status)) {
                $schedules = $schedules->where('status', $request->status);
            }
            if (isset($request->start_date)) {
                $schedules = $schedules->whereDate('date', '>=', $request->start_date);
            } else {
                $schedules = $schedules->whereDate('date', '>=', date('Y-m-d'));
            }
            if (isset($request->end_date)) {
                $schedules = $schedules->whereDate('date', '<=', $request->end_date);
            } else {
                $schedules = $schedules->whereDate('date', '<=', $date_end);
            }
        }
        $schedules = $schedules->orderBy('date', 'asc')->paginate(12);
        return view('screens.frontend.account.schedule', ['schedules' => $schedules]);
    }
    public function profile()
    {
        return view('screens.frontend.account.profile');
    }

    public function saveProfile(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user_ex_phone = $request->phone != null ? User::where('phone', $request->phone)->first() : null;
        $user_ex_email = $request->email != null ? User::Where('email', $request->email)->first() : null;

        $avtOld = $user->avatar;
        if ($user != null) {
            if ($request->name != null) {
                $user->name = $request->name;
                $user->save();
            }
            if ($request->address != null) {
                $user->address = $request->address;
                $user->save();
            }
            if ($user_ex_phone != null && $user->phone != $request->phone) {
                return redirect()->back()->with('error', 'Số điện thoại bạn muốn đổi đã tồn tại');
            }
            if ($user_ex_phone == null && $request->phone != null && $user->phone != $request->phone) {
                $user->phone = $request->phone;
                $user->save();
            }

            if ($user_ex_email != null && $user->email != $request->email) {
                return redirect()->back()->with('error', 'Email bạn muốn đổi đã tồn tại');
            }
            if ($user_ex_email == null && $request->email != null && $user->email != $request->email) {
                $user->email = $request->email;
                $user->save();
            }

            if ($request->avatar) {
                $image = $request->avatar;
                $imageName = $image->hashName();
                $user->avatar = $image->move('images/user', $imageName);
                $user->save();

                if(File::exists(public_path($avtOld))){
                    File::delete(public_path($avtOld));
                }
            }

            return redirect()->back()->with('success', 'Cập nhật thông tin cá nhân thành công');
        }
    }
    public function reschedule($attendanceId)
    {
        $attendance = Attendance::find($attendanceId);
        $times = Time::all();

        return view('screens.frontend.account.reschedule', ['times' => $times,'attendance' => $attendance, 'attendanceId' => $attendanceId]);
    }

    public function postReschedule($attendanceId, Request $request)
    {
        $rule = [
            'date' => 'required',
            'time_id' => 'required',
        ];
        $messages = [
            'date.required' => 'Ngày không được để chống',
            'time_id.required' => 'Ca tập không được để chống',
        ];
        $request->validate($rule, $messages);
        $attendance = Attendance::find($attendanceId);
        $dateOld = $attendance->date;
        $timeOld = $attendance->time->time_name;
        $attendance->update([
            'date' => $request->date,
            'time_id' => $request->time_id
        ]);
        $weekday = date('l', strtotime($request->date));
        $schedules = Schedule::where('id', '=', $attendance->schedule_id);
        
        $schedules->update([
            'date' => $request->date,
            'weekday_name' => $weekday,
            'time_id' => $request->time_id
        ]);
        $data = [
            'title' => 'Hội viên đổi lịch tập',
            'content' => "Hội viên đã lịch tập của ngày $dateOld $timeOld thành ngày $attendance->date " . $attendance->time->time_name
        ];
        $emailPt = $attendance->pt->email;
        Mail::to("legend.cay@gmail.com")->send(new SendMailReschedule($data));

        return redirect()->route('account.schedule');
    }

    public function checkTimesCoach(Request $request)
    {

        $attendance = Attendance::find($request->attendanceId);
        $dateAttendance = Attendance::where('date','=',$request->date)->first();
        
        $ptId = $attendance->pt_id;
        $schedulesPt = Schedule::where('pt_id', '=', $ptId)->where('date', '=', $request->date)->pluck('time_id')->toArray();
        if($dateAttendance){
            array_push($schedulesPt,$dateAttendance->time_id);
        }
        $times = Time::get()->pluck('id')->toArray();
        $arrayTimeId = array();
        foreach ($times as $key => $time) {
            if (!in_array($time, $schedulesPt)) {
                $ca = Time::find($time);
                $arrayTimeId[$time] = $ca->time_name . "( Từ " . $ca->start_time . " Đến " . $ca->end_time . " )";
            }
        }
        // dd($arrayTimeId);
        return response()->json([
            'result' => true,
            'arrayTimeId' => $arrayTimeId
        ]);
    }

    public function historyPackage()
    {
        $user = User::find(Auth::id());
        $orders = $user->order;

        return view('screens.frontend.account.history-package', ['orders' => $orders]);
    }

    public function evaluatePackage($id){
        
        return view('screens.frontend.account.evaluate', compact('id'));
    }

    public function store_evaluate(Request $request){
        $order = Order::where('id', $request->order_id)->first();
        $rate_ex = Rate::where('user_id', Auth::id())->where('package_id',$order->package_id)->where('pt_id', $order->pt_id)->first();
        if($rate_ex == null){
            $rate = new Rate();
            $rate->user_id =  Auth::id();
            $rate->pt_id = $order->pt_id;
            $rate->package_id = $order->package_id;
            $rate->star_package = $request->cls_pack;
            $rate->note_package = $request->note_pack != null ? $request->note_pack : '';
            $rate->star_pt = $request->cls_pt;
            $rate->note_pt = $request->note_pt != null ? $request->note_pt : '';
            $rate->save();
        }
        
    }

}
