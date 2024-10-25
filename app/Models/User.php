<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function bio()
    {
        return $this->hasOne(Bio::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // フォローしているユーザー
    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }

    // フォローされているユーザー
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id');
    }

    // ユーザーをフォローする
    public function follow($userId)
    {
        $this->followings()->attach($userId);
    }

    // ユーザーのフォローを外す
    public function unfollow($userId)
    {
        $this->followings()->detach($userId);
    }

    // ユーザーが特定のユーザーをフォローしているか確認
    public function isFollowing($userId)
    {
        return $this->followings()->where('following_id', $userId)->exists();
    }
}
