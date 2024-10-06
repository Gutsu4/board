@extends('layouts.app')

@section('title', '詳細検索')

@section('content')
    <x-breadcrumb>詳細検索</x-breadcrumb>
    <div class="px-4 lg:px-14 pb-12 lg:pb-36">
        <x-header-1>詳細検索</x-header-1>

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
                                value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
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
                    <button type="submit" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        検索
                    </button>
                </div>
            </form>
            <!-- 検索結果の表示 -->
            @if($questions->isNotEmpty())
                <div class="mt-8">
                    <h2 class="font-bold text-lg mb-4">検索結果</h2>
                    @foreach($questions as $question)
                        <div class="w-full px-4 py-3 flex flex-col gap-3 border-b border-gray-pale">
                            <!-- コース情報 -->
                            <p class="text-primary font-bold">{{ $question->course->name }}</p>
                            <!-- タイトル -->
                            <a href="{{ route('question.detail', $question->id) }}"
                               class="text-blue font-black">{{ $question->title }}</a>
                            <!-- 投稿者情報 -->
                            <p class="text-gray-dark font-bold">{{ $question->author_name }}</p>
                        </div>
                    @endforeach

                    <!-- ページネーション -->
                    <div class="py-8">
                        {{ $questions->links() }}
                    </div>
                </div>
            @else
                <p class="mt-8 text-gray-500">検索結果が見つかりませんでした。</p>
            @endif
        </div>
    </div>
@endsection
