<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Order;
use App\Models\Package;
use App\Models\Subject;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $total_user = User::count();
        $total_order = Order::count();
        $total_subject = Subject::count();
        $total_package = Package::count();

            return view('screens.backend.dashboard', compact('total_user','total_order', 'total_subject','total_package'));
    }
}
