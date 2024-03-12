<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class CoachController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $coachs = User::role('coach')->get();

        $top = [];

        foreach ($coachs as $item) {
            $avg_star = Order::where('pt_id', $item->id)->count();
            $avg = $avg_star == null ? 0 : $avg_star;
            $top[] = [
                "avg_star" => $avg,
                "item" => $item
            ];
        }
        rsort($top);
       
       $count = count($top);
        if ($count > 3) {
            for ($i = 3; $i < $count; $i++) {
                unset($top[$i]);
            }
        }
        
        return view('screens.frontend.coach.index', compact('coachs', 'top'));
    }

    public function detail($id)
    {
        $coach = User::where('id', $id)->first();
        $rates = Rate::where('pt_id', $id)->orderBy('star_pt', 'desc')->limit(6)->get();
        $avg_star = Rate::where('pt_id', $id)->avg('star_pt');
        $avg_star = $avg_star == null ? 5 : $avg_star;
        if ($coach != null) {
            return view('screens.frontend.coach.detail', compact('coach', 'rates', 'avg_star'));
        }
    }
}
