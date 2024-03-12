<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Schedule;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {   
        // $schedules = Schedule::where('pt_id', Auth::id())->first();
        // dd($schedules);
        if(Schedule::where('pt_id', 3)->first() != null){
            
            $date_end = Schedule::where('pt_id', 3)->orderBy('id', 'desc')->first()->date;
            // dd($date_end);
            $schedules = Schedule::where('pt_id', 3);
            if(isset($request->status)){
                $schedules = $schedules->where('status', $request->status);
            }
            if(isset($request->start_date)){
                $schedules = $schedules->whereDate('date', '>=', $request->start_date);
            }
            else{
                $schedules = $schedules->whereDate('date', '>=', date('Y-m-d'));
            }
            if(isset($request->end_date)){
                $schedules = $schedules->whereDate('date', '<=', $request->end_date);
            }
            else{
                $schedules = $schedules->whereDate('date', '<=', $date_end);
            }
            $schedules = $schedules->orderBy('date', 'asc')->paginate(12);
            // $schedules = Schedule::where('pt_id', $id)->orderBy('date', 'asc')->paginate(12);
            $user = \App\Models\User::where('id', 3)->first();
            return view('screens.backend.schedule.show', compact('schedules', 'user'));
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
