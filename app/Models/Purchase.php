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

    //決済不法とのリレーション
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
