<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;


class FileService
{

    /**
     * Get a validator for a contact.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function Upload($file)
    {
        //get the file name
        $filenameWithExt = $file->getClientOriginalName();

        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        //get extansion
        $extension = $file->getClientOriginalExtension();
        //get the name of the file
        $filenameToStore = $filename . '.' . $extension;
        // store the image
        $path = $file->storeAs('public/photos/', $filenameToStore);
    }
        //get file from url 
        public static function getFile($url)
        {
            //get name file by url and save in object-file
            $path_parts = pathinfo($url);
            //get image info (mime, size in pixel, size in bits)
            $newPath = $path_parts['dirname'] . '/tmp-files/';
            if(!is_dir ($newPath)){
                mkdir($newPath, 0777);
            }
            $newUrl = $newPath . $path_parts['basename'];
            copy($url, $newUrl);
            $imgInfo = getimagesize($newUrl);
            $file = new UploadedFile(
                $newUrl,
                $path_parts['basename'],
                $imgInfo['mime'],
                filesize($url),
                TRUE,
            );
            return $file;
        }
}
