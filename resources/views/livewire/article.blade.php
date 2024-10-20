<div>
    <div class="">
        <h1 class="font-extrabold text-5xl">{{ $title }}</h1>
        @if($published_at)
            <div class="text-sm text-nord-8 uppercase mt-1">
                <i class="ri-calendar-2-fill text-lg"></i>
                {{ str($published_at->dayName)->ucfirst() }}na
                {{ $published_at->format('j.') }} {{ $published_at->monthName }}ta {{ $published_at->format('Y') }}
                KELLO {{ $published_at->format('H:i') }}
            </div>
        @endif
        @if($updated_at)
            <div class="text-sm text-nord-12 uppercase">
                <i class="ri-edit-line text-lg"></i>
                Päivitetty:
                {{ $updated_at->format('j.n.Y') }}
                KLO {{ $updated_at->format('H:i') }}
            </div>
        @endif
    </div>

    @if($series)
        <div class="text-base bg-theme-0 px-3 inline-block py-2 rounded mt-6">
            Tämä artikkeli on osa <strong>1</strong> sarjassa <a class="font-bold text-nord-13 transition-colors duration-300 hover:text-nord-12" href="#">{{ $series }}</a>. Tässä sarjassa on yhteensä <strong>4</strong> osaa.
        </div>
    @endif

    <div class="textcontent">
        @markdown($markdown)
    </div>

    <div class="pt-6 flex flex-col gap-2">
        <div class="">
            @foreach($categories as $category)
                <a class="text-lg font-bold uppercase text-nord-13 transition-colors duration-300 hover:text-nord-12" href="#">{{ $category }}</a>
                @if(!$loop->last)
                    /
                @endif
            @endforeach
        </div>
        <div>
            @foreach($tags as $tag)
                <a class="bg-nord-13 text-nord-0 text-sm font-bold rounded px-1.5 py-0.5 leading-none transition-colors duration-300 hover:bg-nord-12" href="#">#{{ $tag }}</a>
            @endforeach
        </div>
    </div>
</div>
