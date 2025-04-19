<?php

namespace App\MediaLibrary;

use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CustomPathGenerator implements PathGenerator
{
    public function getPath(Media $media): string
    {
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $extension = strtolower($media->extension);
        $collection = $media->collection_name;

        if ($collection === 'category') {
            if (in_array($extension, $imageExtensions)) {
                return 'category/images/';
            } else {
                return 'category/files/';
            }
        }

        if ($collection === 'assets'||'images') {
            if (in_array($extension, $imageExtensions)) {
                return 'assets/images/';
            } else {
                return 'assets/files/';
            }
        }

        if ($collection === 'profile_picture') {
            if (in_array($extension, $imageExtensions)) {
                return 'profile/images/';
            } else {
                return 'profile/files/';
            }
        }

        // Default fallback kalau koleksinya tidak dikenali
        return 'other/' . $collection . '/' . $media->id . '/';
    }

    public function getPathForConversions(Media $media): string
    {
        return 'uploads/conversions/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return 'uploads/responsive-images/';
    }
}
