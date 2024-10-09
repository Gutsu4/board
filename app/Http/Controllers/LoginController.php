<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $classRooms = ClassRoom::all();
        return view('index', compact('classRooms'));
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated(); // バリデートされたデータを取得

        if (Auth::guard('classroom')->attempt([
            'id' => $credentials['class_room'], // `id` を使う
            'password' => $credentials['password'],
        ], $credentials['remember'] ?? false)) {
            // 認証成功
            $request->session()->regenerate();
            return redirect()->route('question.index');
        }

        // 認証失敗
        return back()->withErrors([
            'password' => '認証に失敗しました。'
        ]);
    }

    function logout(Request $request)
    {
        Auth::guard('classroom')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
