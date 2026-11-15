<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    // フォロー一覧ページを表示する
    public function followList()
    {
        // ログイン中のユーザーがフォローしているユーザーIDを取得する
        $followed_user_ids = Follow::where('following_id', Auth::id())
            ->pluck('followed_id');

        // フォローしているユーザーの情報を取得する
        $users = \App\Models\User::whereIn('id',$followed_user_ids)->get();

        // フォローしているユーザーの投稿と投稿者の情報を取得する
        // 投稿者の情報も一緒に取得し、投稿日時が新しい順に並べる
        $posts = Post::with('user')
            ->whereIn('user_id', $followed_user_ids)
            ->orderBy('created_at', 'desc')
            ->get();

        // ユーザー一覧と投稿一覧をフォローリスト画面に渡す
        return view('follows.followList', compact('users', 'posts'));
    }

    // フォロワー一覧ページを表示する
    public function followerList()
    {
        // ログイン中の自分をフォローしているユーザーIDを取得する
        $follower_user_ids = Follow::where('followed_id', Auth::id())
            ->pluck('following_id');

        // フォロワーのユーザー情報を取得する
        $users = \App\Models\User::whereIn('id',$follower_user_ids)->get();

        // フォロワーの投稿と投稿者の情報を取得する
        // 投稿者の情報も一緒に取得し、投稿日時が新しい順に並べる
        $posts = Post::with('user')
            ->whereIn('user_id', $follower_user_ids)
            ->orderBy('created_at', 'desc')
            ->get();

        // フォロワー一覧と投稿一覧を画面に渡す
        return view('follows.followerList',compact('users', 'posts'));
    }

    // 指定したユーザーをフォローする
    public function follow($id)
    {
        // フォローする相手が自分自身でないことを確認する
        if ((int) $id === (int) Auth::id()) {
            abort(403);
        }

        // 存在するユーザーIDか確認する
        \App\Models\User::findOrFail($id);

        // フォロー情報を登録する（重複登録はしない）
        Follow::firstOrCreate([
            'following_id' => Auth::id(),
            'followed_id' => $id,
        ]);

        // プロフィール画面からの操作なら、そのプロフィール画面へ戻る
        if (url()->previous() !== route('search')) {
            return redirect()->back();
        }

        // 検索画面からの操作なら、検索画面へ戻る
        return redirect()->route('search', request()->only('keyword'));
    }

    // 指定したユーザーのフォローを解除する
    public function unfollow($id)
    {
        // ログイン中のユーザーがフォローしている相手の情報だけを削除する
        Follow::where('following_id', Auth::id())
            ->where('followed_id', $id)
            ->delete();

        // プロフィール画面からの操作なら、そのプロフィール画面へ戻る
        if (url()->previous() !== route('search')) {
            return redirect()->back();
        }

        // 検索画面からの操作なら、検索画面へ戻る
        return redirect()->route('search', request()->only('keyword'));
    }
}
