<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

/**
 *  Upload File trait
 */

trait ManagerFileS3 {

    /**
     * Method to upload files to S3 AWS
     * @param $file
     * @return string
     */

    public function UploadFile($file)
    {
        $url = Storage::disk('s3')->put('documents', $file, 'public');
        return $url;
    }

    public function GetPathS3($file)
    {
        $path = Storage::disk('s3')->get($file->ruta);
        return $path;
    }

    public function DeleteFileS3($file)
    {
        Storage::disk('s3')->delete($file->ruta);
    }
}
