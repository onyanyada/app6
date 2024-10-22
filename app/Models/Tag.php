<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
    // ここで 'name' を大量割り当て可能にする
    protected $fillable = ['name'];
}
