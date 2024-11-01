<?php

namespace App\Jobs;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class SendMastodonMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Article $article
    ){}

    public function handle(): void
    {
        $message = "Julkaisin juuri uuden artikkelin blogiini!\n\n";
        $message .= $this->article->title."\n\n";
        $message .= $this->article->url;

        $tags = [];
        foreach ($this->article->tags as $tag){
            $tags[] = "#".$tag->slug;
        }

        if(count($tags) > 0){
            $message .= "\n\n".collect($tags)->implode(' ');
        }

        $url = config('services.mastodon.instance').'/api/v1/statuses';
        $response = Http::withToken(config('services.mastodon.token'))
            ->post($url, [
                'status' => $message,
                'visibility' => 'public',
                'language' => 'fi',
            ]);

        if($response->successful()){
            $status_id = $response->object()->id;
            $this->article->mastodon_post_id = $status_id;
            $this->article->save();
            Cache::flush();
        }
    }

    public function middleware(): array
    {
        return [new WithoutOverlapping($this->article->id)];
    }
}
