@extends('layouts.app')

@section('title', '投稿作成')

@section('content')
    <x-breadcrumb>投稿作成</x-breadcrumb>
    <div class="px-4 lg:px-14 pb-12 lg:pb-36">
        <x-header-1>投稿作成</x-header-1>

        <!-- 投稿フォーム -->
        <div class="bg-white shadow-default rounded-lg p-6 lg:p-8">
            <form id="post-form" action="{{ route('question.store') }}" method="POST" class="flex flex-col gap-6">
                @csrf

                <!-- タイトル -->
                <div>
                    <label for="title" class="block text-gray-dark font-bold mb-2">タイトル</label>
                    <input type="text" name="title" id="title" class="w-full border border-gray-light rounded px-3 py-2"
                           placeholder="タイトルを入力してください" value="{{ old('title') }}">
                    @error('title')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- カテゴリー選択（チェックボックス） -->
                <div>
                    <label class="block text-gray-dark font-bold mb-2">カテゴリー</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach($categories as $category)
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                       class="border-gray-light rounded mr-2"
                                    {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                                {{ $category->name }}
                            </label>
                        @endforeach
                    </div>
                    @error('categories')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- コース選択 -->
                <div>
                    <label for="course" class="block text-gray-dark font-bold mb-2">コース</label>
                    <select name="course" id="course" class="w-full border border-gray-light rounded px-3 py-2">
                        <option value="">コースを選択</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ old('course') == $course->id ? 'selected' : '' }}>
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('course')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 投稿内容 -->
                <div>
                    <label for="content" class="block text-gray-dark font-bold mb-2">内容</label>
                    <textarea name="content" id="content" rows="6"
                              class="w-full border border-gray-light rounded px-3 py-2"
                              placeholder="投稿内容を入力してください">{{ old('content') }}</textarea>
                    @error('content')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 投稿者情報 -->
                <div>
                    <label for="author_name" class="block text-gray-dark font-bold mb-2">投稿者名</label>
                    <input type="text" name="author_name" id="author_name"
                           class="w-full border border-gray-light rounded px-3 py-2"
                           placeholder="投稿者名を入力してください"
                           value="{{ old('author_name') }}"
                        {{ old('is_anonymous') ? 'disabled' : '' }}> <!-- 匿名の場合は無効化 -->
                    @error('author_name')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 匿名投稿オプション -->
                <div class="flex items-center gap-2 mt-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_anonymous" id="is_anonymous"
                               class="border-gray-light rounded"
                            {{ old('is_anonymous') ? 'checked' : '' }}>
                        <span class="ml-2 text-gray-dark font-bold">匿名で投稿する</span>
                    </label>
                </div>

                <!-- 投稿ボタン -->
                <div class="flex justify-end mt-6">
                    <x-button-primary type="button" id="confirm-button" class="rounded-md">投稿</x-button-primary>
                </div>
            </form>
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
    </div>

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
@endsection
