<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    // フォロー情報の登録時に代入を許可するカラム
    protected $fillable = [
        'following_id',
        'followed_id',
    ];
}
