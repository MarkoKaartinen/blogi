<div>
    <div class="text-left px-6 md:px-0">
        <h1 class="font-extrabold text-3xl md:text-4xl lg:text-5xl mb-4">
            <span class="text-nord-9">M</span>arko<span class="block md:hidden"></span><span class="text-nord-9">K</span>aartinen.net
        </h1>
        <div class="pb-6 md:pb-12">
            @markdown($markdown)
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
                <div><h2 class="font-extrabold text-3xl">Mastodonissa</h2></div>
                <div class="mt-6">
                    <livewire:show-mastodon />
                </div>
            </div>
        </div>

    </div>
</div>
