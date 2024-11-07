@props(['comment'])
<div class="my-6 bg-nord-1 border-2 border-brand-mastodon rounded-2xl flex flex-col overflow-clip">
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

            <div class="">
                <div class="flex items-center">
                    <div class="text-xs text-right mr-2">
                        <a href="{{ $comment->url }}" class="hover:underline">
                            {{ \Carbon\Carbon::create($comment->created_at)->timezone('Europe/Helsinki')->diffForHumans() }}
                        </a>
                    </div>
                    <div>
                        <a href="{{ $comment->url }}" class="text-brand-mastodon hover:text-nord-8 transition-colors duration-300">
                            <svg class="fill-current size-5" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Mastodon</title><path d="M23.268 5.313c-.35-2.578-2.617-4.61-5.304-5.004C17.51.242 15.792 0 11.813 0h-.03c-3.98 0-4.835.242-5.288.309C3.882.692 1.496 2.518.917 5.127.64 6.412.61 7.837.661 9.143c.074 1.874.088 3.745.26 5.611.118 1.24.325 2.47.62 3.68.55 2.237 2.777 4.098 4.96 4.857 2.336.792 4.849.923 7.256.38.265-.061.527-.132.786-.213.585-.184 1.27-.39 1.774-.753a.057.057 0 0 0 .023-.043v-1.809a.052.052 0 0 0-.02-.041.053.053 0 0 0-.046-.01 20.282 20.282 0 0 1-4.709.545c-2.73 0-3.463-1.284-3.674-1.818a5.593 5.593 0 0 1-.319-1.433.053.053 0 0 1 .066-.054c1.517.363 3.072.546 4.632.546.376 0 .75 0 1.125-.01 1.57-.044 3.224-.124 4.768-.422.038-.008.077-.015.11-.024 2.435-.464 4.753-1.92 4.989-5.604.008-.145.03-1.52.03-1.67.002-.512.167-3.63-.024-5.545zm-3.748 9.195h-2.561V8.29c0-1.309-.55-1.976-1.67-1.976-1.23 0-1.846.79-1.846 2.35v3.403h-2.546V8.663c0-1.56-.617-2.35-1.848-2.35-1.112 0-1.668.668-1.67 1.977v6.218H4.822V8.102c0-1.31.337-2.35 1.011-3.12.696-.77 1.608-1.164 2.74-1.164 1.311 0 2.302.5 2.962 1.498l.638 1.06.638-1.06c.66-.999 1.65-1.498 2.96-1.498 1.13 0 2.043.395 2.74 1.164.675.77 1.012 1.81 1.012 3.12z"/></svg>
                        </a>
                    </div>
                </div>
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

