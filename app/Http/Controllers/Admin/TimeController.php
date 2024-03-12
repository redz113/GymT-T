<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TimeRequest;
use App\Models\Time;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $times = Time::paginate(12);
        return view('screens.backend.time.index', compact('times'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('screens.backend.time.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TimeRequest $request)
    {
        $ex_time = Time::where('start_time', $request->start_time)->where('end_time', $request->end_time)->first();
        $new = new Time();
        if ($ex_time != null) {
            Toastr::error('Ca tập đã tồn tại');
            return redirect()->back();
        }
        $new->time_name = $request->time_name;
        $new->start_time = $request->start_time;
        $new->end_time = $request->end_time;
        $new->save();
        Toastr::success('Thêm mới ca tập thành công');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $time = Time::where('id', $id)->first();
        if ($time != null) {
            return view('screens.backend.time.edit', compact('time'));
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(TimeRequest $request, $id)
    {
        $time = Time::where('id', $id)->first();
        $time->time_name = $request->time_name;
        $time->start_time = $request->start_time;
        $time->end_time = $request->end_time;
        $time->save();
        Toastr::success('Cập nhật ca tập thành công');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function delete($id)
    {
        $time = Time::where('id', $id)->first();
        if ($time != null) {
            $time->delete();
            Toastr::success('Xóa ca tập thành công');
        }
        return redirect()->back();
    }
}
