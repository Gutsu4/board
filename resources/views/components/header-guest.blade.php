<nav class="flex justify-between items-center h-14 md:h-16 bg-white px-2 md:px-4">
    <a href="" class="h-full">
        <img class="lg:pr-4 h-full" src="{{ asset('images/board-logo.PNG') }}" alt="Logo">
    </a>
    <h1 class="mr-auto text-16 lg:text-24">匿名質問版</h1>
    <div class="flex gap-2 md:gap-3 items-center">
        <button class="text-14 md:text-16 text-gray-dark font-bold border border-gray rounded-md px-2.5 py-2"
                onclick="window.location='{{route('login')}}'"
        >
            ログイン
        </button>
        <button
            class="text-14 md:text-16 text-white font-bold border border-gradient-to-r bg-gradient-to-r from-[#0097DF] to-[#015FDB] rounded-md px-2.5 md:px-8 py-2.5"
            onclick="window.location='https://app.slack.com/client/T02EJDCD7FA/C06AK9H46LR'"
        >
            Slackへ
        </button>
    </div>
</nav>
