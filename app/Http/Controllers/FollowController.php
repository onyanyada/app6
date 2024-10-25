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

    public function index()
    {
        // フォロー中のユーザーを取得
        $followings = auth()->user()->followings()->get(); // フォローしているユーザーのリストを取得

        return view('follow.index', ['followings' => $followings]);
    }
}
