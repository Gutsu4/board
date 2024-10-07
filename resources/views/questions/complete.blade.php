@section('title', 'ログイン')
@extends('layouts.app')
@section('content')
    <x-breadcrumb>投稿完了</x-breadcrumb>
    <div class="px-4 lg:px-14 pb-12 lg:pb-36">
        <x-complete>
            <h1 class="text-center mb-2 mt-7 lg:mt-0　lg:mb-7">投稿が完了しました</h1>
            <x-button-primary type="button" class="my-6" onclick="location.href='{{ route('question.index') }}'">
                投稿一覧に戻る
            </x-button-primary>
        </x-complete>
    </div>
@endsection
