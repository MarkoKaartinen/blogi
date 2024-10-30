<?php

namespace App\Livewire;

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
        $comments = [];
        $replies = [];
        $statusUrl = config('services.mastodon.instance').'/api/v1/statuses/'.$this->status.'/context';
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
                            if($comment->in_reply_to_id === $this->status){
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
        $this->data = [
            'replies' => $replies,
            'comments' => $comments
        ];
    }
}
