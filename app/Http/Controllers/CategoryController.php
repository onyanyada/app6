<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Validatorのインポート
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 管理者チェック
        if (!Auth::check() || !Auth::user()->is_admin === 1) {
            return redirect('/')->with('error', '権限がありません。');
        }
        $categories = Category::orderBy('created_at', 'asc')->get();
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // 管理者チェック
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/')->with('error', '権限がありません。');
        }
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 管理者チェック
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/')->with('error', '権限がありません。');
        }

        //バリデーション
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:1|max:255',
        ]);

        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        //以下に登録処理を記述（Eloquentモデル）

        // Eloquentモデル
        $categories = new Category;
        $categories->name   = $request->name;
        $categories->save();
        return redirect('/categories');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        // 管理者チェック
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/')->with('error', '権限がありません。');
        }
        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        // 管理者チェック
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/')->with('error', '権限がありません。');
        }
        //バリデーション
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required|min:1|max:255',
        ]);

        //バリデーション:エラー 
        if ($validator->fails()) {
            return redirect('/categories')
                ->withInput()
                ->withErrors($validator);
        }
        //以下に登録処理を記述（Eloquentモデル）

        // Eloquentモデル
        $categories = Category::find($request->id);
        $categories->name   = $request->name;
        $categories->save();
        return redirect('/categories');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // 管理者チェック
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/')->with('error', '権限がありません。');
        }
        $category->delete();       //追加
        return redirect('/categories');  //追加
    }
}
