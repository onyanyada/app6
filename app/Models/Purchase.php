<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    // 購入に紐づくユーザー
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 購入に紐づく記事
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // フィールドの一括代入を許可
    protected $fillable = [
        'user_id',
        'post_id',
        'amount',
    ];
}
