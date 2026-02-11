<div class=" max-w-2xl w-full">
    @foreach($comments as $comment)
        <div id="comment-{{ $comment['comment']->id }}">
            <x-comment :type="$comment['type']" :comment="$comment['comment']" />

            @if($comment['type'] == 'blog' && $replyingTo === $comment['comment']->id)
                <div class="pl-6 mb-6">
                    <livewire:post-comment :article-id="$articleId" :reply-to="$comment['comment']->id" :key="'reply-'.$comment['comment']->id" />
                </div>
            @endif

            @if($comment['type'] == 'mastodon')
                @if(isset($mastodonReplies[$comment['comment']->id]))
                    <div class=" pl-6">
                        <x-mastodon.replies :status="$comment['comment']->id" :replies="$mastodonReplies" />
                    </div>
                @endif
            @endif
            @if($comment['type'] == 'blog')
                @if(isset($blogReplies[$comment['comment']->id]))
                    <x-blog.replies :comment-id="$comment['comment']->id" :replies="$blogReplies" :replying-to="$replyingTo" :article-id="$articleId" />
                @endif
            @endif
        </div>
    @endforeach
</div>
