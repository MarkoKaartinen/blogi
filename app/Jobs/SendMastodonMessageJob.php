<?php

namespace App\Jobs;

use App\Contracts\Mastodonable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SendMastodonMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Mastodonable $mastodonable
    ) {}

    public function handle(): void
    {
        $url = config('services.mastodon.instance').'/api/v1/statuses';
        $response = Http::withToken(config('services.mastodon.token'))
            ->post($url, [
                'status' => $this->mastodonable->mastodonMessage(),
                'visibility' => 'public',
                'language' => 'fi',
            ]);

        if ($response->successful()) {
            $this->mastodonable->saveMastodonStatus($response->object()->id);
        }
    }

    public function middleware(): array
    {
        return [new WithoutOverlapping(get_class($this->mastodonable).':'.$this->mastodonable->getKey())];
    }
}
