<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MediaService
{
    public static function uploadImage(Request $request, $inputName, $path = 'uploads', $prefix = 'media')
    {
        if ($request->hasFile($inputName)) {
            $image = $request->file($inputName);
            $ext = $image->getClientOriginalExtension();
            $imageName = $prefix . '_' . uniqid() . '.' . $ext;
            $image->move(public_path('uploads'), $imageName);
            return '/' . $path . '/' . $imageName;
        }
        return null;
    }

    public static function uploadMultiImages(Request $request, $inputName, $path = 'uploads', $prefix = 'media')
    {
        $paths = [];

        if ($request->hasFile($inputName)) {
            $images = $request->file($inputName);

            foreach ($images as $image) {
                $ext = $image->getClientOriginalExtension();
                $imageName = $prefix . '_' . uniqid() . '.' . $ext;
                $image->move(public_path('uploads'), $imageName);
                $paths[] = '/' . $path . '/' . $imageName;
            }
            return $paths;
        }
        return null;
    }

    public static function updateImage(Request $request, $inputName, $path = 'uploads', $prefix = 'media', $oldPath = null)
    {
        if ($request->hasFile($inputName)) {
            if (File::exists(public_path($oldPath))) {
                File::delete(public_path($oldPath));
            }

            $image = $request->file($inputName);
            $ext = $image->getClientOriginalExtension();
            $imageName = $prefix . '_' . uniqid() . '.' . $ext;
            $image->move(public_path('uploads'), $imageName);
            return '/' . $path . '/' . $imageName;
        }
        return null;
    }

    public function deleteImage($path)
    {
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}
