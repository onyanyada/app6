<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

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
}
