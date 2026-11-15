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
    // 一括代入を許可するカラムを指定する
    protected $fillable = [
        'username',
        'email',
        'password',
        'bio',
        'icon_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
       // シリアライズ時に外部へ公開しない属性を指定する
        protected $hidden = [
            'password',
            'remember_token',
        ];

    // 自分がフォローしているユーザーを取得する
    public function following()
    {
        return $this->belongsToMany(
            User::class,
            'follows',
            'following_id',
            'followed_id'
        );
    }

    // 自分をフォローしているユーザーを取得する
    public function followers()
    {
        return $this->belongsToMany(
            User::class,
            'follows',
            'followed_id',
            'following_id'
        );
    }
}
