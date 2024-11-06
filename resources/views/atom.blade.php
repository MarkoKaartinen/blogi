<?=
/* Using an echo tag here so the `<? ... ?>` won't get parsed as short tags */
'<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL.
'<?xml-stylesheet href="/build/atom/atom.xsl" type="text/xsl"?>'
?>

<feed xmlns="http://www.w3.org/2005/Atom" xml:lang="fi-FI">
    <id>{{ route('feed') }}</id>
    <link href="{{ route('feed') }}" rel="self"></link>
    <title>{!! mrkCdata('MarkoKaartinen.net') !!}</title>

    <subtitle>MarkoKaartinen.net on yhden nörtin projekti ja sisältää sekalaista settiä niin tekniikasta kuin muusta nörtteilystä.</subtitle>
    <updated>{{ $feedUpdated->toRfc3339String() }}</updated>
    @foreach($articles as $article)
        <entry>
            <title>{!! mrkCdata($article->title) !!}</title>
            <link rel="alternate" href="{{ $article->url }}" />
            <id>{{ url($article->id) }}</id>
            <author>
                <name>{!! mrkCdata('Marko Kaartinen') !!}</name>
                <email>{!! mrkCdata('markokaartinen@gmail.com') !!}</email>
            </author>
            <summary type="html">{!! mrkCdata($article->seo_description) !!}</summary>
            <content type="html">{!! mrkCdata(app(Spatie\LaravelMarkdown\MarkdownRenderer::class)->toHtml($article->content())) !!}</content>
            <published>{{ $article->created_at->toRfc3339String() }}</published>
            <updated>{{ $article->updated_at !== null ? $article->updated_at->toRfc3339String() : $article->created_at->toRfc3339String() }}</updated>
            @foreach($article->tagsWithType('category') as $category)
                <category term="{{ $category->slug }}" label="{{ $category->name }}" />
            @endforeach
        </entry>
    @endforeach
</feed>
