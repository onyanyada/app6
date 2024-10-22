<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // ユーザーのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // コメントのリレーション
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // いいねのリレーション
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // 購入のリレーション
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    // カテゴリのリレーション
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    // タグのリレーション
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    // 画像のリレーション
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
