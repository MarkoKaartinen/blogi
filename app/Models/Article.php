<?php

namespace App\Models;

use App\Contracts\Mastodonable;
use App\Support\MarkdownHandler;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Laravel\Scout\Searchable;
use Spatie\Tags\HasTags;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Article extends Model implements Mastodonable
{
    use HasTags, Searchable;

    public $timestamps = false;

    protected ?string $cachedFileContent = null;

    protected $fillable = [
        'title',
        'description',
        'year',
        'slug',
        'file',
        'status',
        'updated_at',
        'published_at',
        'legacy',
        'created_at',
        'mastodon_post_id',
        'igdb_id',
        'post_to_mastodon',
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
            'created_at' => 'datetime',
        ];
    }

    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn () => route('article', [
                'year' => $this->year,
                'slug' => $this->slug,
            ])
        );
    }

    public function content(): string
    {
        $content = YamlFrontMatter::parse($this->file_content);

        return str($content->body())->trim();
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    public function scopeUnpublished(Builder $query): Builder
    {
        return $query->where('status', 'draft');
    }

    protected function fileContent(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->cachedFileContent === null) {
                    $this->cachedFileContent = MarkdownHandler::getArticle($this->year, $this->slug);
                }

                return $this->cachedFileContent;
            }
        );
    }

    protected function body(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->content()
        );
    }

    protected function readingTime(): Attribute
    {
        return Attribute::make(
            get: fn () => max(1, (int) round(
                str($this->body)->stripTags()->wordCount() / config('blog.reading_speed')
            ))
        );
    }

    public static function pendingMastodonDispatch(): Collection
    {
        return static::query()
            ->published()
            ->where('post_to_mastodon', true)
            ->whereNull('mastodon_post_id')
            ->where('legacy', false)
            ->get();
    }

    public function mastodonMessage(): string
    {
        $message = "Julkaisin juuri uuden artikkelin blogiini!\n\n";
        $message .= $this->title."\n\n";

        if ($this->description) {
            $message .= $this->description."\n\n";
        }

        $message .= $this->url;

        $tags = [];
        foreach ($this->tags as $tag) {
            $tags[] = '#'.str($tag->name)->replace(' ', '');
        }

        if (count($tags) > 0) {
            $message .= "\n\n".collect($tags)->implode(' ');
        }

        return $message;
    }

    public function saveMastodonStatus(string $statusId): void
    {
        $this->mastodon_post_id = $statusId;
        $this->save();

        Cache::forget('article_'.$this->year.'_'.$this->slug);
        Cache::forget('article_'.$this->year.'_'.$this->slug.'_previous');
        Cache::forget('article_'.$this->year.'_'.$this->slug.'_next');
        Cache::forget('series_'.$this->year.'_'.$this->slug);
        Cache::forget('mastodon_comments_'.$statusId);
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function legacyComments(): HasMany
    {
        return $this->hasMany(LegacyComment::class)->orderBy('created_at');
    }

    public function toSearchableArray(): array
    {
        $this->load('tags');

        return [
            'id' => (int) $this->id,
            'year' => (int) $this->year,
            'slug' => $this->slug,
            'title' => $this->title,
            'description' => $this->seo_description,
            'published_at' => $this->published_at,
            'body' => $this->body,
            'url' => $this->url,
            'series' => $this->tagsWithType('series')->pluck('name')->toArray(),
            'categories' => $this->tagsWithType('category')->pluck('name')->toArray(),
            'tags' => $this->tagsWithType('tag')->pluck('name')->toArray(),
        ];
    }

    public function typesenseSearchParameters(): array
    {
        return [
            'highlight_full_fields' => 'description,title',
        ];
    }

    public function shouldBeSearchable(): bool
    {
        return $this->status == 'published' && $this->published_at < now();
    }

    public function searchableAs(): string
    {
        return 'mknet_articles_index';
    }

    protected function seoDescription(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->description ?? $this->parseDescription($this->body)
        );
    }

    private function parseDescription($description): string
    {
        $description = strip_tags($description);
        $description = str_replace("\n", '', $description);
        $description = str_replace("\r", '', $description);

        return str($description)->words(200);
    }
}
