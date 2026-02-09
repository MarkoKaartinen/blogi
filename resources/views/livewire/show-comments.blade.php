<div class=" max-w-2xl w-full">
    @foreach($comments as $comment)
        <x-comment :type="$comment['type']" :comment="$comment['comment']" />
        @if($comment['type'] == 'mastodon')

            @if(isset($mastodonReplies[$comment['comment']->id]))
                <div class=" pl-6">
                    <x-mastodon.replies :status="$comment['comment']->id" :replies="$mastodonReplies" />
                </div>
            @endif
        @endif
    @endforeach
</div>
