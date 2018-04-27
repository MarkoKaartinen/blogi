@extends('admin.layouts.app')

@section('content')
    <div class="flex items-center justify-between">
        <h2>Artikkelit</h2>
        <a href="{{ route('admin.posts.create') }}" class="btn" >Uusi artikkeli</a>
    </div>

    <table class="mb-6 mt-6 w-full">
        <thead>
            <tr>
                <th class="text-left uppercase text-xs px-2 py-2 bg-info-light">Artikkeli</th>
                <th class="text-left uppercase text-xs px-2 py-2 bg-info-light">Kirjoittaja</th>
                <th class="text-left uppercase text-xs px-2 py-2 bg-info-light">Kategoriat</th>
                <th class="text-left uppercase text-xs px-2 py-2 bg-info-light">Avainsanat</th>
                <th class="text-left uppercase text-xs px-2 py-2 bg-info-light">Kommentit</th>
                <th class="text-left uppercase text-xs px-2 py-2 bg-info-light">Päivämäärä</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
                <tr class="text-lg">
                    <td class="px-3 py-2 bg-info-lightest">
                        <div class="flex items-center mb-2 justify-between">
                            <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class="text-brand font-medium hover:underline block">
                                {{ $post->title }}
                            </a>
                            @if($post->status == 'draft')
                                <span class=" block rounded-full bg-info text-xs px-2 py-1 uppercase text-white font-bold leading-none">{{ $post->status }}</span>
                            @endif

                            @if($post->status == 'published')
                                <span class=" block rounded-full bg-success text-xs px-2 py-1 uppercase text-white font-bold leading-none">{{ $post->status }}</span>
                            @endif
                        </div>

                        <div class="text-sm">
                            <a href="{{ route('front.posts.show', ['slug' => $post->slug]) }}" class="mr-6">Näytä</a>
                            <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class="mr-6">Muokkaa</a>
                            <a href="#" class="text-danger">Siirrä roskakoriin</a>
                        </div>
                    </td>
                    <td class="px-2 py-2 bg-info-lightest text-sm">{{ $post->user->nickname }}</td>
                    <td class="px-2 py-2 bg-info-lightest text-sm"></td>
                    <td class="px-2 py-2 bg-info-lightest text-sm"></td>
                    <td class="px-2 py-2 bg-info-lightest text-sm"></td>
                    <td class="px-2 py-2 bg-info-lightest text-sm">{{ $post->created_at->format("j.n.Y H:i:s") }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $posts->links() }}
@endsection