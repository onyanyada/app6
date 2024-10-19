<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Validatorのインポート
use Illuminate\Support\Facades\Auth; // Authのインポート
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Post::with(['comments', 'likes', 'category', 'user.bio'])
            ->where('is_public', true);
        $categories = Category::all(); // 全てのカテゴリを取得

        // カテゴリが選択されている場合
        if ($request->has('categories') && !empty($request->input('categories'))) {
            $selectedCategories = $request->input('categories');
            // 選択されたカテゴリに一致する投稿をフィルタ
            $query->whereIn('category_id', $selectedCategories);
        }

        // 検索ワードが入力されている場合
        if ($request->has('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            // タイトルまたは本文に検索ワードが含まれる投稿をフィルタ
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%');
            });
        }

        // 最終的な投稿を取得
        $posts = $query->orderBy('created_at', 'desc')->get();


        return view('posts.index', [
            'posts' => $posts,
            'categories' => $categories,
            'selectedCategories' => $request->input('categories', []) // 選択されたカテゴリをビューに渡す
        ]);
    }

    public function dashboard()
    {
        $posts = Post::with(['comments', 'likes', 'category'])->where('user_id', Auth::user()->id)
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
        $categories = Category::all();
        return view('posts.create', [
            'categories' => $categories
        ]);
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
            'is_public' => 'required | max:6',
            'is_paid' => 'required | max:6',
            'price' => 'nullable|min:1 | max:8',
            'category_id' => 'required'
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
        $posts->category_id   = $request->category_id;
        $posts->title   = $request->title;
        $posts->body = $request->body;
        $posts->is_public = $request->is_public;
        $posts->is_paid = $request->is_paid;
        $posts->price   = $request->price;
        $posts->save();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // 指定された$postにリレーションをロードする（Eager Loading）
        //Post::with()はクエリビルダーを使って複数のPostをクエリするとき
        $post->load(['comments', 'likes', 'category', 'user']);
        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($post_id)
    {
        $posts = Post::with(['category'])->where('user_id', Auth::user()->id)->find($post_id);
        $categories = Category::all();
        return view('posts.edit', [
            'post' => $posts,
            'categories' => $categories
        ]);
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
            'is_public' => 'required | max:6',
            'is_paid' => 'required | max:6',
            'price' => 'nullable|min:1 | max:8',
            'category_id' => 'required'
        ]);
        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/posts/edit/' . $request->id)
                ->withInput()
                ->withErrors($validator);
        }

        //データ更新
        $posts = Post::where('user_id', Auth::user()->id)->find($request->id);
        $posts->title   = $request->title;
        $posts->body = $request->body;
        $posts->is_public = $request->is_public;
        $posts->is_paid = $request->is_paid;
        $posts->price   = $request->price;
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
