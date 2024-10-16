<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Validatorのインポート
use Illuminate\Support\Facades\Auth; // Authのインポート
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('comments')->where('is_public', true)->orderBy('created_at', 'asc')->get();
        return view('posts', [
            'posts' => $posts
        ]);
    }

    public function dashboard()
    {
        $posts = Post::with('comments')->where('user_id', Auth::user()->id)
            ->where('is_public', false)
            ->orderBy('created_at', 'asc')->get();
        return view('dashboard', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('postscreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:1|max:255',
            'body' => 'required | min:1 | max:255',
            'is_public' => 'required | max:6'
        ]);

        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        //以下に登録処理を記述（Eloquentモデル）

        // Eloquentモデル
        $posts = new Post;
        $posts->user_id  = Auth::user()->id;
        $posts->title   = $request->title;
        $posts->body = $request->body;
        $posts->is_public = $request->is_public;
        $posts->save();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('postsshow', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($post_id)
    {
        $posts = Post::where('user_id', Auth::user()->id)->find($post_id);
        return view('postsedit', ['post' => $posts]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'title' => 'required|min:1|max:255',
            'body' => 'required | min:1 | max:255',
            'is_public' => 'required | max:6'
        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/postsedit/' . $request->id)
                ->withInput()
                ->withErrors($validator);
        }

        //データ更新
        $posts = Post::find($request->id);
        $posts = Post::where('user_id', Auth::user()->id)->find($request->id);
        $posts->title   = $request->title;
        $posts->body = $request->body;
        $posts->is_public = $request->is_public;
        $posts->save();
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();       //追加
        return redirect('/');  //追加
    }
}
