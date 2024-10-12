@extends('layouts.app')
@section('content')
    <x-breadcrumb>投稿管理</x-breadcrumb>
    <x-body header="{{ $classroom->name }}教室 投稿管理">
        <!-- 削除完了メッセージの表示 -->
        @if(session('success'))
            <div class="bg-green-light text-green-dark p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <!-- 質問の一覧表示 -->
        @if($questions->isNotEmpty())
            @foreach($questions as $question)
                <div
                    class="w-full px-4 lg:px-8 py-3 lg:py-4 flex flex-col gap-3 lg:gap-6 border-b border-gray-verypale">
                    <!-- タイトルと投稿日時 -->
                    <div class="flex justify-between items-center">
                        <!-- タイトル -->
                        <a href="{{ route('question.detail', [$question->id]) }}"
                           class="text-blue font-black text-18 lg:text-24 line-clamp-1">
                            {{ $question->title }}
                        </a>
                        <!-- 投稿日時 -->
                        <p class="text-gray-soft text-12 lg:text-16">{{ $question->created_at->format('Y-m-d') }}</p>
                    </div>

                    <!-- 投稿内容のプレビュー -->
                    <p class="text-gray-dark text-14 lg:text-16 line-clamp-3">
                        {{ Str::limit($question->content, 100) }}
                    </p>

                    <!-- コースとカテゴリー情報 -->
                    <div class="flex items-center gap-2 text-sm">
                        <!-- コース情報 (赤色に設定) -->
                        <p class="text-red-500 text-14 lg:text-18 font-bold">{{ $question->course->name }}</p>
                        <!-- カテゴリー -->
                        @if($question->categories->isNotEmpty())
                            <span>|</span>
                            @foreach($question->categories as $category)
                                <span
                                    class="px-2 py-1 text-12 lg:text-14 font-light bg-gray-verypale text-gray-dark rounded">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        @endif
                    </div>

                    <!-- 投稿者情報 -->
                    <p class="text-gray-dark font-bold text-14 lg:text-16">
                        @if($question->is_anonymous)
                            匿名
                        @else
                            拠点 : {{ $question->classroom->name }} | 投稿者 : {{ $question->author_name }}
                        @endif
                    </p>

                    <!-- いいね・回答ボタン -->
                    <div class="flex items-center mt-4 gap-6 text-gray-500 text-12 lg:text-14">
                        <!-- いいねボタン -->
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="icon icon-tabler icons-tabler-outline icon-tabler-hearts w-6 h-6 lg:w-8 lg:h-8">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M14.017 18l-2.017 2l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 0 1 8.153 5.784"/>
                                <path
                                    d="M15.99 20l4.197 -4.223a2.81 2.81 0 0 0 0 -3.948a2.747 2.747 0 0 0 -3.91 -.007l-.28 .282l-.279 -.283a2.747 2.747 0 0 0 -3.91 -.007a2.81 2.81 0 0 0 -.007 3.948l4.182 4.238z"/>
                            </svg>
                            <span>いいね</span>
                            <span class="like-count ml-1">{{ $question->likes_count }}</span>
                        </div>

                        <!-- 回答ボタン -->
                        <a href="{{ route('question.detail', $question->id) }}"
                           class="flex items-center gap-2 hover:text-blue">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="icon icon-tabler icons-tabler-outline icon-tabler-message-plus w-6 h-6 lg:w-8 lg:h-8">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M8 9h8"/>
                                <path d="M8 13h6"/>
                                <path
                                    d="M12.01 18.594l-4.01 2.406v-3h-2a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v5.5"/>
                                <path d="M16 19h6"/>
                                <path d="M19 16v6"/>
                            </svg>
                            <span>回答</span>
                        </a>

                        <!-- 削除ボタン -->
                        <button type="button" class="flex items-center gap-2 text-red-500 hover:text-red-700"
                                onclick="confirmDelete({{ $question->id }})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round"
                                 class="icon icon-tabler icons-tabler-outline icon-tabler-trash w-6 h-6 lg:w-8 lg:h-8">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M4 7h16"/>
                                <path d="M10 11v6"/>
                                <path d="M14 11v6"/>
                                <path d="M5 7l1 -1h12l1 1"/>
                                <path d="M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2v-12h-12v12"/>
                            </svg>
                            <span>削除</span>
                        </button>

                        <!-- 削除確認用フォーム -->
                        <form id="delete-form-{{ $question->id }}"
                              action="{{ route('classroom.question.destroy', ['question' => $question->id]) }}"
                              method="POST" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            @endforeach

            <div class="py-8">
                {{ $questions->links('vendor.pagination.tailwind') }}
            </div>
        @else
            <p class="mt-8 p-8 text-gray-500">投稿はありません。</p>
        @endif
    </x-body>
    <!-- 削除確認用モーダルダイアログ -->
    <dialog id="confirm-dialog"
            class="max-w-md border border-gray-soft rounded shadow-lg p-6 backdrop:bg-opacity-80 w-[calc(100%-48px)] lg:max-w-[calc(100%-240px)]">
        <h2 class="font-bold text-lg mb-4">確認</h2>
        <p class="mb-4">
            本当に削除しますか？<br>一度削除すると復元はできません。
        </p>
        <div class="flex justify-end gap-4">
            <button type="button" id="cancel-button" class="px-4 py-2 bg-gray-pale rounded">キャンセル</button>
            <x-button-primary type="button" id="confirm-delete-button"
                              class="px-4 py-2 bg-primary text-white rounded-md">
                削除する
            </x-button-primary>
        </div>
    </dialog>

    <script>
        function confirmDelete(questionId) {
            const dialog = document.getElementById('confirm-dialog');
            const confirmButton = document.getElementById('confirm-delete-button');

            // モーダルを表示
            dialog.showModal();

            // 確認ボタンのイベントリスナーを一度リセットしてから設定
            confirmButton.onclick = function () {
                document.getElementById('delete-form-' + questionId).submit();
                dialog.close();
            };

            // キャンセルボタンでモーダルを閉じる
            document.getElementById('cancel-button').onclick = function () {
                dialog.close();
            };
        }
    </script>
@endsection
