<?php

namespace App\View\Components;

use App\Models\Follow;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;
use Illuminate\View\View;

class LoginLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        // 現在ログインしているユーザーを取得する
        $user = Auth::user();

        // 自分がフォローしているユーザーの数を取得する
        // following_id が自分のユーザーIDになっているレコードを数える
        $follow_count = Follow::where('following_id', $user->id)->count();

        // 自分をフォローしているユーザーの数を取得する
        // followed_id が自分のユーザーIDになっているレコードを数える
        $follower_count = Follow::where('followed_id', $user->id)->count();

        // フォロー数・フォロワー数を共通レイアウトへ渡す
        return view('layouts.login', [
            'follow_count' => $follow_count,
            'follower_count' => $follower_count,
        ]);
    }
}
