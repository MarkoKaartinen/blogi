<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MastodonReactions extends Component
{
    public $status;

    public function render()
    {
        return view('livewire.mastodon-reactions', [
            'data' => $this->getStatus()
        ]);
    }

    public function getStatus()
    {
        $status = $this->status;
        $cacheKey = 'mastodon_status_'.$status;
        return Cache::remember($cacheKey, 60*5, function() use ($status){
            $data = [
                'replies_count' => 0,
                'reblogs_count' => 0,
                'favourites_count' => 0,
            ];
            $statusUrl = config('services.mastodon.instance').'/api/v1/statuses/'.$status;
            $response = Http::withToken(config('services.mastodon.token'))->get($statusUrl);
            if($response->successful()){
                $data = [
                    'replies_count' => $response->object()->replies_count,
                    'reblogs_count' => $response->object()->reblogs_count,
                    'favourites_count' => $response->object()->favourites_count,
                ];
            }
            return (object) $data;
        });
    }
}
