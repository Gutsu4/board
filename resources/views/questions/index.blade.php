@extends('layouts.app')
@section('content')
    <x-breadcrumb>投稿一覧</x-breadcrumb>
    <x-body header="投稿一覧">

        <!-- 検索フォーム -->
        <form action="{{ route('question.index') }}" method="GET" class="mb-6">
            <div class="flex flex-col gap-4 lg:flex-row">

                <!-- カテゴリー選択 -->
                <select name="category" class="border border-gray-300 rounded px-2 py-1">
                    <option value="">カテゴリーを選択</option>
                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <!-- コース選択 -->
                <select name="course" class="border border-gray-300 rounded px-2 py-1">
                    <option value="">コースを選択</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ request('course') == $course->id ? 'selected' : '' }}>
                            {{ $course->name }}
                        </option>
                    @endforeach
                </select>

                <!-- 拠点選択 -->
                <select name="classroom" class="border border-gray-300 rounded px-2 py-1">
                    <option value="">拠点を選択</option>
                    @foreach($classRooms as $classRoom)
                        <option
                            value="{{ $classRoom->id }}" {{ request('classroom') == $classRoom->id ? 'selected' : '' }}>
                            {{ $classRoom->name }}
                        </option>
                    @endforeach
                </select>

                <!-- 検索ボタン -->
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">検索</button>
            </div>
        </form>

        <!-- 質問の一覧表示 -->
        @foreach($questions as $question)
            <div class="w-full px-4 lg:px-8 py-3 lg:py-4 flex flex-col gap-3 lg:gap-6 border-b border-gray-pale">
                <!-- コース情報 -->
                <p class="text-primary font-bold">{{ $question->course->name }}</p>
                <!-- タイトル -->
                <a href="" class="text-blue font-black line-clamp-3 lg:line-clamp-1">{{ $question->title }}</a>
                <!-- 内容 -->
                <p class="text-12 lg:text-14 font-light line-clamp-3 lg:line-clamp-2">{!! nl2br(e($question->content)) !!}</p>
                <!-- 投稿者情報 -->
                <p class="text-gray-dark font-bold text-sm">
                    @if($question->is_anonymous)
                        匿名
                    @else
                        拠点: {{ $question->classroom->name }} | 投稿者: {{ $question->author_name }}
                    @endif
                </p>
                <!-- カテゴリー表示 -->
                <div class="categories flex items-center gap-2">
                    @foreach($question->categories as $category)
                        <span class="px-2 py-1 text-12 font-light bg-gray-verypale text-gray-dark rounded">
                            {{ $category->name }}
                        </span>
                    @endforeach
                </div>
                <!-- 投稿日時 -->
                <p class="text-gray-soft text-12 font-light w-full text-end">
                    投稿日時：{{ $question->created_at->format('Y-m-d H:i') }}
                </p>
            </div>
        @endforeach

        <!-- ページネーション -->
        <div class="py-8">
            {{ $questions->links('vendor.pagination.tailwind') }}
        </div>
    </x-body>
@endsection
