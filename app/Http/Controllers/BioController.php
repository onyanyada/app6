<?php

namespace App\Http\Controllers;

use App\Models\Bio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator; // Validatorのインポート
class BioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 現在認証しているユーザーを取得
        $user = Auth::user();
        return view(
            'bio.index',
            [
                'bio' => $user->bio
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        // 既に自己紹介がある場合は、新しい自己紹介を作成させない
        if ($user->bio) {
            return redirect()->route('bio.edit')->with('error', '既に自己紹介があります。編集してください。');
        }
        return view('bio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // 既に自己紹介がある場合は、新しい自己紹介を作成させない
        if ($user->bio) {
            return redirect()->route('bio.edit')->with('error', '既に自己紹介があります。編集してください。');
        }

        //バリデーション
        $validator = Validator::make($request->all(), [
            'body' => 'required | min:1 | max:255',
        ]);

        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        //以下に登録処理を記述（Eloquentモデル）

        // Eloquentモデル
        $bio = new Bio;
        $bio->user_id  = Auth::user()->id;
        $bio->body = $request->body;
        $bio->save();
        return redirect('/bio');
    }

    /**
     * Display the specified resource.
     */
    public function show(Bio $bio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bio $bio)
    {
        $user = Auth::user();

        if (!$user->bio) {
            return redirect()->route('bio.create')->with('error', 'まだ自己紹介がありません。作成してください。');
        }

        return view('bio.edit', ['bio' => $user->bio]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bio $bio)
    {
        //バリデーション
        $validator = Validator::make($request->all(), [
            'body' => 'required | min:1 | max:255',
        ]);

        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        //以下に登録処理を記述（Eloquentモデル）

        // Eloquentモデル
        $user = Auth::user();
        $bio = $user->bio;
        $bio->body = $request->body;
        $bio->save();
        return redirect('/bio');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bio $bio)
    {
        //
    }
}
