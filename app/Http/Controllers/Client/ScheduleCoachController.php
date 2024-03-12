<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Order;
use App\Models\Schedule;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\Auth;

class ScheduleCoachController extends Controller
{
    public function profile()
    {
        return view('screens.frontend.accountCoach.profile');
    }

    public function scheduleCoach(Request $request)
    {
        
        $schedules = Schedule::where('pt_id', Auth::id());
        if ($schedules->count() != 0) {
            $date_end = Schedule::where('pt_id', Auth::id())->orderBy('id', 'desc')->first()->date;
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
        /*  $schedules = Schedule::where('pt_id', $id)->orderBy('date', 'asc')->paginate(12); */
        return view('screens.frontend.accountCoach.schedule', ['schedules' => $schedules]);
    }

    public function attendanceMember($scheduleId)
    {
        $attendances = Attendance::where('schedule_id', '=', $scheduleId)
            ->paginate(12);
        // dd($attendances);
        $date = Schedule::find($scheduleId)->date;
        
        $schedule = Schedule::find($scheduleId);
        $order = $schedule->order;
        foreach ($order->results as $result) {
            
            if(Attendance::latest()->first()->date <= date('Y-m-d') && $result->status_package == 0){ 
                // Attendance::latest()->first()->date <= date('Y-m-d')

                return view('screens.frontend.accountCoach.evaluate-member', ['result' => $result]);
            }  
        }
         
        // dd($packageId);
        return view('screens.frontend.accountCoach.attendance-member', compact('attendances', 'scheduleId', 'date'));
    }

    public function postAttendanceMember(Request $request, $scheduleId)
    {
        $attendance_on = Attendance::where('schedule_id', $scheduleId)->get();
        $schedule_pt = Schedule::where('id', $scheduleId)->first();
        
        if ($request->attendance) {
            foreach ($attendance_on as  $item) {
                $item->status = 1;
                $item->save();
                $schedule_pt->status = 1;
                $schedule_pt->save();
            }

            foreach ($request->attendance as  $key => $change) {
                foreach ($attendance_on as  $item) {
                    
                    if ($key == $item->id && $change == 'on') {
                        $item->status = 1;
                        $item->save();
                        $schedule_pt->status = 1;
                        $schedule_pt->save();
                    }
                }
            }
        }
        else{
            foreach ($attendance_on as  $item) {
                $item->status = 0;
                $item->save();
                
            }
            $schedule_pt->status = 0;
                $schedule_pt->save();
        }
        return redirect()->back()->with('success', 'Điểm danh thành công');
    }

    public function listMember(){
        $orders = Order::where('pt_id', '=', Auth::id())->where('status', '=', 1)->get(); 
        
        return view('screens.frontend.accountCoach.list-member', ['orders' => $orders]);
    }


    public function contract_order($id)
    {
        // dd(decrypt($id));
        try {
            $order = Order::where('id',decrypt($id))->first();
            if($order !=null){
                $pdf = PDF::loadView('screens.backend.order.contract', compact('order'));
                return $pdf->stream();
            }
        
        } catch (\Exception  $e) {
            abort($e);
 
            return "";
        }
        
        
    }
    
}
    