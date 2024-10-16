<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PostController; //Add
use App\Models\Post; //Add

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

        //本：削除 
        Route::delete('/post/{post}', [PostController::class, "destroy"])->name('post_destroy');

        //本：更新画面
        Route::post('/postsedit/{post}', [PostController::class, "edit"])->name('post_edit'); //通常
        Route::get('/postsedit/{post}', [PostController::class, "edit"])->name('edit');      //Validationエラーありの場合

        //本：更新画面
        Route::post('/posts/update', [PostController::class, "update"])->name('post_update');
    }
);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
