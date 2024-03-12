<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceMemberController extends Controller
{
    public function index($id)
    {
        $attendances = Attendance::where('schedule_id', '=', $id)
            ->paginate(12);
        return view('screens.backend.attendance_member.index', compact('attendances'));
    }

    public function editStatus(Request $request)
    {
        return response()->json([
            'result' => 0,
            'attendance' => $request
        ]);
        $attendance = Attendance::find($request->id);

        if ($request->status == 0) {
            $attendance->update([
                'status' => 1,
            ]);
        } elseif ($request->status == 1) {
            $attendance->update([
                'status' => 1,
            ]);
        }
        return response()->json([
            'result' => 0,
            'attendance' => $attendance
        ]);
    }
}
