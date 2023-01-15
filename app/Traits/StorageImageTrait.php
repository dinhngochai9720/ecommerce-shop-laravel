<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

// trait ho tro da ke thua
trait StorageImageTrait
{
    //Upload one file
    public function storageTraitUpload($request, $filedName, $folderName)
    {

        //Repeat video 27 + 28
        if ($request->hasFile($filedName)) {
            $file = $request->$filedName;
            $fileNameOriginal = $file->getClientOriginalName();
            $fileNameHash = str_random(20) . '.' . $file->getClientOriginalExtension();
            $filePath = $request->file($filedName)->storeAs('public/' . $folderName . '/' . auth()->id(), $fileNameHash); //Save image and create new folder product in storage/app/public/product (image in product folder, product is folder name), 

            $dataInsert = [
                'file_name' => $fileNameOriginal, //get file name original of image product

                'file_path' => Storage::url($filePath) // get url of file image product, Storage::url($filePath) :tự động thêm /storage vào path và trả về một relative URL của file
            ];

            return $dataInsert;
        }

        return null;
    }


    //Upload multiple files
    public function storageTraitUploadMultiple($file, $folderName)
    {


        $fileNameOriginal = $file->getClientOriginalName();
        $fileNameHash = str_random(20) . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs('public/' . $folderName . '/' . auth()->id(), $fileNameHash); //Save image and create new folder product in storage/app/public/product (image in product folder), 

        $dataInsert = [
            'file_name' => $fileNameOriginal, //get file name original of image product

            'file_path' => Storage::url($filePath) // get url of image product
        ];

        return $dataInsert;
    }
}