@props(['count' => 0])

@for ($i = 0;  $i < $count; $i++)
    <div class="flex flex-col relative w-full rounded-[20px] bg-[#141414cc] border border-[rgba(255,255,255,0.05)] p-4 {{ $attributes["class"] }}">
        <div class="shimmer relative w-full rounded-xl overflow-hidden">
            <div class="after:content-[' '] relative after:block after:pb-[calc(100%+9px)]"></div>
        </div>

        <div class="flex flex-col gap-3 mt-4">
            <p class="shimmer h-6 w-3/4 rounded"></p>
            <p class="shimmer h-6 w-[40%] rounded"></p>
            <p class="shimmer h-4 w-[20%] rounded"></p>

            <div class="mt-auto pt-4 flex gap-3">
                <div class="shimmer h-11 flex-grow rounded-lg"></div>
                <div class="shimmer h-11 w-11 rounded-lg"></div>
            </div>
        </div>
    </div>
@endfor
