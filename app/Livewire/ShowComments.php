<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\LegacyComment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ShowComments extends Component
{
    public ?string $mastodonStatus;
    public int $articleId;

    public array $comments;
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
        $this->comments = collect($this->comments)->sortKeys()->toArray();
    }

    public function getLegacyComments()
    {
        $comments = LegacyComment::where('article_id', $this->articleId)->get();
        foreach ($comments as $comment){
            $this->comments[$comment->created_at->timestamp][] = [
                'type' => 'legacy',
                'comment' => $comment,
            ];
        }
    }

    public function getComments()
    {
        $comments = Comment::where('article_id', $this->articleId)->whereNull('parent_id')->get();
        foreach ($comments as $comment){
            $this->comments[$comment->created_at->timestamp][] = [
                'type' => 'blog',
                'comment' => $comment,
            ];
        }
    }

    public function getMastodonComments()
    {
        if($this->mastodonStatus != null){
            $status = $this->mastodonStatus;
            $cacheKey = 'mastodon_comments_'.$status;
            $data = Cache::remember($cacheKey, 60*5, function() use ($status){
                $comments = [];
                $replies = [];
                $statusUrl = config('services.mastodon.instance').'/api/v1/statuses/'.$status.'/context';
                $response = Http::withToken(config('services.mastodon.token'))->get($statusUrl);
                if($response->successful()){
                    $object = $response->object();
                    if(isset($object->descendants)){
                        $mastodonComments = $object->descendants;
                        if(is_array($mastodonComments) && count($mastodonComments) > 0){
                            $rootComments = [];
                            $commentReplies = [];
                            foreach ($mastodonComments as $comment){
                                if(in_array($comment->visibility, ['public', 'unlisted'])){
                                    if($comment->in_reply_to_id === $status){
                                        $rootComments[] = $comment;
                                    }else{
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
                    'comments' => $comments
                ];
            });

            $this->mastodonReplies = $data['replies'];
            foreach ($data['comments'] as $comment){
                $timestamp = Carbon::create($comment->created_at)->timezone('Europe/Helsinki')->timestamp;

                $this->comments[$timestamp][] = [
                    'type' => 'mastodon',
                    'comment' => $comment,
                ];
            }
        }
    }
}
