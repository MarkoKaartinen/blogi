<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ShowMastodon extends Component
{
    public function render()
    {
        return view('livewire.show-mastodon');
    }

    #[Computed]
    public function getPosts()
    {
        $url = config('services.mastodon.instance').'/api/v1/accounts/'.config('services.mastodon.user_id').'/statuses';
        $response = Http::get($url);

        return collect($response->object())
            ->where('visibility', 'public')
            ->whereNull('in_reply_to_id')
            ->where('content', '!=', '')
            ->where('sensitive', false)
            ->take(5);
    }

}
