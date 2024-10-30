<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ImageController extends Controller
{
    public function __invoke($year, $file)
    {
        $filepath = "$year/$file";

        $image = Image::updateOrCreate([
            'year' => $year,
            'filename' => $file,
        ]);

        $media = $image->getFirstMedia('image');

        if($image->wasRecentlyCreated || !$media instanceof Media){
            $image->addMediaFromDisk($filepath, 'images')
                ->preservingOriginal()
                ->toMediaCollection('image');
            $media = $image->getFirstMedia('image');
        }

        $size = 'large';
        if(request()->get('size')){
            $size = request()->get('size');
        }

        return response()
            ->file($media->getAvailablePath([$size]));
    }
}
