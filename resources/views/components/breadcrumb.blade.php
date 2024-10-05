<nav {{ $attributes->merge(['class' => 'hidden lg:block inline text-gray-dark font-bold text-14']) }}>
    <ol class="flex items-center mx-14 my-9">
        <li class="pr-1">
            <img class="w-[19px] h-[16px]" src="{{asset('images/home-image.svg')}}" alt="ホーム">
        </li>
        <li class="pr-1">
            <a href="">
                <span class="after:content-['>'] after:pl-1">ホーム</span>
            </a>
        </li>
        {{ $slot }}
    </ol>
</nav>
