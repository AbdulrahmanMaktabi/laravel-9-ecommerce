<?php

namespace App\Services;

use App\Facades\Loggy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class MediaService
{
    public static function uploadImage(Request $request, $inputName, $path = 'uploads', $prefix = 'media')
    {
        if ($request->hasFile($inputName)) {
            $image = $request->file($inputName);

            $validator = Validator::make(
                ['image' => $image],
                ['image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048']
            );

            if ($validator->fails()) {
                $errorMessage = $validator->errors()->first('image');

                Loggy::error('Can not upload image ' . Carbon::now() . '. Error: ' . $errorMessage);

                return redirect()->back()->with('message', $errorMessage);
            }

            $ext = $image->getClientOriginalExtension();
            $imageName = $prefix . '_' . uniqid() . '.' . $ext;

            $imagePath = $image->storeAs($path, $imageName, 'public');
            return Storage::url($imagePath);
        }
        return null;
    }

    public static function uploadMultiImages(Request $request, $inputName, $path = 'uploads', $prefix = 'media')
    {
        $paths = [];

        if ($request->hasFile($inputName)) {
            $images = $request->file($inputName);

            foreach ($images as $image) {
                $validator = Validator::make(
                    ['image' => $image],
                    ['image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048']
                );

                if ($validator->fails()) {
                    $errorMessage = $validator->errors()->first('image');

                    Loggy::error('Can not upload image ' . Carbon::now() . '. Error: ' . $errorMessage);

                    return redirect()->back()->with('message', $errorMessage);
                }

                $ext = $image->getClientOriginalExtension();
                $imageName = $prefix . '_' . uniqid() . '.' . $ext;

                $imagePath = $image->storeAs($path, $imageName, 'public');
                $paths[] = Storage::url($imagePath);
            }
            return $paths;
        }
        return null;
    }

    public static function updateImage(Request $request, $inputName, $oldPath = null, $path = 'uploads', $prefix = 'media')
    {
        if ($request->hasFile($inputName)) {
            if ($oldPath && Storage::exists($oldPath)) {
                Storage::delete($oldPath);
            }

            $image = $request->file($inputName);

            $validator = Validator::make(
                ['image' => $image],
                ['image' => 'image|mimes:jpeg,png,jpg,gif,svg']
            );

            if ($validator->fails()) {
                $errorMessage = $validator->errors()->first('image');

                Loggy::error('Can not upload image ' . Carbon::now() . '. Error: ' . $errorMessage);

                return redirect()->back()->with('message', $errorMessage);
            }

            $ext = $image->getClientOriginalExtension();
            $imageName = $prefix . '_' . uniqid() . '.' . $ext;

            $imagePath = $image->storeAs($path, $imageName, 'public');
            return Storage::url($imagePath);
        }
        return null;
    }

    public static function deleteImage($path)
    {
        $correctPath = str_replace('\\', '/', $path);

        $pathToDelete = str_replace('/storage', 'public', $correctPath);

        if (Storage::exists($pathToDelete)) {
            Storage::delete($pathToDelete);
            return true;
        }

        return null;
    }
}
