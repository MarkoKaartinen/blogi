<?php

namespace App\Models;

class Tag extends \Spatie\Tags\Tag
{
    public function articles(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }
}
