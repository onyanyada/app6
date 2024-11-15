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
        $purchases = Purchase::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'asc')->get();
        return view('purchases.index', [
            'purchases' => $purchases
        ]);
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
        // バリデーション（決済方法が選択されたかを確認）
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        // 購入処理
        $purchase = new Purchase;
        $purchase->user_id  = Auth::user()->id;
        $purchase->post_id   = $post->id;
        $purchase->amount = $post->price;
        $purchase->payment_method_id = $request->payment_method;
        $purchase->save();
        return redirect('/')->with('success', '購入が完了しました！');
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase, Post $post)
    {
        // 購入ページ（決済方法選択ページ）を表示
        return view('purchases.show', [
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
