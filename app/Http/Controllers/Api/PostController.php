<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $post = Post::where('id', '>',0)->get();
        return response()->json([
            'status'=>200,
            'data'=>$post
        ]);
    }

    public function show($id){
        $post = Post::where('id', $id)->first();
        if($post !=null){
            return response()->json([
                'status'=>200,
                'data'=>$post
            ]);
        }
        return response()->json([
            'status'=>404,
        ]);
    }
}
