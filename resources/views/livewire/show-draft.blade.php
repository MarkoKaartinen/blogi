<div wire:key="article-{{ $year }}-{{ $slug }}" class="px-6 md:px-0">
    <div class="">
        <div class="text-nord-11 font-bold text-xl">LUONNOS</div>
        <h1 class="font-extrabold text-3xl md:text-4xl lg:text-5xl">{{ $title }}</h1>
    </div>

    <div class="textcontent">
        @markdown($markdown)
    </div>

</div>
