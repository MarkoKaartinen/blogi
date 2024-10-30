@props(['comment'])
<div class="my-6 bg-nord-1 border-2 border-nord-10 rounded-2xl flex flex-col overflow-clip">
    <div class="flex py-2 px-3 bg-theme-0">
        <div class="shrink-0 hidden md:block pr-4">
            <img class="h-20 rounded-2xl" src="{{ $comment->account->avatar }}" alt="Avatar of {{ $comment->account->display_name }}" />
        </div>
        <div class="grow flex justify-between">
            <div class="self-center">
                <div class="text-lg md:text-xl">
                    <a target="_blank" class="inline-flex flex-col" href="{{ $comment->account->url }}">
                        <span class="font-bold hover:underline">
                            {{ $comment->account->display_name }}
                        </span>
                        <span class="text-xs hover:underline">
                            {{ "@".$comment->account->acct }}
                        </span>
                    </a>
                </div>
                <div class="flex items-center space-x-1 pt-1 text-sm">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4">
                            <path d="m9.653 16.915-.005-.003-.019-.01a20.759 20.759 0 0 1-1.162-.682 22.045 22.045 0 0 1-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 0 1 8-2.828A4.5 4.5 0 0 1 18 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 0 1-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 0 1-.69.001l-.002-.001Z" />
                        </svg>
                    </div>
                    <div>
                        {{ $comment->favourites_count }}
                    </div>
                </div>
            </div>

            <div class="text-xs text-right">
                <a href="{{ $comment->url }}" class="hover:underline">
                    {{ \Carbon\Carbon::create($comment->created_at)->timezone('Europe/Helsinki')->diffForHumans() }}
                </a>
            </div>
        </div>
    </div>

    <div class="px-3 pb-3">
        <div class="text-sm textcontent">{!! $comment->content !!}</div>

        @if(is_array($comment->media_attachments) && count($comment->media_attachments) > 0)
            @php
                $images = [];
                $others = [];
                foreach ($comment->media_attachments as $attachment)
                    if($attachment->type === 'image'){
                        $images[] = $attachment;
                    }else{
                        $others[] = $attachment;
                    }
            @endphp
            <div class="space-y-4 pb-3">
                @if(count($images) > 0)
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($images as $attachment)
                            <div class="border-2 border-nord-10 rounded-2xl overflow-clip">
                                <a class="glightbox" data-glightbox="description: {{ $attachment->description }}" data-gallery="comment-gallery-{{ $comment->id }}" href="{{ $attachment->url }}" title="{{ $attachment->description }}" target="_blank">
                                    <img class="w-full aspect-square object-cover object-center" src="{{ $attachment->url }}" alt="{{ $attachment->description }}" />
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if(count($others) > 0)
                    <div>
                        <div class="font-bold">Muut liitteet:</div>
                        <ul class="list-disc pl-4">
                            @foreach($others as $attachment)
                                <li>
                                    <a class="hover:underline" href="{{ $attachment->url }}" title="{{ $attachment->description }}" target="_blank">
                                        {{ basename($attachment->url) }}
                                        @if($attachment->type != '')
                                            <small>({{ $attachment->type }})</small>
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        @endif
        <div class="flex">
            <a href="{{ $comment->url }}" class="hover:underline inline-flex items-center text-xs">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4">
                      <path fill-rule="evenodd" d="M7.793 2.232a.75.75 0 0 1-.025 1.06L3.622 7.25h10.003a5.375 5.375 0 0 1 0 10.75H10.75a.75.75 0 0 1 0-1.5h2.875a3.875 3.875 0 0 0 0-7.75H3.622l4.146 3.957a.75.75 0 0 1-1.036 1.085l-5.5-5.25a.75.75 0 0 1 0-1.085l5.5-5.25a.75.75 0 0 1 1.06.025Z" clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="ml-2 text-xs">
                    Vastaa Mastodonissa
                </span>
            </a>
        </div>
    </div>
</div>

