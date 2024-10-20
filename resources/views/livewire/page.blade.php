<div>
    <div class="text-left max-w-3xl mx-auto">
        <h1 class="font-extrabold text-5xl">
            {{ $title }}
        </h1>
        @if($updated_at)
            <div class="mt-1">
                <div class="text-sm text-nord-12 uppercase">
                    <i class="ri-edit-line text-lg"></i>
                    <span class="uppercase">Päivitetty:</span>
                    {{ $updated_at->diffForHumans() }}
                </div>
            </div>
        @endif

        <div class="textcontent">
            @markdown($markdown)
        </div>
    </div>
</div>
