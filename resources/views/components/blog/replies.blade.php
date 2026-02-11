@props(['commentId', 'replies', 'replyingTo', 'articleId'])
<div class="pl-6">
    @if(isset($replies[$commentId]))
        @foreach($replies[$commentId] as $reply)
            <div id="comment-{{ $reply->id }}">
                <x-comment type="blog" :comment="$reply" />

                @if($replyingTo === $reply->id)
                    <div class="pl-6 mb-6">
                        <livewire:post-comment :article-id="$articleId" :reply-to="$reply->id" :key="'reply-'.$reply->id" />
                    </div>
                @endif

                @if(isset($replies[$reply->id]))
                    <x-blog.replies :comment-id="$reply->id" :replies="$replies" :replying-to="$replyingTo" :article-id="$articleId" />
                @endif
            </div>
        @endforeach
    @endif
</div>
