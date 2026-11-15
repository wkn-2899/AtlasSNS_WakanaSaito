<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // 投稿登録時・更新時に一括代入できるカラムを指定する
    protected $fillable = [
        'user_id',
        'post',
    ];

    // 投稿に紐づく投稿者のユーザー情報を取得する
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
