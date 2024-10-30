<div>
    <div class="text-left wrapper">
        <h1 class="font-extrabold text-3xl md:text-4xl lg:text-5xl">
            {{ $title }}
        </h1>
        <div class="pb-6 md:pb-12 mt-6">
            @markdown($markdown)
        </div>

        <div class="h-1 w-20 rounded-full bg-nord-9 mb-6 md:mb-12"></div>

        <livewire:show-articles />
    </div>
</div>
