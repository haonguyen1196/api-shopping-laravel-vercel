<?php

namespace App\Traits;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait StorageImageTrait {
    public function StorageTraitUpload ($request, $fieldName, $foderName) {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $fileName = $file->getClientOriginalName();
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/' . $foderName. '/' . auth()->id() , $fileNameHash);
            $dataUploadTrait = [
                'file_name' => $fileName,
                'file_path' => Storage::url( $path)
            ];
            return $dataUploadTrait;
        }

        return null;
    }

    public function StorageTraitUploadMultiple ($file, $foderName) {
            $fileName = $file->getClientOriginalName();
            $fileNameHash = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/' . $foderName. '/' . auth()->id() , $fileNameHash);
            $dataUploadTrait = [
                'file_name' => $fileName,
                'file_path' => Storage::url( $path)
            ];

            return $dataUploadTrait;
    }
}