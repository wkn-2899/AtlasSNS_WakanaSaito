<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // 入力された値が設計書の条件を満たしているか確認する
        $request->validate(
        [
            // ユーザー名：必須、2文字以上12文字以内
            'username' => 'required|min:2|max:12',

            // メールアドレス：必須、5文字以上40文字以内、メール形式、登録済みメールアドレスは使用不可
            'email' => 'required|min:5|max:40|email|unique:users,email',

            // パスワード：必須、英数字のみ、8文字以上20文字以内
            'password' => 'required|alpha_num|min:8|max:20',

            // パスワード確認：必須、英数字のみ、8文字以上20文字以内、パスワードと一致
            'password_confirmation' => 'required|alpha_num|min:8|max:20|same:password',
        ],
        [
            'username.required' => 'ユーザー名を入力してください。',
            'username.min' => 'ユーザー名は2文字以上で入力してください。',
            'username.max' => 'ユーザー名は12文字以内で入力してください。',

            'email.required' => 'メールアドレスを入力してください。',
            'email.min' => 'メールアドレスは5文字以上で入力してください。',
            'email.max' => 'メールアドレスは40文字以内で入力してください。',
            'email.email' => '正しいメールアドレス形式で入力してください。',
            'email.unique' => 'このメールアドレスはすでに登録されています。',

            'password.required' => 'パスワードを入力してください。',
            'password.alpha_num' => 'パスワードは英数字のみで入力してください。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'password.max' => 'パスワードは20文字以内で入力してください。',

            'password_confirmation.required' => 'パスワード確認を入力してください。',
            'password_confirmation.alpha_num' => 'パスワード確認は英数字のみで入力してください。',
            'password_confirmation.min' => 'パスワード確認は8文字以上で入力してください。',
            'password_confirmation.max' => 'パスワード確認は20文字以内で入力してください。',
            'password_confirmation.same' => 'パスワードとパスワード確認が一致していません。',
        ]
    );
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 登録したユーザー名をセッションに保存して、完了ページへ移動
        return redirect('added')->with('username', $user->username);
    }

    public function added(): View
    {
        return view('auth.added');
    }
}
