<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Follow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    // トップページを表示する
    public function index()
    {
        // ログイン中のユーザーがフォローしている相手のIDを取得する
        $followed_user_ids = Follow::where('following_id', Auth::id())
            ->pluck('followed_id');

        // 自分の投稿と、フォローしている相手の投稿だけを取得する
        // 投稿者の情報もまとめて取得し、新しい投稿から順番に並べる
        $posts = Post::with('user')
            ->where(function ($query) use ($followed_user_ids) {
                // 自分の投稿を表示対象にする
                $query->where('user_id', Auth::id())
                    // フォローしている相手の投稿も表示対象にする
                    ->orWhereIn('user_id', $followed_user_ids);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // 取得した投稿一覧をトップページに渡す
        return view('posts.index', compact('posts'));
    }

    // 新しい投稿を登録する
    public function store(Request $request)
    {
        // 投稿内容が必須で、1文字以上150文字以内か検証する
        $validated = $request->validate([
            'post' => 'required|string|min:1|max:150',
        ], [
            'post.string' => '投稿内容は文字列で入力してください。',
            'post.min' => '投稿内容は1文字以上で入力してください。',
            'post.max' => '投稿内容は150文字以内で入力してください。',
        ]);

        // ログイン中のユーザーIDと投稿内容をデータベースに保存する
        Post::create([
            'user_id' => Auth::id(),
            'post' => $validated['post'],
        ]);

        // 登録完了後、トップページへ戻る
        return redirect()->route('top');
    }

    // 既存の投稿内容を更新する
    public function update(Request $request, $id)
    {
        // 投稿内容が必須で、1文字以上150文字以内か検証する
        $validated = $request->validate([
            'post' => 'required|string|min:1|max:150',
        ], [
            'post.required' => '投稿内容を入力してください。',
            'post.string' => '投稿内容は文字列で入力してください。',
            'post.min' => '投稿内容は1文字以上で入力してください。',
            'post.max' => '投稿内容は150文字以内で入力してください。',
        ]);

        // URLで指定された投稿を取得する
        $post = Post::findOrFail($id);

        // ログイン中のユーザー本人の投稿か確認する
        if ((int) $post->user_id !== (int) Auth::id()) {
            // 他のユーザーの投稿ならアクセスを拒否する
            abort(403);
        }

        // 投稿内容をデータベースに保存する
        $post->update([
            'post' => $validated['post'],
        ]);

        // 更新後はトップページへ戻る
        return redirect()->route('top');
    }

    // 既存の投稿を削除する
    public function destroy($id)
    {
        // 指定された投稿を取得する。存在しない場合は404エラーにする
        $post = Post::findOrFail($id);

        // ログイン中のユーザー本人の投稿か確認する
        if ((int) $post->user_id !== (int) Auth::id()) {
            // 他のユーザーの投稿なら削除を拒否する
            abort(403);
        }

        // 投稿をデータベースから削除する
        $post->delete();

        // 削除後はトップページへ戻る
        return redirect()->route('top');
    }
}
