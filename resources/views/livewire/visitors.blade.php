<div>
    <div class="flex items-center justify-center">
        @foreach(str_split($visitors) as $number)
            <div class="border-2 border-nord-10 bg-nord-10 rounded mx-0.5 size-8 flex items-center justify-center text-center aspect-square leading-none">{{ $number }}</div>
        @endforeach
    </div>
</div>
