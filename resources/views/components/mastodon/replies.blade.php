<div>
    @foreach($replies[$status] as $comment)
        <x-comment type="mastodon" :comment="$comment" />
        @if(isset($replies[$comment->id]))
            <div>
                <x-mastodon.replies :status="$comment->id" :replies="$replies" />
            </div>
        @endif
    @endforeach
</div>
