<nav class="flex justify-between items-center h-14 lg:h-16 bg-white px-2 lg:px-4 shadow-md">
    <!-- ロゴ -->
    <a href="{{ route('question.index') }}" class="h-full flex items-center">
        <img class="h-full pr-0 lg:pr-4" src="{{ asset('images/board-logo.png') }}" alt="Logo">
    </a>

    <!-- サイトタイトル -->
    <h1 class="mr-auto text-16 lg:text-24 font-bold">
        匿名質問版
    </h1>

    <!-- ナビゲーションメニュー -->
    <div class="flex items-center gap-8 lg:gap-12 xl:gap-16">
        <!-- PC向けメニュー -->
        <div class="hidden lg:flex items-center gap-8 xl:gap-16">
            <!-- 投稿一覧ボタン -->
            <a href="{{ route('question.index') }}"
               class="text-14 lg:text-16 font-bold text-gray-dark hover:text-primary transition">
                投稿一覧
            </a>

            <!-- 投稿作成ボタン -->
            <a href="{{route('question.create')}}"
               class="text-14 lg:text-16 font-bold text-gray-dark hover:text-primary transition">
                投稿作成
            </a>

            <!-- 投稿検索ボタン -->
            <a href="{{route('question.search')}}"
               class="text-14 lg:text-16 font-bold text-gray-dark hover:text-primary transition">
                投稿検索
            </a>

            <!-- プロフィールアイコン -->
            <div x-data="{ open: false }" class="relative">
                <img
                        @click="open = !open"
                        class="w-10 h-10 rounded-full border border-gray-dark cursor-pointer"
                        src="{{ asset('images/icon-default.png') }}"
                        alt="プロフィール画像"
                >
                <!-- ドロップダウンメニュー -->
                <div
                        x-show="open"
                        @click.away="open = false"
                        class="absolute right-0 mt-2 w-40 border border-gray-soft shadow-lg bg-white rounded z-50">
                    <ol class="py-2">
                        <li class="text-16 font-bold text-gray-dark px-3 py-2 hover:bg-gray-verypale transition">
                            <a href="{{ route('classroom.index',['classroom'=>auth()->id()]) }}">投稿管理</a>
                        </li>
                        <li class="text-16 font-bold text-gray-dark px-3 py-2 hover:bg-gray-verypale transition">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="w-full text-left">ログアウト</button>
                            </form>
                        </li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- モバイル向けメニュー -->
        <div x-data="{ open: false }" class="lg:hidden relative">
            <button @click="open = !open" class="p-2">
                <!-- ハンバーガーメニューアイコン -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <!-- ドロップダウンメニュー -->
            <div x-show="open" @click.away="open = false"
                 class="absolute right-0 mt-2 w-40 border border-gray-soft shadow-lg bg-white rounded z-50">
                <ol class="py-2">
                    <li class="text-16 font-bold text-gray-dark px-3 py-2 hover:bg-gray-verypale transition">
                        <a href="{{ route('question.index') }}">投稿一覧</a>
                    </li>
                    <li class="text-16 font-bold text-gray-dark px-3 py-2 hover:bg-gray-verypale transition">
                        <a href="{{route('question.create')}}">投稿作成</a>
                    </li>
                    <li class="text-16 font-bold text-gray-dark px-3 py-2 hover:bg-gray-verypale transition">
                        <a href="{{route('question.search')}}">投稿検索</a>
                    </li>
                    <li class="text-16 font-bold text-gray-dark px-3 py-2 hover:bg-gray-verypale transition">
                        <a href="{{route('classroom.index',['classroom'=>auth()->id()])}}">投稿管理</a>
                    </li>
                    <li class="text-16 font-bold text-gray-dark px-3 py-2 hover:bg-gray-verypale transition">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="w-full text-left">ログアウト</button>
                        </form>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</nav>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
