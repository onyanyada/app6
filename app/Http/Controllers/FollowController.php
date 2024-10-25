<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowController extends Controller
{
    // フォローするアクション
    public function follow(User $user)
    {
        auth()->user()->follow($user->id);
        return redirect()->back()->with('success', 'フォローしました');
    }

    // フォローを外すアクション
    public function unfollow(User $user)
    {
        auth()->user()->unfollow($user->id);
        return redirect()->back()->with('success', 'フォローを解除しました');
    }

    public function index(User $user)
    {
        // 指定されたユーザーがフォローしているユーザーを取得
        $followings = $user->followings()->get();

        return view('follow.index', ['followings' => $followings]);
    }
}
