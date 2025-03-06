<div class="columns-1 md:columns-2 lg:columns-3 gap-6 md:gap-12">
    @foreach($this->getPosts() as $post)
        <div class="break-inside-avoid pb-6 md:pb-12">
            <div class="flex flex-col">
                <div class="mt-1 text-sm uppercase text-nord-8 mb-2">
                    <a href="{{ $post->url }}" class="hover:underline">
                        {{ \Carbon\Carbon::parse($post->created_at)->setTimezone('Europe/Helsinki')->format('j.n.Y \k\l\o H:i') }}
                    </a>
                </div>

                <div x-data="{
                    showMore: false,
                    showMoreClicked: false,
                    init() {
                      this.$nextTick(() => {
                        if (this.$refs.description.scrollHeight === this.$refs.description.clientHeight) {
                           this.showMore = true
                        }
                      });
                    }
                  }">
                    <div class="text-sm textcontent mastodoncontent" x-ref="description" :class="{ 'line-clamp-4': !showMore }">{!! $post->content !!}</div>
                    <div class="pt-2">
                        <button x-show="!showMore" @click.prevent="showMore = true; showMoreClicked = true" class=" text-sm text-nord-11 hover:text-nord-12 transition-colors duration-300">
                            Lue lisää...
                        </button>
                        <button x-show="showMoreClicked" @click.prevent="showMore = false; showMoreClicked = false" class=" text-sm text-nord-11 hover:text-nord-12 transition-colors duration-300">
                            Lue vähemmän...
                        </button>
                    </div>
                </div>

                @if(is_array($post->media_attachments) && count($post->media_attachments) > 0)
                    <div class="mt-2 mb-1">
                        <div class="grid grid-cols-2 sm:grid-cols-1 gap-4">
                            @foreach($post->media_attachments as $attachment)
                                <div>
                                    <a href="{{ $attachment->url }}" class="glightbox">
                                        <img class="rounded-xl border-2 border-nord-10 aspect-square object-cover object-center" src="{{ $attachment->preview_url }}" alt="{{ $attachment->description }}" />
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($post->poll))
                    <div class="mt-2 space-y-1">
                        @foreach($post->poll->options as $option)
                            @php
                            $percentage = round($option->votes_count/$post->poll->votes_count*100);
                            @endphp
                            <div class="text-xs bg-theme-0/30 border border-nord-10 relative">
                                <div class="bg-nord-10/50 h-full absolute left-0 top-0" style="width: {{ $percentage }}%;"></div>
                                <div class="flex justify-between p-1.5 relative z-[2]">
                                    <div>
                                        {{ $option->title }}
                                    </div>
                                    <div class="text-right">
                                        {{ $percentage }} %
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="flex space-x-4 pt-2 mt-auto">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 6 21c1.282 0 2.47-.402 3.445-1.087.81.22 1.668.337 2.555.337Z" />
                        </svg>

                        <span class="text-sm ml-1 leading-none">
                            {{ $post->replies_count }}
                        </span>
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
                        </svg>

                        <span class="text-sm ml-1 leading-none">
                            {{ $post->reblogs_count }}
                        </span>
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                        </svg>

                        <span class="text-sm ml-1 leading-none">
                            {{ $post->favourites_count }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
