<nav class="flex justify-between items-center h-14 lg:h-16 bg-white px-0 lg:px-4">
    <a href="{{ route('top') }}" class="h-full">
        <img class="p-4 h-full" src="{{ asset('images/board-logo.PNG') }}" alt="Logo">
    </a>
    <h1 class="mr-auto text-16 lg:text-24">匿名質問版</h1>
    <div class="flex lg:hidden justify-center gap-4 pr-4">
        <button type="button" id="toggleMenu">
        </button>
    </div>
    <div class="hidden lg:flex justify-center items-center mr-4">
        <div class="flex gap-12 xl:gap-16">
            <div class="relative group">
                <div
                    class="text-16 font-bold text-gray-dark bg-white hover:bg-gray-pale p-3 rounded-full hover:shadow-default transition cursor-pointer">
                    質問一覧
                </div>
            </div>
            <div class="relative group">
                <div
                    class="text-16 font-bold text-gray-dark bg-white hover:bg-gray-pale p-3 rounded-full hover:shadow-default transition cursor-pointer">
                    質問投稿
                </div>
            </div>
            <div class="relative group">
                <div
                    class="text-16 font-bold text-gray-dark bg-white hover:bg-gray-pale p-3 rounded-full hover:shadow-default transition cursor-pointer">
                    カテゴリー別閲覧
                </div>
            </div>
            <div class="group">
                <div
                    class="text-16 font-bold text-gray-dark bg-white hover:bg-gray-pale p-3 rounded-full hover:shadow-default transition cursor-pointer">
                    質問検索
                </div>
            </div>
        </div>
        <div class="relative group">
        </div>
    </div>
</nav>
