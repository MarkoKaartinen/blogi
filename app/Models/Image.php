<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Image extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['year', 'filename'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('small')
            ->width(600)
            ->format('webp');

        $this->addMediaConversion('medium')
            ->width(1000)
            ->format('webp');

        $this->addMediaConversion('large')
            ->width(1400)
            ->format('webp');

        $this->addMediaConversion('xl')
            ->width(2000)
            ->format('webp');
    }
}
