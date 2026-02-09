<div>
    <div class="text-left wrapper">
        <h1 class="font-extrabold text-3xl md:text-4xl lg:text-5xl">
            {{ $title }}
        </h1>
        <div class="pb-6 mt-6 textcontent">@markdown($markdown)</div>

        <div class="h-1 w-20 rounded-full bg-nord-9 mb-6 md:mb-12"></div>

        <form wire:submit="sendMessage">
            <x-honeypot livewire-model="extraFields" />
            <div class="grid grid-cols-1 gap-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="nickname" class="block text-sm uppercase">Nimimerkki</label>
                        <input wire:model="nickname" nickname class="w-full bg-transparent border-2 rounded mt-1 border-nord-12 py-2 px-2 focus:outline-none focus:border-nord-13 text-base" type="text" name="nickname" required />
                        <div class="text-xs text-nord-11 mt-1">@error('nickname') {{ $message }} @enderror</div>
                    </div>
                    <div>
                        <label for="homepage" class="block text-sm uppercase">Kotisivut</label>
                        <input wire:model="homepage" class="w-full bg-transparent border-2 rounded mt-1 border-nord-12 py-2 px-2 focus:outline-none focus:border-nord-13 text-base" type="url" name="homepage" />
                        <div class="text-xs text-nord-11 mt-1">@error('homepage') {{ $message }} @enderror</div>
                    </div>
                </div>
                <div>
                    <label for="message" class="block text-sm uppercase">Viesti</label>
                    <textarea wire:model="message" id="message" class="w-full bg-transparent border-2 rounded mt-1 border-nord-12 py-2 px-2 focus:outline-none focus:border-nord-13 text-base" name="message" rows="6" required></textarea>
                    <div class="text-xs text-nord-11">@error('message') {{ $message }} @enderror</div>
                </div>
                <div>
                    <button type="submit" class="inline-block bg-nord-14 text-nord-0 font-bold uppercase px-3 py-3 leading-none border-2 border-nord-14 rounded hover:bg-transparent hover:text-nord-14 transition-colors duration-300 text-base" >Lähetä viesti</button>
                </div>

                @if($feedback)
                    <div class="text-nord-14">{{ $feedback }}</div>
                @endif
            </div>
        </form>

        <div class="h-1 w-20 rounded-full bg-nord-9 my-6 md:my-12"></div>

        @if(count($messages) == 0)
            <p>Vieraskirjassa ei ole vielä viestejä. Ole rohkeasti ensimmäinen!</p>
        @endif

        <div class="scroll-mt-20" id="messages">
            @foreach($messages as $msg)
                <div class="my-6 bg-nord-1 border-2 border-nord-10 rounded-2xl overflow-clip">
                    <div class="py-2 px-3 bg-theme-0 flex justify-between items-center">
                        <div class="text-sm font-bold">
                            @if($msg->homepage)
                                <a href="{{ $msg->homepage }}" class="transition-colors duration-300 hover:text-nord-14 inline-flex items-center gap-1">
                                    {{ $msg->nickname }}
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 text-nord-8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                                    </svg>
                                </a>
                            @else
                                {{ $msg->nickname }}
                            @endif
                        </div>
                        <div class="text-xs text-right">
                            {{ $msg->created_at->diffForHumans() }}
                        </div>
                    </div>

                    <div class="p-3">
                        <div class="text-sm whitespace-pre-line">{{ $msg->message }}</div>
                    </div>

                    @if($msg->reply)
                        <div class="mx-2 mb-2 border-2 border-nord-11 bg-nord-0 rounded-2xl overflow-clip">
                            <div class="py-2 px-3 bg-theme-0 flex justify-between items-center">
                                <div class="text-sm font-bold">Marko</div>
                                <div class="text-xs text-right">
                                    {{ $msg->replied_at->diffForHumans() }}
                                </div>
                            </div>
                            <div class="p-3">
                                <div class="text-sm whitespace-pre-line">{{ $msg->reply }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        {{ $messages->links(view: 'pagination', data: ['scrollTo' => '#messages']) }}
    </div>
</div>
