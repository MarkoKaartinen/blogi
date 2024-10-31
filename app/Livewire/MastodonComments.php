<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class MastodonComments extends Component
{
    public string $status;
    public $data;

    public function render()
    {
        return view('livewire.mastodon-comments');
    }

    public function mount()
    {
        $this->getComments();
    }

    public function getComments()
    {
        $status = $this->status;
        $cacheKey = 'mastodon_comments_'.$status;
        $this->data = Cache::remember($cacheKey, 60*5, function() use ($status){
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


    }
}
