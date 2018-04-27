@extends('admin.layouts.app')

@section('content')
    <h2 class="mb-6">Muokkaa artikkelia</h2>
    <form method="POST" action="{{ route('admin.posts.update', ['post' => $post->id]) }}">
        @csrf

        <div class="flex flex-col lg:flex-row">
            <div class="w-4/5 mr-3">
                <input name="title" type="text" value="{{ $post->title }}" class="w-full rounded shadow mb-3 border p-2" />
                <textarea rows="20" name="body" class="markdown-editor">{{ $post->markdown }}</textarea>
            </div>
            <div class="w-1/5">
                <button type="submit" class="btn">Tallenna</button>
            </div>
        </div>
    </form>
@endsection
