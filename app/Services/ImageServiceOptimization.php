<?php

namespace App\Services;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageServiceOptimization{
    public function convertToWebp(UploadedFile $image, string $directory){

        $webpFilename = 'project_' . Str::random(10) . time() . '.webp';
        $fullPath = $directory . '/' . $webpFilename;
        
        // Load and optimize image
        $image = Image::make($image);
        
        // Auto-optimize based on context
        if (str_contains($directory, 'profile')) {
            $image = $this->optimizeProfileImage($image);
        } elseif (str_contains($directory, 'project')) {
            $image = $this->optimizeProjectImage($image);
        }
        
        // Convert to WebP dengan quality optimization
        $webpData = $image->encode('webp', 85);
        
        // Store to public disk
        Storage::disk('public')->put($fullPath, (string) $webpData);
        
        return $fullPath;
    }

    private function optimizeProfileImage($image)
    {
        return $image->fit(400, 400, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
    }
    
    /**
     * Optimize project images
     */
    private function optimizeProjectImage($image)
    {
        return $image->resize(800, 600, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
    }
}