<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 購入履歴を表示する
        $purchases = Auth::user()->purchases;

        return view('purchases.index', compact('purchases'));
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
        // 購入処理を行う（例: ログインユーザーが記事を購入）
        $purchase = Purchase::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'amount' => $post->price, // 記事の金額に基づくと仮定
        ]);

        return redirect()->back()->with('success', '記事を購入しました！');
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase, Post $post)
    {
        // 購入情報も一緒に取得
        $post->load('purchases');

        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
