<?php

namespace App\Models;

use App\Support\MarkdownHandler;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;
use Spatie\Feed\Feedable;
use Spatie\Tags\HasTags;
use Spatie\Feed\FeedItem;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Article extends Model implements Feedable
{
    use HasTags, Searchable;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'year',
        'slug',
        'file',
        'status',
        'updated_at',
        'published_at',
        'legacy'
    ];

    protected static function booted(): void
    {
        static::creating(function (Article $article) {
            $article->created_at = now();
        });
    }

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn() => route('article', [
                'year' => $this->year,
                'slug' => $this->slug,
            ])
        );
    }

    public function content()
    {
        $content = YamlFrontMatter::parse($this->file_content);
        return str($content->body())->trim();
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    protected function fileContent(): Attribute
    {
        return Attribute::make(
            get: fn() => MarkdownHandler::getArticle($this->year, $this->slug)
        );
    }

    protected function body(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->content()
        );
    }

    public function toFeedItem(): FeedItem
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->title)
            ->summary($this->description ?? '')
            ->updated($this->updated_at ?? $this->published_at)
            ->link($this->url)
            ->authorName('Marko Kaartinen')
            ->authorEmail('markokaartinen@gmail.com');
    }

    public function getFeedItems()
    {
        return Article::published()->limit(20)->get();
    }

    public function legacy_comments(): HasMany
    {
        return $this->hasMany(LegacyComment::class)->orderBy('created_at');
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => (string) $this->id,
            'title' => $this->title,
            'description' => $this->description ?? '',
            'published_at' => $this->published_at->timestamp,
            'body' => $this->body,
        ];
    }

    public function shouldBeSearchable(): bool
    {
        return $this->status == 'published' && $this->published_at < now();
    }

    public function searchableAs(): string
    {
        return 'articles_index';
    }
}
