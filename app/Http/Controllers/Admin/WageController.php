<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Wage;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class WageController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->month ? '0'.$request->month : date('m');
        $year = $request->year ? $request->year : date('Y');
        $roles = Role::all();
        $users = User::role(['coach'])->get();
        foreach ($users as $item) {
            $wage_user = Wage::where('user_id', $item->id)->where('month', date('m'))->where('year', date('Y'))->first();
            $schedule = Schedule::where('pt_id', $item->id)->where('status', 2)->get();
            $session = 0;

            if (!$wage_user) {
                $new_wage = new Wage();
                $new_wage->user_id = $item->id;
                $new_wage->wage_month = $item->wage;
                $new_wage->session = $session;
                $new_wage->total_wage = $new_wage->wage_month * $new_wage->session;
                $new_wage->month = date('m');
                $new_wage->year = date('Y');
                $new_wage->save();
            } else {
                if (count($schedule) > 0) {
                    foreach ($schedule as $sch) {
                        if ($wage_user->month . '-' . $wage_user->year == date('m-Y', strtotime($sch->date))) {
                            $session += 1;
                        }
                    }
                }
                $wage_user->wage_month = $item->wage;
                $wage_user->session = $session;
                $wage_user->total_wage = $wage_user->wage_month * $wage_user->session;
                $wage_user->save();
            }
        }

        if($request->month && $request->year){
            $wages = Wage::where('month', '0'.$request->month)->where('year', $request->year)->paginate(12);
        }else{
            $wages = Wage::where('month', $month)->where('year', $year)->paginate(12);
        }
        
        return view('screens.backend.user.wage', compact('wages'));
    }
}
