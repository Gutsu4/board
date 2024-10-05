<div class="relative w-full">
    <select {{ $attributes->merge(['class' => 'relative rounded-md h-10 lg:h-12 text-14 lg:text-16 bg-gray-verypale w-full pl-4 lg:font-bold border border-gray-pale']) }}>
        {{ $slot }}
    </select>
    <svg class="absolute right-4 top-3 lg:top-[14px] fill-black w-5 h-5 stroke-black stroke-2">
        <use xlink:href="#icon-chevron-down"></use>
    </svg>
</div>
