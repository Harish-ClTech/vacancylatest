<?php
namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Image;
use Exception;

trait ImageProcessTrait
{
    public static function uploadImage (UploadedFile $uploadedFile, $folder = null, $filename = null)
    {
        try {
            $extension = $uploadedFile->getClientOriginalExtension();
            $newfilename = $filename.'.'.$extension;
   
            $imgExtArray = ['jpeg', 'jpg', 'png'];
            $fileExtArray = ['doc', 'docx', 'pdf', 'PDF'];
            if (in_array($extension, $imgExtArray)) {
                $image_path = public_path($folder.$newfilename);
                $img = Image::make($uploadedFile)->save($image_path);
            } else if (in_array($extension, $fileExtArray)) {
                $pdf_path = public_path($folder);
                $uploadedFile->move($pdf_path, $newfilename);
            } else {
                throw new Exception ("Couldn't upload document.Please, try again.");
            }
    
            return true;

        } catch (Exception $e) {
            throw $e;
        }
    }

}