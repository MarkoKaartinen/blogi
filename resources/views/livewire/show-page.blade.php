<div>
    <div class="text-left wrapper">
        <h1 class="font-extrabold text-3xl md:text-4xl lg:text-5xl">
            {{ $title }}
        </h1>
        @if($updated_at)
            <div class="mt-1">
                <div class="text-sm text-nord-12 uppercase inline-flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 mr-1">
                        <path d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                        <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                    </svg>
                    <span class="uppercase">Päivitetty:</span>
                    <span class="ml-1">{{ $updated_at->diffForHumans() }}</span>
                </div>
            </div>
        @endif

        <div class="textcontent">
            @markdown($markdown)
        </div>
    </div>
</div>
