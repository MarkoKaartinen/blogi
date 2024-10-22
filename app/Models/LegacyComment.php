<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LegacyComment extends Model
{
    protected $fillable = [
        'name', 'email', 'body', 'article_id', 'created_at'
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
