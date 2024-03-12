<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use PDF;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function list_order_pdf()
    {
        $orders = Order::all();
        $pdf = PDF::loadView('screens.backend.order.pdf', compact('orders'))->setOption('dpi', 150);
        return $pdf->stream();
    }

    public function contract_order($id)
    {
        $order = Order::where('id',$id)->first();
        if($order !=null){
            $pdf = PDF::loadView('screens.backend.order.contract', compact('order'));
            return $pdf->stream();
        }
        
    }
}
