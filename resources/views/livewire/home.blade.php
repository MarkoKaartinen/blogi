<div>
    <div class="text-left px-6 md:px-0">
        <h1 class="font-extrabold text-3xl md:text-4xl lg:text-5xl mb-4">
            <span class="text-nord-9">M</span>arko<span class="block md:hidden"></span><span class="text-nord-9">K</span>aartinen.net
        </h1>
        <div class="pb-6">
            @markdown($markdown)
        </div>

        <div class="pb-6 md:pb-12">
            <a class="rounded-xl bg-brand-mastodon text-nord-4 inline-flex items-center font-bold tracking-wider duration-300 transition-colors overflow-hidden group" rel="me" href="https://kaartinen.social/@marko">
                    <span class="p-2 border-brand-mastodon border-2">
                        <svg class="w-6 h-6 fill-current" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Mastodon</title><path d="M23.268 5.313c-.35-2.578-2.617-4.61-5.304-5.004C17.51.242 15.792 0 11.813 0h-.03c-3.98 0-4.835.242-5.288.309C3.882.692 1.496 2.518.917 5.127.64 6.412.61 7.837.661 9.143c.074 1.874.088 3.745.26 5.611.118 1.24.325 2.47.62 3.68.55 2.237 2.777 4.098 4.96 4.857 2.336.792 4.849.923 7.256.38.265-.061.527-.132.786-.213.585-.184 1.27-.39 1.774-.753a.057.057 0 0 0 .023-.043v-1.809a.052.052 0 0 0-.02-.041.053.053 0 0 0-.046-.01 20.282 20.282 0 0 1-4.709.545c-2.73 0-3.463-1.284-3.674-1.818a5.593 5.593 0 0 1-.319-1.433.053.053 0 0 1 .066-.054c1.517.363 3.072.546 4.632.546.376 0 .75 0 1.125-.01 1.57-.044 3.224-.124 4.768-.422.038-.008.077-.015.11-.024 2.435-.464 4.753-1.92 4.989-5.604.008-.145.03-1.52.03-1.67.002-.512.167-3.63-.024-5.545zm-3.748 9.195h-2.561V8.29c0-1.309-.55-1.976-1.67-1.976-1.23 0-1.846.79-1.846 2.35v3.403h-2.546V8.663c0-1.56-.617-2.35-1.848-2.35-1.112 0-1.668.668-1.67 1.977v6.218H4.822V8.102c0-1.31.337-2.35 1.011-3.12.696-.77 1.608-1.164 2.74-1.164 1.311 0 2.302.5 2.962 1.498l.638 1.06.638-1.06c.66-.999 1.65-1.498 2.96-1.498 1.13 0 2.043.395 2.74 1.164.675.77 1.012 1.81 1.012 3.12z"></path></svg>
                    </span>
                <span class="p-2 bg-nord-0 rounded-xl text-nord-4 group-hover:bg-brand-mastodon group-hover:text-nord-4 transition-colors duration-300 border-brand-mastodon border-2">@marko<span class="hidden sm:inline">@kaartinen.social</span></span>
            </a>
        </div>

        <div class="h-1 w-20 rounded-full bg-nord-9 mb-6 md:mb-12"></div>

        <div class="grid grid-cols-1 gap-12">
            <div>
                <div><h2 class="font-extrabold text-3xl">Blogissa</h2></div>
                <div class="mt-6">
                    <livewire:show-articles cols="grid-cols-1 md:grid-cols-2" limit="4" :paginate="false" heading="h3" spacing="small" />
                </div>
            </div>

            <div>
                <div class="flex items-center">
                    <div class="flex items-center mr-4">
                        <a class="text-brand-mastodon hover:text-opacity-80" href="https://kaartinen.social/@marko" rel="me">
                            <svg class="size-8 fill-current" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Mastodon</title><path d="M23.268 5.313c-.35-2.578-2.617-4.61-5.304-5.004C17.51.242 15.792 0 11.813 0h-.03c-3.98 0-4.835.242-5.288.309C3.882.692 1.496 2.518.917 5.127.64 6.412.61 7.837.661 9.143c.074 1.874.088 3.745.26 5.611.118 1.24.325 2.47.62 3.68.55 2.237 2.777 4.098 4.96 4.857 2.336.792 4.849.923 7.256.38.265-.061.527-.132.786-.213.585-.184 1.27-.39 1.774-.753a.057.057 0 0 0 .023-.043v-1.809a.052.052 0 0 0-.02-.041.053.053 0 0 0-.046-.01 20.282 20.282 0 0 1-4.709.545c-2.73 0-3.463-1.284-3.674-1.818a5.593 5.593 0 0 1-.319-1.433.053.053 0 0 1 .066-.054c1.517.363 3.072.546 4.632.546.376 0 .75 0 1.125-.01 1.57-.044 3.224-.124 4.768-.422.038-.008.077-.015.11-.024 2.435-.464 4.753-1.92 4.989-5.604.008-.145.03-1.52.03-1.67.002-.512.167-3.63-.024-5.545zm-3.748 9.195h-2.561V8.29c0-1.309-.55-1.976-1.67-1.976-1.23 0-1.846.79-1.846 2.35v3.403h-2.546V8.663c0-1.56-.617-2.35-1.848-2.35-1.112 0-1.668.668-1.67 1.977v6.218H4.822V8.102c0-1.31.337-2.35 1.011-3.12.696-.77 1.608-1.164 2.74-1.164 1.311 0 2.302.5 2.962 1.498l.638 1.06.638-1.06c.66-.999 1.65-1.498 2.96-1.498 1.13 0 2.043.395 2.74 1.164.675.77 1.012 1.81 1.012 3.12z"/></svg>
                        </a>
                    </div>
                    <h2 class="font-extrabold text-3xl">Mastodonissa</h2>
                </div>
                <div class="mt-6">
                    <livewire:show-mastodon />
                </div>
            </div>

            <div>
                <div class="flex items-center">
                    <div class="flex items-center mr-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-8 text-nord-9">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" />
                        </svg>
                    </div>
                    <div><h2 class="font-extrabold text-3xl">Muutosloki</h2></div>
                </div>
                <div class="mt-6 space-y-4">
                    @foreach($this->getRecentChanges() as $change)
                        <div>
                            <div class="text-sm mb-1 uppercase text-nord-8">
                                {{ $change->created_at->format("j.n.Y \k\l\o H:i") }}
                            </div>
                            <div class="text-sm textcontent changelogcontent">@markdown($this->getContent($change->file))</div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    <a class="text-nord-11 text-sm hover:text-nord-12 transition-colors duration-300 inline-flex items-center" href="{{ route('changelog') }}" wire:navigate>
                        <span>Koko muutosloki</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="ml-1 size-4">
                            <path fill-rule="evenodd" d="M12.78 7.595a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06l2.72-2.72-2.72-2.72a.75.75 0 0 1 1.06-1.06l3.25 3.25Zm-8.25-3.25 3.25 3.25a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06l2.72-2.72-2.72-2.72a.75.75 0 0 1 1.06-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
