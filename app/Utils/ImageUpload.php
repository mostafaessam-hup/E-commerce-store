<?php

namespace App\Utils;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ImageUpload
{
    public static function uploadImage($request, $path = null)
    {
        $imageName = Str::uuid() . date('Y-m-d h:i:s') . '.' . $request->getClientOriginalExtension();
        Storage::disk('public')->put($path . $imageName, file_get_contents($request));
        /*other way to store files:-
            $request->logo->move(public_path('images'), $logoName);*/

        return $path . $imageName;
    }
}
