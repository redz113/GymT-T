<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Package;
use App\Models\Rate;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::where('id', '>', 0)->get();

        $top = [];

        foreach ($packages as $key => $item) {
            $avg_star = Order::where('package_id', $item->id)->count();
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
        return view('screens.frontend.package.index', compact('packages', 'top'));
    }

    public function detail($id)
    {
        $package = Package::where('id', $id)->first();
        if (!$package) {
            return back();
        }
        $rates = Rate::where('package_id', $id)->where('note_package', '!=', '')->orderBy('created_at', 'desc')->limit(3)->get();
     
        $star_rate = Rate::where('package_id', $id)->avg('star_package');

        $star_rate = $star_rate == null ? 5 : $star_rate;
       
        return view('screens.frontend.package.detail', compact('package', 'rates', 'star_rate'));
    }
}
