@extends('front.layouts.app')

@section('content')
    @if($post->status != "published")
        <div class="bg-danger text-white rounded px-3 py-2 mb-6 text-base opacity-75">
            Artikkelia ei ole vielä julkaistu! ({{ $post->status }})
        </div>
    @endif
    <h2>{{ $post->title }}</h2>
    <div class="mb-6 text-sm">
        <span>Julkaistu {{ $post->created_at->diffForHumans() }}</span>
        @if($post->created_at != $post->updated_at)
            &bullet; <span>Muokattu {{ $post->updated_at->diffForHumans() }}</span>
        @endif
    </div>

    <div class="mb-6">
        {!! $post->body !!}
    </div>

    <div class="text-sm">
        @if(auth()->user()->isAdmin())
            <a class="" href="{{ route('admin.posts.edit', ["post" => $post->id]) }}">Muokkaa artikkelia</a>
        @endif
    </div>
@endsection