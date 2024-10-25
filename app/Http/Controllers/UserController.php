<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        // ユーザー情報とその投稿を取得
        $user = User::with('posts', 'bio')->findOrFail($id);

        // ユーザーの投稿とプロフィールを表示するビューを返す
        return view('user.show', [
            'user' => $user,
            'posts' => $user->posts // ユーザーの投稿
        ]);
    }
}
