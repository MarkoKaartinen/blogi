<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends \Spatie\Tags\Tag
{
    public function articles(): MorphToMany
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }

    public function recipes(): MorphToMany
    {
        return $this->morphedByMany(Recipe::class, 'taggable');
    }
}
