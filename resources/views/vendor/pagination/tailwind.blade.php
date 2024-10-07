<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-center gap-1">
    @if ($paginator->hasPages())
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <button class="w-9 h-9 text-12 font-bold text-black text-center cursor-default rounded-full bg-white"
                        disabled>{{ $element }}</button>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page === $paginator->currentPage())
                        <button
                            class="w-9 h-9 text-12 font-bold text-white text-center cursor-default rounded-full bg-primary"
                            disabled>{{ $page }}</button>
                    @else
                        <button
                            class="w-9 h-9 text-12 font-bold text-black text-center rounded-full bg-white hover:bg-gray-verypale"
                            onclick="location.href='{{ $url }}'">{{ $page }}</button>
                    @endif
                @endforeach
            @endif
        @endforeach
    @else
        <button class="w-9 h-9 text-12 font-bold text-white text-center cursor-default rounded-full bg-primary"
                disabled>1
        </button>
    @endif
</nav>
