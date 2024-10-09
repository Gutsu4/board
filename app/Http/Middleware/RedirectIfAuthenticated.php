<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // もしユーザーが認証済みであれば、リダイレクト
        if (Auth::check()) {
            // ユーザーが認証されていれば、指定のルートにリダイレクトする
            return redirect()->route('question.index');
        }

        // 認証されていない場合はリクエストを次に進める
        return $next($request);
    }
}
