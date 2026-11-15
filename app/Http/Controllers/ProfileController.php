<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Post;

class ProfileController extends Controller
{
    // ログイン中のユーザー自身のプロフィール画面を表示する
    public function profile()
    {
        // ログイン中のユーザー情報を取得する
        $user = Auth::user();

        // ログイン中のユーザー自身の投稿を新しい順に取得する
        $posts = Post::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // ユーザー情報と投稿一覧をプロフィール画面に渡す
        return view('profiles.profile', compact('user', 'posts'));
    }

    // ログイン中のユーザーのプロフィール編集画面を表示する
    public function edit()
    {
        // プロフィール編集画面を表示する
        return view('profiles.edit');
    }

    // プロフィール編集フォームから送信された入力内容を検証する
    public function update(Request $request)
    {
        // ログイン中のユーザー情報を取得する
        $user = Auth::user();

        // 入力された内容が設計書の条件を満たしているか検証する
        $validated = $request->validate([
            // ユーザー名：必須、2文字以上12文字以内
            'username' => ['required', 'string', 'min:2', 'max:12'],

            // メールアドレス：必須、5～40文字、メール形式、自分以外との重複禁止
            'email' => [
                'required',
                'string',
                'min:5',
                'max:40',
                'email',
                'unique:users,email,' . $user->id,
            ],

            // 新しいパスワード：必須、英数字のみ、8～20文字
            'password' => [
                'required',
                'string',
                'alpha_num',
                'min:8',
                'max:20',
            ],

            // パスワード確認：必須、英数字のみ、8～20文字、パスワードと一致
            'password_confirmation' => [
                'required',
                'string',
                'alpha_num',
                'min:8',
                'max:20',
                'same:password',
            ],

            // 自己紹介：150文字以内（未入力でも可）
            'bio' => ['nullable', 'string', 'max:150'],

            // アイコン画像：指定された画像形式のみ許可（未選択でも可）
            'icon_image' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,bmp,gif,svg',
            ],
        ]);

        // バリデーションに成功したユーザー名・メールアドレス・自己紹介を保存する
        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->bio = $validated['bio'] ?? null;

        // アイコン画像が選択されている場合のみ保存する
        if ($request->hasFile('icon_image')) {
            // アップロードされた画像ファイルを取得する
            $image = $request->file('icon_image');

            // 画像をpublic/imagesフォルダに保存し、保存したファイル名を取得する
            $image_name = $image->hashName();
            $image->move(public_path('images'),$image_name);

            // ユーザー情報に新しいアイコン画像のファイル名を設定する
            $user->icon_image = $image_name;
        }

        // パスワードは平文のまま保存せず、ハッシュ化して保存する
        $user->password = Hash::make($validated['password']);

        // 変更したプロフィール情報をデータベースに保存する
        $user->save();

        // 保存後、TOP画面へ移動する
        return redirect()->route('top');
    }

    // 指定されたIDのユーザーのプロフィール画面を表示する
    public function show($id)
    {
        // URLで指定されたIDからユーザー情報を取得する
        $user = User::findOrFail($id);

        // ログイン中のユーザーが、この相手をフォローしているか確認する
        $is_following = Auth::user()->following()
            ->where('users.id', $user->id)
            ->exists();

        // 相手ユーザーが投稿した内容を新しい順に取得する
        $posts = Post::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // ユーザー情報、フォロー状態、投稿一覧をプロフィール画面に渡す
        return view('profiles.show', compact('user', 'is_following', 'posts'));
    }
}
