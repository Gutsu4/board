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
        ], $request->filled('remember'))) {
            // 認証成功
            $request->session()->regenerate();
            return redirect()->route('top');
        }

        // 認証失敗
        return back()->withErrors([
            'password' => '認証に失敗しました。'
        ]);
    }
}
