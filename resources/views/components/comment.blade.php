@props(['type', 'comment'])
@php
$border = 'border-nord-12';
if($type == 'mastodon'){
    $border = 'border-brand-mastodon';
    $commentName = $comment->account->display_name;
    if(isset($comment->account->emojis) && is_array($comment->account->emojis)){
        foreach($comment->account->emojis as $emoji){
            $commentName = str_replace(':'.$emoji->shortcode.':', '<img class="inline-block size-6 align-middle" src="'.$emoji->url.'" alt="'.$emoji->shortcode.'" title="'.$emoji->shortcode.'">', $commentName);
        }
    }

    $commentContent = $comment->content;
    if(isset($comment->emojis) && is_array($comment->emojis)){
        foreach($comment->emojis as $emoji){
            $commentContent = str_replace(':'.$emoji->shortcode.':', '<img class="inline-block my-0 size-6 align-middle" src="'.$emoji->url.'" alt="'.$emoji->shortcode.'" title="'.$emoji->shortcode.'">', $commentContent);
        }
    }
}
if($type == 'legacy'){
    $border = 'border-nord-15';
}
@endphp
<div class="my-6 bg-nord-1 border-2 {{ $border }} rounded-2xl flex flex-col overflow-clip">
    <div class="flex py-2 px-3 bg-theme-0">
        <div class="shrink-0 hidden md:block pr-4">
            @if($type == 'mastodon')
                <img class="h-20 rounded-2xl" src="{{ $comment->account->avatar }}" alt="Avatar of {{ $comment->account->display_name }}" />
            @endif
            @if($type == 'blog')
                <img class="h-16 rounded-2xl" src="https://api.dicebear.com/9.x/avataaars-neutral/png?size=200&backgroundColor=8fbcbb,88c0d0,81a1c1,5e81ac,bf616a,d08770,ebcb8b,a3be8c,b48ead&seed={{ urlencode(str($comment->nickname)->slug('')) }}" alt="Avatar of {{ $comment->nickname }}"
            @endif
            @if($type == 'legacy')
                <img class="h-16 rounded-2xl" src="https://api.dicebear.com/9.x/avataaars-neutral/png?size=200&backgroundColor=8fbcbb,88c0d0,81a1c1,5e81ac,bf616a,d08770,ebcb8b,a3be8c,b48ead&seed={{ urlencode(str($comment->name)->slug('')) }}" alt="Avatar of {{ $comment->name }}"
            @endif
        </div>
        <div class="grow flex justify-between">
            <div class="{{ $type == 'mastodon' ? 'self-center' : '' }}">
                <div class="text-lg md:text-xl">
                    @if($type == 'mastodon')
                        <a target="_blank" class="inline-flex flex-col" href="{{ $comment->account->url }}">
                            <span class="font-bold hover:underline">
                                {!! $commentName !!}
                            </span>
                            <span class="text-xs hover:underline">
                                {{ "@".$comment->account->acct }}{{ $comment->account->acct == 'marko' ? '@kaartinen.social' : '' }}
                            </span>
                        </a>
                    @endif
                    @if($type == 'blog')
                        {{ $comment->nickname }}
                    @endif
                    @if($type == 'legacy')
                        {{ $comment->name }}
                    @endif
                </div>
                @if($type == 'mastodon')
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
                @endif
            </div>

            <div class="">
                <div class="flex items-center">
                    @if($type == 'blog' || $type == 'legacy')
                        <div class="text-xs text-right mr-2">
                            {{ $comment->created_at->diffForHumans() }}
                        </div>
                        <div>
                            @if($type == 'blog')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 text-nord-12 hover:text-nord-8 transition-colors duration-300">
                                    <path d="M4.913 2.658c2.075-.27 4.19-.408 6.337-.408 2.147 0 4.262.139 6.337.408 1.922.25 3.291 1.861 3.405 3.727a4.403 4.403 0 0 0-1.032-.211 50.89 50.89 0 0 0-8.42 0c-2.358.196-4.04 2.19-4.04 4.434v4.286a4.47 4.47 0 0 0 2.433 3.984L7.28 21.53A.75.75 0 0 1 6 21v-4.03a48.527 48.527 0 0 1-1.087-.128C2.905 16.58 1.5 14.833 1.5 12.862V6.638c0-1.97 1.405-3.718 3.413-3.979Z" />
                                    <path d="M15.75 7.5c-1.376 0-2.739.057-4.086.169C10.124 7.797 9 9.103 9 10.609v4.285c0 1.507 1.128 2.814 2.67 2.94 1.243.102 2.5.157 3.768.165l2.782 2.781a.75.75 0 0 0 1.28-.53v-2.39l.33-.026c1.542-.125 2.67-1.433 2.67-2.94v-4.286c0-1.505-1.125-2.811-2.664-2.94A49.392 49.392 0 0 0 15.75 7.5Z" />
                                </svg>
                            @endif
                            @if($type == 'legacy')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 text-nord-15 hover:text-nord-8 transition-colors duration-300">
                                    <path d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375Z" />
                                    <path fill-rule="evenodd" d="m3.087 9 .54 9.176A3 3 0 0 0 6.62 21h10.757a3 3 0 0 0 2.995-2.824L20.913 9H3.087Zm6.163 3.75A.75.75 0 0 1 10 12h4a.75.75 0 0 1 0 1.5h-4a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                                </svg>
                            @endif
                        </div>
                    @endif
                    @if($type == 'mastodon')
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
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="px-3 pb-3">
        @if($type == 'legacy')
            <div class="whitespace-pre-line text-sm textcontent pt-3">{!! $comment->body !!}</div>
        @endif

        @if($type == 'blog')
            <div class="text-sm whitespace-pre-line pt-3">{{ $comment->comment }}</div>
        @endif

        @if($type == 'mastodon')
            <div class="text-sm textcontent">{!! $commentContent !!}</div>

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
        @endif
    </div>
</div>
