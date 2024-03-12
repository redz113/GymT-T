<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class SchedulePtController extends Controller
{
    public function index($id,Request $request){
        if ($request->start_date && $request->end_date && strtotime($request->start_date) <= strtotime($request->end_date)) {
            if(isset($request->status)){
                $schedules = Schedule::select('schedule_pt.*')
                    ->where('pt_id', $id)
                    ->where('status', $request->status)
                    ->whereDate('created_at', '>=', $request->start_date)
                    ->whereDate('created_at', '<=', $request->end_date)
                    ->orderBy('date', 'asc')
                    ->paginate(12);
            }else{
                $schedules = Schedule::select('schedule_pt.*')
                    ->where('pt_id', $id)
                    ->whereDate('created_at', '>=', $request->start_date)
                    ->whereDate('created_at', '<=', $request->end_date)
                    ->orderBy('date', 'asc')
                    ->paginate(12);
            }
        } else {
            if(isset($request->status)){
                $schedules = Schedule::select('schedule_pt.*')
                    ->where('pt_id', $id)
                    ->where('status', $request->status)
                    ->orderBy('date', 'asc')
                    ->paginate(12);
            }else{
                $schedules = Schedule::where('pt_id', $id)->orderBy('date', 'asc')->paginate(12);
            }
        }
        // if(count($schedules) > 0){
            $user = \App\Models\User::where('id', $id)->first();
            return view('screens.backend.schedule.show', compact('schedules', 'user'));
        // }
        // return redirect()->back();
    }
}
