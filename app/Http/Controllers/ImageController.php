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

        if(!Storage::disk('media')->exists($filepath)){
            abort(404);
        }

        $image = Image::updateOrCreate([
            'year' => $year,
            'filename' => $file,
        ]);

        $media = $image->getFirstMedia('image');

        if($image->wasRecentlyCreated || !$media instanceof Media){
            $image->addMediaFromDisk($filepath, 'media')
                ->preservingOriginal()
                ->toMediaCollection('image');
            $media = $image->getFirstMedia('image');
        }

        if(!$media instanceof Media){
            return response()->file(Storage::disk('media')->path($filepath));
        }

        $size = 'large';
        if(request()->get('size')){
            $size = request()->get('size');
        }

        if(!$media->hasGeneratedConversion($size)){
            return response()->file(Storage::disk('media')->path($filepath));
        }

        $s3path = str($media->getAvailablePath([$size]))
            ->replace(config('filesystems.disks.s3-media.root'), '')
            ->toString();
        $s3storage = Storage::disk('s3-media');

        if(!$s3storage->exists($s3path)){
            return response()->file(Storage::disk('media')->path($filepath));
        }

        return response($s3storage->get($s3path), headers: ['Content-Type' => $s3storage->mimeType($s3path)]);
    }
}
