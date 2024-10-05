@section('title', 'ログイン')
@extends('layouts.app')
@section('content')
    <x-breadcrumb>ログイン</x-breadcrumb>
    <x-header-1>ログイン</x-header-1>
    <div class="pb-24">
        <form action="" method="POST"
              class="max-w-lg bg-white rounded-md shadow-default mx-4 lg:mx-auto">
            @csrf
            <div class="mx-auto py-10 px-6 lg:px-9 flex flex-col gap-6">
                <div class="flex flex-col gap-2">
                    <label for="email" class="font-bold text-14">教室</label>
                    <x-form-input type="email" name="email" id="email" value="{{ old('email') }}" required/>
                    <x-error-message :messages="$errors->all()"/>
                </div>
                <div class="flex flex-col gap-2">
                    <label for="password" class="font-bold text-14">パスワード</label>
                    <x-form-input type="password" name="password" id="password" required/>
                    <x-error-message :messages="$errors->all()"/>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" value="1">
                    <label for="remember" class="pl-2 text-12">ログイン情報を保存する</label>
                </div>
                <x-button-primary type="submit" class="block mx-auto">ログイン</x-button-primary>
                <a href="" class="block text-center text-12 text-blue">
                    パスワードを忘れた方はこちら
                </a>
            </div>
        </form>
@endsection
