<div>
    <div class="text-left wrapper">
        <h1 class="font-extrabold text-3xl md:text-4xl lg:text-5xl">
            {{ $title }}
        </h1>
        <div class=" mt-6 textcontent">@markdown($markdown)</div>

        <div class="pb-6 textcontent">
            <ul>
                @foreach($blogs as $blog)
                    <li><a rel="noopener noreferrer" target="_blank" class="external-link" href="{{ $blog['url'] }}">{{ ltrim(parse_url($blog['url'], PHP_URL_HOST), 'www.') }}</a> <small>({{ $blog['vouched_at'] }})</small></li>
                @endforeach
            </ul>
        </div>

    </div>
</div>
