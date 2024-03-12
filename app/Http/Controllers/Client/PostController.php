<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('screens.frontend.post.index', compact('posts'));
    }

    public function detail($id){
        $post = Post::where('id', $id)->first();
        $related = Post::where('subject_id', $post->subject_id)->where('id','!=', $post->id)->limit(2)->get();
        if($post!=null){
            return view('screens.frontend.post.detail', compact('post','related'));
        }

        return redirect()->back();
    }
}
