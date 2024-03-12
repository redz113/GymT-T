<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DiscountRequest;
use App\Models\Discount;
use App\Models\Package;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->start_date && $request->end_date && strtotime($request->start_date) <= strtotime($request->end_date)) {
            if($request->keyword){
                $discounts = Discount::select('discounts.*')
                    ->orWhere('discount_title', 'like', '%' . $request->keyword . '%')
                    ->whereDate('created_at', '>=', $request->start_date)
                    ->whereDate('created_at', '<=', $request->end_date)
                    ->paginate(12);
            }else{
                $discounts = Discount::select('discounts.*')
                    ->whereDate('created_at', '>=', $request->start_date)
                    ->whereDate('created_at', '<=', $request->end_date)
                    ->paginate(12);
            }
        } else {
            if($request->keyword){
                $discounts = Discount::select('discounts.*')
                    ->Where('discount_title', 'like', '%' . $request->keyword . '%')
                    ->paginate(12);
            }else{
                $discounts = Discount::select('discounts.*')
                    ->where('id', '>', 0)
                    ->paginate(12);
            }
        }
        return view('screens.backend.discount.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $packages = Package::all();
        return view('screens.backend.discount.create', ['packages' => $packages]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscountRequest $request)
    {
        $discount = new Discount();
        $package_id = implode("|",$request->package_id);
        $discount->fill($request->all());
        $discount->package_id = $package_id;
        $discount->save();
        Toastr::success('Thêm mới phiếu giảm giá thành công');
        return redirect()->back();
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
        $discount = Discount::find(decrypt($id));
        $packages = Package::all();
        return view('screens.backend.discount.edit', ['discount' => $discount ,'packages' => $packages]);
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
        $discount = Discount::find(decrypt($id));
        $package_id = implode("|",$request->package_id);
        $discount->fill($request->all());
        $discount->package_id = $package_id;
        $discount->save();
        Toastr::success('Cập nhật phiếu giảm giá thành công');
        return redirect()->back();
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
