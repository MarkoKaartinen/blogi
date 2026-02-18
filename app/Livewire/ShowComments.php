<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowComments extends Component
{
    public ?string $mastodonStatus;

    public int $commentableId;

    public string $commentableType;

    public array $comments = [];

    public array $mastodonReplies;

    public array $blogReplies = [];

    public ?int $replyingTo = null;

    public function mount()
    {
        $this->getMastodonComments();
        $this->getComments();
        $this->getLegacyComments();
        $this->sortComments();
    }

    #[On('startReply')]
    public function startReply(int $commentId): void
    {
        $this->replyingTo = $commentId;
    }

    #[On('cancelReply')]
    public function cancelReply(): void
    {
        $this->replyingTo = null;
    }

    #[On('commentCreated')]
    public function commentCreated(int $commentId): void
    {
        $comment = Comment::with('user')->find($commentId);
        if (! $comment) {
            return;
        }

        // Add new comment to the list
        $this->comments[] = [
            'type' => 'blog',
            'comment' => $comment,
            'timestamp' => $comment->created_at->timestamp,
        ];

        // Re-sort comments by timestamp
        $this->sortComments();
    }

    #[On('replyCreated')]
    public function replyCreated(int $commentId, int $parentId): void
    {
        $comment = Comment::with('user')->find($commentId);
        if (! $comment) {
            return;
        }

        // Add reply to the blogReplies structure
        if (! isset($this->blogReplies[$parentId])) {
            $this->blogReplies[$parentId] = [];
        }
        $this->blogReplies[$parentId][] = $comment;
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

    public function getLegacyComments(): void
    {
        if ($this->commentableType !== Article::class) {
            return;
        }

        $article = Article::find($this->commentableId);
        if (! $article) {
            return;
        }

        foreach ($article->legacyComments as $comment) {
            $this->comments[] = [
                'type' => 'legacy',
                'comment' => $comment,
                'timestamp' => $comment->created_at->timestamp,
            ];
        }
    }

    public function getComments(): void
    {
        $allComments = Comment::with('user')
            ->where('commentable_type', $this->commentableType)
            ->where('commentable_id', $this->commentableId)
            ->get();
        $rootComments = [];
        $replies = [];

        foreach ($allComments as $comment) {
            if ($comment->parent_id === null) {
                $rootComments[] = $comment;
            } else {
                $replies[$comment->parent_id][] = $comment;
            }
        }

        $this->blogReplies = $replies;

        foreach ($rootComments as $comment) {
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
