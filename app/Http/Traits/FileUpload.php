<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;


trait FileUpload
{

    protected function uploadFile($file, $path, $prefix = null)
    {
        $file_name = $prefix . uniqid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path() . $path, $file_name);
        $file_url = $path . $file_name;
        return $file_url;
    }

    public function updateFile(UploadedFile $file, $uploadPath, $oldFilePath, $prefiex)
    {
        $this->deleteFile($oldFilePath);
        return $this->uploadFile($file, $uploadPath, $prefiex);
    }

    protected function deleteFile($filePath)
    {
        if (File::exists(public_path($filePath))) {
            File::delete(public_path($filePath));
        }
    }
}