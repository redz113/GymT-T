<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PtMyStudentController extends Controller
{
    public function index(Request $request){
        $roles = Role::all();
        $users = User::with(['contracts' => function ($query) {
            $query->select('*');
        }]);
        dd($users);
        if (isset($request->q)) {
            $users = $users->where('name', 'like', '%'.$request->q.'%');
        }
        if(isset($request->sort)){
            if($request->sort == 'idDesc')
             $users = $users->orderByDesc('id');
   
           if($request->sort == 'idAsc')
             $users = $users->orderBy('id');
        }
        if(isset($request->status)){
            $users = $users->where('status', $request->status);
        }
        $users = $users->paginate(12);
        return view('screens.backend.my_student.index', ['users' => $users, 'roles' => $roles]);
    }
}
