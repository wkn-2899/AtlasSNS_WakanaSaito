<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    // ユーザー検索ページを表示する
    public function search(Request $request)
    {
        // ログイン中のユーザーがフォローしている相手のIDを取得する
        $followed_user_ids = Follow::where('following_id', Auth::id())
            ->pluck('followed_id')
            ->toArray();

        // 自分自身を除外して検索対象のユーザーを取得する
        $query = User::where('id', '!=', Auth::id());

        // 検索ワードが入力されている場合は、ユーザー名の部分一致で絞り込む
        if ($request->filled('keyword')) {
            $query->where('username', 'like', '%' . $request->keyword . '%');
        }

        // 条件に合うユーザーを取得する
        $users = $query->get();

        // ユーザー一覧とフォロー中のユーザーIDを画面に渡す
        return view('users.search', compact('users', 'followed_user_ids'));
    }
}
