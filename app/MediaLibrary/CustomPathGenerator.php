<?php

namespace App\MediaLibrary;

use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class CustomPathGenerator implements PathGenerator
{
    public function getPath(Media $media): string
    {
        // Daftar ekstensi gambar yang valid untuk masuk ke folder 'images/'
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        // Ambil ekstensi file dari Media Library
        $extension = strtolower($media->extension); // Gunakan strtolower untuk menghindari case-sensitive

        if (in_array($extension, $imageExtensions)) {
            return 'images/';
        }

        return 'files/';
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
