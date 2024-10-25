<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PostController; //Add
use App\Models\Post; //Add
use App\Http\Controllers\CommentController;
use App\Models\Comment; //Add
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BioController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;

// フォロー機能
Route::post('/follow/{user}', [FollowController::class, 'follow'])->name('follow');
Route::post('/unfollow/{user}', [FollowController::class, 'unfollow'])->name('unfollow');
Route::get('/follow/{user}', [FollowController::class, 'index'])->name('follow.index');


// 投稿者の投稿一覧表示
Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');


Route::middleware(['auth'])->group(function () {
    Route::get('/bio', [BioController::class, 'index'])->name('bio.index');
    Route::get('/bio/create', [BioController::class, 'create'])->name('bio.create');
    Route::post('/bio', [BioController::class, 'store'])->name('bio.store');
    Route::get('/bio/edit', [BioController::class, 'edit'])->name('bio.edit');
    Route::put('/bio', [BioController::class, 'update'])->name('bio.update');
});

//カテゴリー一覧表示
Route::get('/categories', [CategoryController::class, 'index'])->name('category_index');

// カテゴリー：作成ボタン 
Route::get('/categories/create', [CategoryController::class, "create"])->name('category_create');

// カテゴリー：追加 
Route::post('/categories', [CategoryController::class, "store"])->name('category_store');

// カテゴリー：詳細
// Route::get('/posts/{post}', [PostController::class, "show"])->name('post_show');

// カテゴリー：削除 
Route::delete('/category/{category}', [CategoryController::class, "destroy"])->name('category_destroy');

// カテゴリー：更新画面
Route::post('/categories/edit/{category}', [CategoryController::class, "edit"])->name('category_edit'); //通常
Route::get('/categories/edit/{category}', [CategoryController::class, "edit"])->name('edit');      //Validationエラーありの場合

// カテゴリー：更新画面
Route::post('/categories/update/{category}', [CategoryController::class, "update"])->name('category_update');


// 購入ページ（決済方法選択ページ）
Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchase.index');

// 購入ページ（決済方法選択ページ）
Route::get('/posts/{post}/purchase', [PurchaseController::class, 'show'])->name('purchase.show');

// 購入処理（購入を確定する）
Route::post('/posts/{post}/purchase', [PurchaseController::class, 'store'])->name('purchase.store');



// いいねする
Route::post('/post/{post}/like', [LikeController::class, 'store'])->name('like.store');

// いいねを取り消す
Route::post('/post/{post}/unlike', [LikeController::class, 'destroy'])->name('like.destroy');

// コメント投稿
Route::post('/post/{post}/comments', [CommentController::class, 'store'])->name('comment.store');

// コメント削除
Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');


Route::group(
    ['middleware' => 'auth'],
    function () {
        //本：ダッシュボード表示(books.blade.php)
        Route::get('/', [PostController::class, 'index'])->name('post_index');
        Route::get('/dashboard', [PostController::class, 'dashboard'])->name('dashboard');

        //本：作成ボタン 
        Route::get('/posts/create', [PostController::class, "create"])->name('post_create');

        //本：追加 
        Route::post('/posts', [PostController::class, "store"])->name('post_store');

        //本：詳細
        Route::get('/posts/{post}', [PostController::class, "show"])->name('post_show');

        //本：削除 
        Route::delete('/post/{post}', [PostController::class, "destroy"])->name('post_destroy');

        //本：更新画面
        Route::post('/posts/edit/{post}', [PostController::class, "edit"])->name('post_edit'); //通常
        Route::get('/posts/edit/{post}', [PostController::class, "edit"])->name('edit');      //Validationエラーありの場合

        //本：更新画面
        Route::post('/posts/update/{post}', [PostController::class, "update"])->name('post_update');
    }
);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
