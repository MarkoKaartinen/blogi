<div>
    @php
        $comments = $data['comments'];
        $replies = $data['replies'];
    @endphp
    @foreach($comments as $comment)
        <x-mastodon.comment :comment="$comment" />

        @if(isset($replies[$comment->id]))
            <div class=" pl-6">
                <x-mastodon.replies :status="$comment->id" :replies="$replies" />
            </div>
        @endif
    @endforeach
</div>
