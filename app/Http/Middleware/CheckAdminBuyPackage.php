<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminBuyPackage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // dd(Auth::user()->hasRole('admin'));
        if (Auth::user()->hasRole('admin') == true) {
            return redirect()->back()->with('msg' ,'Đừng đùa thế chứ. Bạn là Admin mà');
        }
        if (Auth::user()->hasRole('coach') == true) {
            return redirect()->back()->with('msg' ,'Đừng đùa thế chứ. Bạn là huấn luyện viên mà');
        }
        return $next($request);
    }
}
