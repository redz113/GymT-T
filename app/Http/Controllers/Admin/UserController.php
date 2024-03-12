<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BMIRequest;
use App\Http\Requests\UserRequest;
use App\Models\Bodybmi;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Services\UploadImgService;
use App\Mail\VeryEmail;
use App\Mail\VeryMailCoach;
use App\Models\Rate;
use App\Models\Schedule;
use App\Models\Wage;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::all();
        $users = new User();
        if (isset($request->q)) {
            $users = $users->where('name', 'like', '%' . $request->q . '%');
        }
        if (isset($request->sort)) {
            if ($request->sort == 'idDesc')
                $users = $users->orderByDesc('id');

            if ($request->sort == 'idAsc')
                $users = $users->orderBy('id');
        }
        if (isset($request->status)) {
            $users = $users->where('status', $request->status);
        }
        $users = $users->paginate(12);
        return view('screens.backend.user.list-user', ['users' => $users, 'roles' => $roles]);
    }

    public function listAdmin(Request $request)
    {
        $roles = Role::all();
        $users = User::role(['admin', 'manager']);
        if (isset($request->q)) {
            $users = $users->where('name', 'like', '%' . $request->q . '%');
        }
        if (isset($request->sort)) {
            if ($request->sort == 'idDesc')
                $users = $users->orderByDesc('id');

            if ($request->sort == 'idAsc')
                $users = $users->orderBy('id');
        }
        if (isset($request->status)) {
            $users = $users->where('status', $request->status);
        }
        $users = $users->paginate(12);
        return view('screens.backend.user.list-user', ['users' => $users, 'roles' => $roles]);
    }

    public function listPt(Request $request)
    {
        $roles = Role::all();
        $users = User::role('coach');
        if (isset($request->q)) {
            $users = $users->where('name', 'like', '%' . $request->q . '%');
        }
        if (isset($request->sort)) {
            if ($request->sort == 'idDesc')
                $users = $users->orderByDesc('id');

            if ($request->sort == 'idAsc')
                $users = $users->orderBy('id');
        }
        if (isset($request->status)) {
            $users = $users->where('status', $request->status);
        }
        $users = $users->paginate(12);

        return view('screens.backend.user.list-user', ['users' => $users, 'roles' => $roles]);
    }

    public function listMember(Request $request)
    {
        $roles = Role::all();
        $users = User::role('member');
        if (isset($request->q)) {
            $users = $users->where('name', 'like', '%' . $request->q . '%');
        }
        if (isset($request->sort)) {
            if ($request->sort == 'idDesc')
                $users = $users->orderByDesc('id');

            if ($request->sort == 'idAsc')
                $users = $users->orderBy('id');
        }
        if (isset($request->status)) {
            $users = $users->where('status', $request->status);
        }
        $users = $users->paginate(12);

        return view('screens.backend.user.list-user', ['users' => $users, 'roles' => $roles]);
    }

    public function status(Request $request)
    {
        $user = User::find($request->id);
        if ($request->status == 0) {
            $user->update([
                'status' => 1,
            ]);
        } elseif ($request->status == 1) {
            $user->update([
                'status' => 1,
            ]);
        }
        return response()->json([
            'result' => 0,
            'user' => $user,
        ]);
    }

    public function editRole(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        // return response()->json([
        //     'result' => 0,
        //     'user' => $request->id,

        // ]);
        foreach ($user->roles as $role) {
            $user->removeRole($role);
        }
        $user->assignRole($request->role);
        $roles = $user->roles->pluck('name')->all();
        return response()->json([
            'result' => 0,
            'user' => $user,
            'role' => $roles[0]
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('screens.backend.user.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rule = [
            'name' => 'required|max:255|min:5',
            'email' =>'required|email|max:255|unique:users',
            'gender' => 'required',
            'address' =>'required',
            'role' =>'required',
            'phone' =>'required|integer',
            'password' => 'required'
        ];
        $messages = [
            'required' => ':attribute không được để chống',
            'unique' =>':attribute đã tồn tại',
            'name.max'=>':attribute tối đa 255 kí tự',
            'name.min'=>':attribute tối thiểu 5 kí tự',
            'integer' => ':attribute phải là dạng số',
        ];
        $request->validate($rule,$messages);
        
        $user = new User();
        // dd($request->role);
        if ($request->hasFile('avatar')) {
            // dd($request->avatar);
            $file = $request->avatar;
            $file_name = UploadImgService::uploadImg($request->avatar, 'images/user');
        } else {
            $file_name = 'images/user/one.jpg';
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->avatar = 'images/user/' . $file_name;
        $user->address = $request->address;
        $user->assignRole($request->role);
        $code = rand(0, 9) . '' . rand(0, 9) . '' . rand(0, 9) . '' . rand(0, 9) . '' . rand(0, 9) . '' . rand(0, 9);
        $user->verify_code = $code;
        $user->save();
        if($user->hasRole('coach')){
            $wage = new Wage();
            $wage->user_id = $user->id;
            $wage->wage_month = $request->wage;
            $wage->save();
        }
        $userId = encrypt($user->id);
        $data = [
            'code' => $code,
            'userId' => $userId
        ];
        Mail::to("$user->email")->send(new VeryMailCoach($data));
        return redirect()->route('admin.user.veryAccount', $userId)->with('success','Nhập mã xác minh');
    }

    public function veryAccount($user){

        return view('screens.backend.user.very-account', ['user' => $user]);
    }

    public function postVeryAccount($user, Request $request){
        $user = User::find(decrypt($user));
        // dd($user->verify_code);
        if ($user->verify_code == $request->code) {
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->status = 1;
            $user->save();
            return redirect()->route('admin.user.listPt')->with('success', 'Xác minh tài khoản thành công');
        }
        return redirect()->back()->with('msg', 'Mã xác minh không chính xác');
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

    public function bmi($id)
    {
        $user = User::where('id', $id)->first();
        if ($user != null) {
            $ex_bmi = Bodybmi::where('user_id', $id)->exists();
            if ($ex_bmi == false) {
                $bmi = new Bodybmi();
                $bmi->user_id = $id;
                $bmi->save();
            } else {
                $bmi = Bodybmi::where('user_id', $id)->first();
            }
            return view('screens.backend.user.bmi', compact('bmi'));
        }
        return redirect()->back();
    }

    public function updateBMI($id, BMIRequest $request)
    {
        $bmi = Bodybmi::where('user_id', $id)->first();
        $request_bmi = round($request->weight / (($request->height / 100) * ($request->height / 100)), 1);
        $bmi->weight = $request->weight;
        $bmi->height = $request->height;
        $bmi->bmi = $request_bmi;
        $bmi->health = test_bmi($request_bmi);
        $bmi->save();
        Toastr::success('Cập nhật chỉ số BMI thành công');
        return redirect()->back();
    }

    public function evaluate($id){
        $evaluates = Rate::where('pt_id', $id)->paginate(12);
        return view('screens.backend.user.evaluate', compact('evaluates'));
    }

    
}
