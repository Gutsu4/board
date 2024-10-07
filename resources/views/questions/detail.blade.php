@extends('layouts.app')

@section('title', '投稿詳細')

@section('content')
    <x-breadcrumb>投稿詳細</x-breadcrumb>
    <div class="px-4 lg:px-14 pb-12 lg:pb-36">
        <x-header-1>投稿詳細</x-header-1>

        <!-- 投稿詳細内容 -->
        <div class="bg-white shadow-default rounded-lg p-6 lg:p-8">
            <!-- タイトルと投稿日時 -->
            <div class="flex justify-between items-center">
                <h2 class="text-blue font-black text-18 lg:text-24">{{ $question->title }}</h2>
                <p class="text-gray-soft text-12 lg:text-16">{{ $question->created_at->format('Y-m-d H:i') }}</p>
            </div>

            <!-- 投稿内容 -->
            <div class="mt-4">
                <p class="text-gray-600 text-14 lg:text-16">
                    {!! nl2br(e($question->content)) !!}
                </p>
            </div>

            <!-- コースとカテゴリー情報 -->
            <div class="mt-6 flex flex-wrap gap-2 text-sm">
                <!-- コース情報 (赤色に設定) -->
                <p class="text-red font-bold text-14 lg:text-16 my-auto">{{ $question->course->name }}</p>

                <!-- カテゴリー -->
                @if($question->categories->isNotEmpty())
                    <span>|</span>
                    @foreach($question->categories as $category)
                        <span class="px-2 py-1 text-14 lg:text-18 font-light bg-gray-verypale text-gray-dark rounded">
                            {{ $category->name }}
                        </span>
                    @endforeach
                @endif
            </div>

            <!-- 投稿者情報 -->
            <div class="mt-4">
                <p class="text-gray-dark font-bold text-14 lg:text-16">
                    @if($question->is_anonymous)
                        匿名
                    @else
                        拠点 : {{ $question->classroom->name }} | 投稿者 : {{ $question->author_name }}
                    @endif
                </p>
            </div>

            <!-- いいね・回答ボタン -->
            <div class="flex gap-4 mt-6">
                <form action="{{ route('question.like', $question->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="flex items-center text-gray-500 hover:text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="icon icon-tabler icons-tabler-outline icon-tabler-hearts mr-2">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M14.017 18l-2.017 2l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 0 1 8.153 5.784"/>
                            <path
                                d="M15.99 20l4.197 -4.223a2.81 2.81 0 0 0 0 -3.948a2.747 2.747 0 0 0 -3.91 -.007l-.28 .282l-.279 -.283a2.747 2.747 0 0 0 -3.91 -.007a2.81 2.81 0 0 0 -.007 3.948l4.182 4.238z"/>
                        </svg>
                        いいね<span class="like-count ml-2">{{ $question->likes_count }}</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- 回答フォーム -->
        <div class="mt-8 bg-white shadow-default rounded-lg p-6 lg:p-8">
            <h3 class="text-lg font-bold mb-4">あなたの回答</h3>
            <form action="{{ route('answer.store') }}" method="POST" class="flex flex-col gap-6"
                  id="post-form">
                @csrf
                <input type="hidden" name="question_id" value="{{ $question->id }}">
                <!-- 回答内容 -->
                <div>
                    <label for="content" class="block text-gray-dark font-bold mb-2">回答内容</label>
                    <textarea name="content" id="content" rows="4"
                              class="w-full border border-gray-light rounded px-3 py-2"
                              placeholder="回答内容を入力してください">{{ old('content') }}</textarea>
                    @error('content')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 投稿者名と匿名オプション -->
                <div class="flex gap-4 items-center">
                    <!-- 投稿者名 -->
                    <div>
                        <input type="text" name="author_name" id="author_name"
                               class="w-full border border-gray-light rounded px-3 py-2"
                               placeholder="回答者名"
                               value="{{ old('author_name') }}" {{ old('is_anonymous') ? 'disabled' : '' }}>
                    </div>
                </div>
                <!-- 匿名投稿オプション -->
                <div>
                    <label class="inline-flex items-center my-auto">
                        <input type="checkbox" name="is_anonymous" id="is_anonymous"
                               class="border-gray-light rounded" {{ old('is_anonymous') ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-dark font-bold">匿名で回答する</span>
                    </label>
                </div>
                <!-- 匿名の場合は無効化 -->
                @error('author_name')
                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror

                <!-- 投稿ボタン -->
                <div class="flex justify-end">
                    <button type="button" id="confirm-button"
                            class="px-6 py-2 bg-primary hover:bg-amber-500 text-white rounded">
                        回答を投稿する
                    </button>
                </div>
            </form>
        </div>
        <!-- 回答リスト -->
        <div class="mt-8 bg-white shadow-default rounded-lg p-6 lg:p-8">
            <h3 class="text-lg font-bold mb-4">回答一覧</h3>
            @if($question->answers->isNotEmpty())
                @foreach($question->answers as $answer)
                    <div class="border-b border-gray-pale py-4">
                        <p class="text-gray-600 text-14 lg:text-16">
                            {{ $answer->content }}
                        </p>
                        <p class="text-gray-soft text-12 mt-2">
                            @if($answer->is_anonymous)
                                匿名 | {{ $answer->created_at->format('Y-m-d H:i') }}
                            @else
                                回答者 : {{ $answer->author_name }} | {{ $answer->created_at->format('Y-m-d H:i') }}
                            @endif
                        </p>
                        <form action="{{ route('answer.like', $answer->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                    class="flex items-center text-14 text-gray-500 hover:text-red-500 mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round"
                                     class="icon icon-tabler icons-tabler-outline icon-tabler-hearts mr-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path
                                        d="M14.017 18l-2.017 2l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 0 1 8.153 5.784"/>
                                    <path
                                        d="M15.99 20l4.197 -4.223a2.81 2.81 0 0 0 0 -3.948a2.747 2.747 0 0 0 -3.91 -.007l-.28 .282l-.279 -.283a2.747 2.747 0 0 0 -3.91 -.007a2.81 2.81 0 0 0 -.007 3.948l4.182 4.238z"/>
                                </svg>
                                いいね<span class="like-count">{{ $answer->likes_count }}</span>
                            </button>
                        </form>
                    </div>
                @endforeach
            @else
                <p class="text-gray-soft text-14">まだ回答がありません。</p>
            @endif
        </div>
        <!-- 確認用モーダルダイアログ -->
        <dialog id="confirm-dialog"
                class="max-w-md border border-gray-soft rounded shadow-lg p-6 backdrop:bg-opacity-80 w-[calc(100%-48px)] lg:max-w-[calc(100%-240px)]">
            <h2 class="font-bold text-lg mb-4">確認</h2>
            <p class="mb-4">
                この内容で投稿してもよろしいですか？<br>個人が特定される情報が含まれていないことをご確認ください。
            </p>
            <div class="flex justify-end gap-4">
                <button type="button" id="cancel-button" class="px-4 py-2 bg-gray-pale rounded">キャンセル</button>
                <button type="submit" form="post-form" class="px-4 py-2 bg-primary text-white rounded">投稿する
                </button>
            </div>
        </dialog>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // モーダルを開く
                document.getElementById('confirm-button').addEventListener('click', function () {
                    document.getElementById('confirm-dialog').showModal();
                });

                // モーダルを閉じる
                document.getElementById('cancel-button').addEventListener('click', function () {
                    document.getElementById('confirm-dialog').close();
                });

                // 匿名チェックボックスの状態に応じて投稿者名を有効/無効にする
                document.getElementById('is_anonymous').addEventListener('change', function () {
                    const authorNameField = document.getElementById('author_name');
                    if (this.checked) {
                        authorNameField.disabled = true;
                        authorNameField.value = ''; // 無効化した場合は値をクリア
                    } else {
                        authorNameField.disabled = false;
                    }
                });
            });
        </script>
    </div>
@endsection
