<?php

namespace App\Models;

use App\Contracts\Mastodonable;
use App\Support\MarkdownHandler;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Laravel\Scout\Searchable;
use Spatie\Tags\HasTags;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Recipe extends Model implements Mastodonable
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
        'ingredients',
        'servings_amount',
        'servings_unit',
        'status',
        'post_to_mastodon',
        'mastodon_post_id',
        'published_at',
        'created_at',
        'updated_at',
    ];

    protected static function booted(): void
    {
        static::creating(function (Recipe $recipe) {
            $recipe->created_at ??= now();
        });
    }

    protected function casts(): array
    {
        return [
            'ingredients' => 'array',
            'published_at' => 'datetime',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
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

    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn () => route('recipe', ['slug' => $this->slug])
        );
    }

    protected function fileContent(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($this->cachedFileContent === null) {
                    $this->cachedFileContent = MarkdownHandler::getRecipe($this->year, $this->slug);
                }

                return $this->cachedFileContent;
            }
        );
    }

    public function content(): string
    {
        $content = YamlFrontMatter::parse($this->file_content);

        return str($content->body())->trim();
    }

    protected function body(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->content()
        );
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: function () {
                $content = YamlFrontMatter::parse($this->file_content);

                return $content->matter('image');
            }
        );
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public static function pendingMastodonDispatch(): Collection
    {
        return static::query()
            ->published()
            ->where('post_to_mastodon', true)
            ->whereNull('mastodon_post_id')
            ->get();
    }

    public function mastodonMessage(): string
    {
        $message = "Julkaisin juuri uuden reseptin blogiini!\n\n";
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

        Cache::forget('recipe_'.$this->slug);
        Cache::forget('mastodon_comments_'.$statusId);
    }

    public function toSearchableArray(): array
    {
        $this->load('tags');

        return [
            'id' => (int) $this->id,
            'slug' => $this->slug,
            'title' => $this->title,
            'description' => $this->description,
            'published_at' => $this->published_at,
            'body' => $this->body,
            'url' => $this->url,
            'categories' => $this->tagsWithType('recipe_category')->pluck('name')->toArray(),
            'tags' => $this->tagsWithType('recipe_tag')->pluck('name')->toArray(),
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
        return $this->status === 'published' && $this->published_at < now();
    }

    public function searchableAs(): string
    {
        return 'mknet_recipes_index';
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
