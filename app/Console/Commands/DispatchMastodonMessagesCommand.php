<?php

namespace App\Console\Commands;

use App\Jobs\SendMastodonMessageJob;
use App\Models\Article;
use Illuminate\Console\Command;

class DispatchMastodonMessagesCommand extends Command
{
    protected $signature = 'blogi:dispatch-mastodon-messages';

    protected $description = 'Dispatchs job that sends Mastodon message if article is published';

    public function handle(): void
    {
        $articles = Article::published()
            ->where('post_to_mastodon', true)
            ->whereNull('mastodon_post_id')
            ->where('legacy', false)
            ->get();

        foreach ($articles as $article){
            SendMastodonMessageJob::dispatch($article);
        }
    }
}
