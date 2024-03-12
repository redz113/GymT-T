<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(){
        $subjects = Subject::where('id', '>',0)->get();
        return response()->json([
            'status'=>200,
            'data'=>$subjects
        ]);
    }

    public function show($id){
        $subject = Subject::where('id', $id)->first();
        if($subject !=null){
            return response()->json([
                'status'=>200,
                'data'=>$subject
            ]);
        }
        return response()->json([
            'status'=>404,
        ]);
    }
}
