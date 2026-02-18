<div>
    <div class="text-left wrapper">
        <h1 class="font-extrabold text-3xl md:text-4xl lg:text-5xl">
            {{ $title }}
        </h1>
        <div class="pb-2 mt-6">
            @markdown($markdown)
        </div>

        <livewire:show-recipes />
    </div>
</div>
