<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended('top');
    }

    /**
     * ログアウト処理を実行する
     */
    public function destroy(Request $request): RedirectResponse
    {
        // 現在ログインしているユーザーをログアウトさせる
        Auth::guard('web')->logout();

        // 現在のセッションを破棄する
        $request->session()->invalidate();

        // CSRFトークンを再生成する
        $request->session()->regenerateToken();

        // ログイン画面へ戻す
        return redirect()->route('login');
    }

}
