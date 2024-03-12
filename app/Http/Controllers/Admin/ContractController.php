<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Contract;
use App\Models\Order;
use App\Models\ResultContract;
use App\Models\Schedule;
use App\Models\Weekday;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;

class ContractController extends Controller
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
    public function create($id)
    {
        $order = Order::find(decrypt($id));
        $contract = new Contract();
        $attendance = new Attendance();
        $schedule = new Schedule();

        $month = $order->package->month_package;
        $newdate = strtotime ( '+'.$month.' month' , strtotime ( $order->activate_day ) );
        $end_date = date ( 'Y-m-j' , $newdate );

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
            $result_contract = ResultContract::where('user_id', '=', $user_id )
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
                
                if($weekday_name ==  $dt->format("l")){
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

        return back();

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
    public function show($id)
    {
        //
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
