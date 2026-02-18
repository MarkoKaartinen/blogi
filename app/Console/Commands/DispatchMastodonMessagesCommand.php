<?php

namespace App\Console\Commands;

use App\Contracts\Mastodonable;
use App\Jobs\SendMastodonMessageJob;
use App\Models\Article;
use App\Models\Recipe;
use Illuminate\Console\Command;

class DispatchMastodonMessagesCommand extends Command
{
    protected $signature = 'blogi:dispatch-mastodon-messages';

    protected $description = 'Dispatches jobs that send Mastodon messages for published content';

    /** @var array<class-string<Mastodonable>> */
    protected array $mastodonableModels = [
        Article::class,
        Recipe::class,
    ];

    public function handle(): void
    {
        foreach ($this->mastodonableModels as $model) {
            foreach ($model::pendingMastodonDispatch() as $item) {
                SendMastodonMessageJob::dispatch($item);
            }
        }
    }
}
