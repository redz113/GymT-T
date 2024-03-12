<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Subject;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        if ($request->start_date && $request->end_date && strtotime($request->start_date) <= strtotime($request->end_date)) {
            if(isset($request->status)){
                $posts = Post::select('posts.*')
                    ->where('status', $request->status)
                    ->whereDate('created_at', '>=', $request->start_date)
                    ->whereDate('created_at', '<=', $request->end_date)
                    ->paginate(12);
            } else {
                $posts = Post::select('posts.*')
                    ->whereDate('created_at', '>=', $request->start_date)
                    ->whereDate('created_at', '<=', $request->end_date)
                    ->paginate(12);
            }
        } else {
            if(isset($request->status)){
                $posts = Post::select('posts.*')
                    ->where('status', $request->status)
                    ->paginate(12);
            } else {
                $posts = Post::where('id', '>', 0)->paginate(12);
            }
        }
        return view('screens.backend.post.index', compact('posts'));
    }

    public function change_status($id)
    {
        $post = Post::where('id', $id)->first();
        if ($post != null) {
            if ($post->status == 0) {
                $post->status = 1;
            } else {
                $post->status = 0;
            }
            $post->save();
            Toastr::success('Cập nhật trạng thái bài viết thành công');
            return redirect()->route('admin.post.index');
        }
        return redirect()->route('admin.post.index');
    }

    public function delete($id)
    {
        $post = Post::where('id', $id)->first();
        if ($post != null) {
            $post->delete();
            Toastr::success('Xóa bài viết thành công');
            return redirect()->route('admin.post.index');
        }
        return redirect()->route('admin.post.index');
    }

    public function create()
    {
        $subjects = Subject::all();
        return view('screens.backend.post.create', compact('subjects'));
    }

    public function store(PostRequest $request)
    {
        $new = new Post();
        $new->title = $request->title;
        $new->subject_id = $request->subject_id;
        if ($request->avatar) {
            upload_image('avatar', $request->avatar, $new, 'images/post');
        }
        $new->content_post = $request->content_post;
        $new->user_id = Auth::check() ? Auth::user()->id : 1;
        $new->save();
        Toastr::success('Thêm mới bài viết thành công');
        return redirect()->route('admin.post.create');
    }

    public function edit($id)
    {
        $post = Post::where('id', $id)->first();
        if ($post != null) {
            $subjects = Subject::where('id', '!=', $post->subject_id)->get();
            return view('screens.backend.post.edit', compact('post','subjects'));
        }
        return redirect()->route('admin.post.index');
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::where('id', $id)->first();
        if ($post != null) {
            $post->title = $request->title;
            $post->subject_id = $request->subject_id;
            if ($request->avatar) {
                upload_image('avatar', $request->avatar, $post, 'images/post');
            }
            $post->content_post = $request->content_post;
            $post->user_id = Auth::check() ? Auth::user()->id : 1;
            $post->save();
        }
        Toastr::success('Cập nhật bài viết thành công');
        return redirect()->route('admin.post.index');
    }
}
