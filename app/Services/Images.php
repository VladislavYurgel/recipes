<?php

namespace App\Services;

use Intervention\Image\ImageManagerStatic as Image;

class Images
{
    /**
     * Upload the image
     *
     * @param $image
     * @param bool $isApi
     * @return string
     */
    public static function uploadImage($image, $isApi = false)
    {
        $path = '/public/img/recipes/' . time() . uniqid();
        if ($isApi) {
            // with base64 encoding
            preg_match('/data:image\/([\w]+);base64,/', $image, $match);
            $image = preg_replace('/data:image\/[\w]+;base64,/', '', $image);
            $image = str_replace(' ', '+', $image);
            $path .= '.' . $match[1];
            file_put_contents(base_path() . $path, base64_decode($image));
        } else {
            // from form through input file
        }
        return $path;
    }
}