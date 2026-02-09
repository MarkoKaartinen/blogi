<?php

namespace App\Livewire;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ShowComments extends Component
{
    public ?string $mastodonStatus;

    public int $articleId;

    public array $comments = [];

    public array $mastodonReplies;

    public function mount()
    {
        $this->getMastodonComments();
        $this->getComments();
        $this->getLegacyComments();
        $this->sortComments();
    }

    public function render()
    {
        return view('livewire.show-comments');
    }

    public function sortComments()
    {
        // Järjestä kommentit aikaleiman mukaan (ei enää timestamp-avaimia)
        $this->comments = collect($this->comments)
            ->sortBy('timestamp')
            ->values()
            ->toArray();
    }

    public function getLegacyComments()
    {
        $article = Article::find($this->articleId);
        if (! $article) {
            return;
        }

        // Käytetään Article-mallin legacyComments-relaatiota
        foreach ($article->legacyComments as $comment) {
            $this->comments[] = [
                'type' => 'legacy',
                'comment' => $comment,
                'timestamp' => $comment->created_at->timestamp,
            ];
        }
    }

    public function getComments()
    {
        $article = Article::find($this->articleId);
        if (! $article) {
            return;
        }

        // Käytetään Article-mallin comments-relaatiota
        $comments = $article->comments()->whereNull('parent_id')->get();
        foreach ($comments as $comment) {
            $this->comments[] = [
                'type' => 'blog',
                'comment' => $comment,
                'timestamp' => $comment->created_at->timestamp,
            ];
        }
    }

    public function getMastodonComments()
    {
        if ($this->mastodonStatus != null) {
            $status = $this->mastodonStatus;
            $cacheKey = 'mastodon_comments_'.$status;
            $data = Cache::remember($cacheKey, 60 * 5, function () use ($status) {
                $comments = [];
                $replies = [];
                $statusUrl = config('services.mastodon.instance').'/api/v1/statuses/'.$status.'/context';
                $response = Http::withToken(config('services.mastodon.token'))->get($statusUrl);
                if ($response->successful()) {
                    $object = $response->object();
                    if (isset($object->descendants)) {
                        $mastodonComments = $object->descendants;
                        if (is_array($mastodonComments) && count($mastodonComments) > 0) {
                            $rootComments = [];
                            $commentReplies = [];
                            foreach ($mastodonComments as $comment) {
                                if (in_array($comment->visibility, ['public', 'unlisted'])) {
                                    if ($comment->in_reply_to_id === $status) {
                                        $rootComments[] = $comment;
                                    } else {
                                        $commentReplies[$comment->in_reply_to_id][] = $comment;
                                    }
                                }
                            }
                            $comments = $rootComments;
                            $replies = $commentReplies;
                        }
                    }
                }

                return [
                    'replies' => $replies,
                    'comments' => $comments,
                ];
            });

            $this->mastodonReplies = $data['replies'];
            foreach ($data['comments'] as $comment) {
                $timestamp = Carbon::create($comment->created_at)->timezone('Europe/Helsinki')->timestamp;

                $this->comments[] = [
                    'type' => 'mastodon',
                    'comment' => $comment,
                    'timestamp' => $timestamp,
                ];
            }
        }
    }
}
