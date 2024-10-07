<div class="flex flex-col lg:items-center lg:justify-center gap-5 lg:gap-8 pt-8 lg:pt-0 px-4 lg:px-14 pb-12 lg:pb-36">
    <div class="center flex-col bg-white w-full rounded-md shadow-default p-6">
        <div class="w-[100px] h-[100px] rounded-full bg-gradient-to-r from-[#E27447] to-[#E29460] center mt-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="icon icon-tabler icons-tabler-outline icon-tabler-check text-white">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M5 12l5 5l10 -10"/>
            </svg>
        </div>
        {{ $slot }}
    </div>
</div>
