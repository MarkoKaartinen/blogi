<div>
    <div class="text-left wrapper">
        <h1 class="font-extrabold text-3xl md:text-4xl lg:text-5xl">
            {{ $title }}
        </h1>
        <div class="pb-6 mt-6 textcontent">@markdown($markdown)</div>

        <div class="h-1 w-20 rounded-full bg-nord-9 mb-6 md:mb-12"></div>

        <div class="grid grid-cols-1 gap-4">
            @foreach($this->getChangelogs() as $date => $logs)
                <div>
                    <div class="mb-2">
                        <h2 class="font-bold text-nord-11 text-xl">{{ $date }}</h2>
                    </div>
                    <div class="gap-4 grid grid-cols-1">
                        @foreach($logs as $log)
                            <div class="border-2 border-dashed p-2 border-nord-10 rounded-xl">
                                <div>
                                    <h3 class="font-bold text-sm text-nord-7">{{ $log->created_at->format('H.i') }}</h3>
                                </div>
                                <div class="text-sm textcontent changelogcontent">@markdown($this->getContent($log->file))</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
