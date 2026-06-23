<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Throwable;

class ShowMastodon extends Component
{
    public function render()
    {
        return view('livewire.show-mastodon');
    }

    #[Computed]
    public function getPosts(): Collection
    {
        return Cache::remember('mastodon_posts_v2', 1800, function (): Collection {
            $url = config('services.mastodon.instance').'/api/v1/accounts/'.config('services.mastodon.user_id').'/statuses?exclude_replies=true';

            try {
                $response = Http::timeout(5)->connectTimeout(5)->get($url);
            } catch (Throwable $exception) {
                report($exception);

                return collect();
            }

            if ($response->failed()) {
                report("Mastodon request failed with status [{$response->status()}] for [{$url}]");

                return collect();
            }

            return collect($response->object())
                ->where('visibility', 'public')
                ->whereNull('in_reply_to_id')
                ->where('content', '!=', '')
                ->where('sensitive', false)
                ->take(6);
        });
    }
}
