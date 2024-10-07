@extends('layouts.app')
@section('content')
    <x-breadcrumb>投稿一覧</x-breadcrumb>
    <x-body header="投稿一覧">

        <!-- 検索フォーム -->
        <form action="{{ route('question.index') }}" method="GET"
              class="p-8 lg:p-12 my-auto w-full border-b border-gray-pale">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center w-full">

                <!-- カテゴリー選択 -->
                <select name="category" class="border border-gray-light rounded px-2 py-1 flex-grow lg:w-auto">
                    <option value="">カテゴリーを選択</option>
                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}" {{ request('category.blade.php') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <!-- コース選択 -->
                <select name="course" class="border border-gray-light rounded px-2 py-1 flex-grow lg:w-auto">
                    <option value="">コースを選択</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ request('course') == $course->id ? 'selected' : '' }}>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>

                <!-- 拠点選択 -->
                <select name="classroom" class="border border-gray-light rounded px-2 py-1 flex-grow lg:w-auto">
                    <option value="">拠点を選択</option>
                    @foreach($classRooms as $classRoom)
                        <option
                            value="{{ $classRoom->id }}" {{ request('classroom') == $classRoom->id ? 'selected' : '' }}>
                            {{ $classRoom->name }}
                        </option>
                    @endforeach
                </select>

                <!-- 検索ボタン -->
                <x-button-primary class="rounded-md lg:w-auto lg:ml-4" hover>検索</x-button-primary>
            </div>
        </form>

        <!-- 質問の一覧表示 -->
        @foreach($questions as $question)
            <div class="w-full px-4 lg:px-8 py-3 lg:py-4 flex flex-col gap-3 lg:gap-6 border-b border-gray-verypale">
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

                <!-- いいね・回答ボタン -->
                <div class="flex items-center mt-4 gap-6 text-gray-500">
                    <!-- いいねボタン -->
                    <div class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                             class="icon icon-tabler icons-tabler-outline icon-tabler-hearts">
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
        <!-- ページネーション -->
        <div class="py-8">
            {{ $questions->links('vendor.pagination.tailwind') }}
        </div>
    </x-body>
@endsection
