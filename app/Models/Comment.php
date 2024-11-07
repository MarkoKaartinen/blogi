<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    protected $fillable = ['nickname', 'email', 'comment', 'link', 'article_id', 'parent_id'];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
