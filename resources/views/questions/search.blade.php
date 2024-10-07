@extends('layouts.app')

@section('title', '詳細検索')

@section('content')
    <x-breadcrumb>詳細検索</x-breadcrumb>
    <x-body header="詳細検索">
        <!-- 検索フォーム -->
        <div class="bg-white shadow-default rounded-lg p-6 lg:p-8">
            <form action="{{ route('question.search') }}" method="GET" class="flex flex-col gap-4">
                <!-- カテゴリー選択 -->
                <div>
                    <label for="category" class="block text-gray-dark font-bold mb-2">カテゴリー</label>
                    <select name="category" id="category" class="w-full border border-gray-dark rounded px-3 py-2">
                        <option value="">カテゴリーを選択</option>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}" {{ request('category.blade.php') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- キーワード検索 -->
                <div>
                    <label for="keyword" class="block text-gray-dark font-bold mb-2">キーワード</label>
                    <input type="text" name="keyword" id="keyword" placeholder="キーワードを入力"
                           class="w-full border border-gray-dark rounded px-3 py-2"
                           value="{{ request('keyword') }}">
                </div>

                <!-- 期間選択 -->
                <div class="flex flex-col lg:flex-row gap-4">
                    <div class="w-full">
                        <label for="start_date" class="block text-gray-dark font-bold mb-2">開始日</label>
                        <input type="date" name="start_date" id="start_date"
                               class="w-full border border-gray-dark rounded px-3 py-2"
                               value="{{ request('start_date') }}">
                    </div>
                    <div class="w-full">
                        <label for="end_date" class="block text-gray-dark font-bold mb-2">終了日</label>
                        <input type="date" name="end_date" id="end_date"
                               class="w-full border border-gray-dark rounded px-3 py-2"
                               value="{{ request('end_date') }}">
                    </div>
                </div>

                <!-- 拠点選択 -->
                <div>
                    <label for="classroom" class="block text-gray-dark font-bold mb-2">拠点</label>
                    <select name="classroom" id="classroom" class="w-full border border-gray-dark rounded px-3 py-2">
                        <option value="">拠点を選択</option>
                        @foreach($classRooms as $classRoom)
                            <option
                                value="{{ $classRoom->id }}" {{ request('classroom') == $classRoom->id ? 'selected' : '' }}>
                                {{ $classRoom->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- コース選択 -->
                <div>
                    <label for="course" class="block text-gray-dark font-bold mb-2">コース</label>
                    <select name="course" id="course" class="w-full border border-gray-dark rounded px-3 py-2">
                        <option value="">コースを選択</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ request('course') == $course->id ? 'selected' : '' }}>
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- 検索ボタンとリセットボタン -->
                <div class="flex justify-end gap-4">
                    <!-- リセットボタン -->
                    <a href="{{ route('question.search') }}"
                       class="px-6 py-2 bg-gray-light text-gray-dark rounded hover:bg-gray-pale">
                        リセット
                    </a>
                    <!-- 検索ボタン -->
                    <x-button-primary type="submit" class="rounded-md">検索</x-button-primary>
                </div>
            </form>
            <!-- 検索結果の表示 -->
            @if($questions->isNotEmpty())
                <div class="mt-8">
                    <h2 class="font-bold text-lg mb-4">検索結果</h2>
                    <!-- ページネーション -->
                    <div class="py-8">
                        <!-- 質問の一覧表示 -->
                        @foreach($questions as $question)
                            <div
                                class="w-full py-3 lg:py-4 flex flex-col gap-3 lg:gap-6 border-b border-gray-verypale">
                                <!-- タイトルと投稿日時 -->
                                <div class="flex justify-between items-center">
                                    <!-- タイトル -->
                                    <a href="{{ route('question.detail', [$question->id]) }}"
                                       class="text-blue font-black text-14 lg:text-18 line-clamp-1">
                                        {{ $question->title }}
                                    </a>
                                    <!-- 投稿日時 -->
                                    <p class="text-gray-soft text-12 lg:text-16">{{ $question->created_at->format('Y-m-d') }}</p>
                                </div>

                                <!-- 投稿内容のプレビュー -->
                                <p class="text-gray-dark text-12 lg:text-14 line-clamp-3">
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

                                <!-- 役に立った・回答ボタン -->
                                <div class="flex items-center gap-6 mt-4">
                                    <!-- 役に立ったボタン -->
                                    <form action="{{ route('question.like', $question->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                                class="flex items-center gap-2 text-gray-500 hover:text-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none"
                                                 stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                 stroke-linejoin="round"
                                                 class="icon icon-tabler icons-tabler-outline icon-tabler-hearts">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path
                                                    d="M14.017 18l-2.017 2l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 0 1 8.153 5.784"/>
                                                <path
                                                    d="M15.99 20l4.197 -4.223a2.81 2.81 0 0 0 0 -3.948a2.747 2.747 0 0 0 -3.91 -.007l-.28 .282l-.279 -.283a2.747 2.747 0 0 0 -3.91 -.007a2.81 2.81 0 0 0 -.007 3.948l4.182 4.238z"/>
                                            </svg>
                                            <span>役に立った</span>
                                            <span class="like-count ml-1">{{ $question->likes_count }}</span>
                                        </button>
                                    </form>

                                    <!-- 回答ボタン -->
                                    <a href="{{ route('question.detail', [$question->id]) }}"
                                       class="flex items-center gap-2 text-gray-500 hover:text-blue">
                                        <!-- 回答アイコン -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round"
                                             class="icon icon-tabler icons-tabler-outline icon-tabler-message-plus">
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
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <p class="mt-8 text-gray-500">検索結果が見つかりませんでした。</p>
            @endif
        </div>
    </x-body>
@endsection
