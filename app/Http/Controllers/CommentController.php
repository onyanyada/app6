<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Post $post)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'comment' => 'required|min:1|max:1000',
        ]);

        // バリデーション: エラー時
        if ($validator->fails()) {
            return redirect()->route('post_show', ['post' => $post->id])
                ->withInput()
                ->withErrors($validator);
        }

        // コメントの保存
        $comment = new Comment;
        $comment->post_id = $post->id;
        $comment->user_id = Auth::user()->id;
        $comment->comment = $request->input('comment');
        $comment->save();

        return redirect()->route('post_show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        // 現在のユーザーがコメントの所有者か確認
        if (Auth::user()->id !== $comment->user_id) {
            return redirect()->back()->with('error', '許可されていない操作です。');
        }

        // コメントを削除
        $comment->delete();

        return redirect()->back()->with('success', 'コメントが削除されました。');
    }
}
