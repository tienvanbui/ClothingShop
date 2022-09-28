<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

trait uploadFileImage
{
    //Upload Avatar 
    public function uploadAvataruser(Request $request)
    {
        //Check request has file image or not 
        if ($request->hasFile('avatar')) {
            $file = $request->avatar;
            //get filemame is orginal file 
            $file_name = $file->getClientOriginalName();
            //if in floder avatars of user has avatar the delete old avatar 
            if (auth()->user()->avatar) {
                Storage::delete('/public/avatars/' . auth()->user()->id . "/" . auth()->user()->avatar);
            }
            //get path to store image 
            //Example path is: public/avatars/1/avatar.jpg
            $path = $request->file('avatar')->storeAs("public/" . "avatars" . "/" . auth()->user()->id, $file_name);
            $dataUpdate = [
                //change the path to storage/app/public/avatars/1/avatar.jpg
                'file_path' => Storage::url($path),
            ];
            return $dataUpdate;
        }
        return null;
    }
    public function uploadImage($field_name, $request)
    {
        if ($request->hasFile($field_name)) {
            $file = $request->file($field_name);
            $fileName = $file->hashName();
            $fileOrginalName = $file->getClientOriginalName();
            $path = $file->storeAs("public/" . Str::plural($field_name) . "/" . auth()->user()->id, $fileName);
            $dataUploaded = [
                'fileName' => $fileOrginalName,
                'filePath' => Storage::url($path),
            ];
            return $dataUploaded;
        }
        return null;
    }
    public function checkFileUploadExists($request,$field_name){
        if ($request->hasFile($field_name) && $request->$field_name != '') {
            return true;
        }
        return false;
    }
    public function delteOldImageWhenUpdateWithoutCheckExists( $field_name, $object)
    {
        $path = storage_path() . "/app/public/" . str_replace("/storage", '', $object->$field_name);
        if (Storage::exists("/public" . str_replace("/storage", '', $object->$field_name))) {
            unlink($path);
        } 
    }
    public function delteOldImageWhenUpdateWithCheckExists($request, $field_name, $object)
    {
        if($this->checkFileUploadExists($request,$field_name)){
            $path = storage_path() . "/app/public/" . str_replace("/storage", '', $object->$field_name);
            if (Storage::exists("/public" . str_replace("/storage", '', $object->$field_name))) {
                unlink($path);
            } 
        }
    }
    public function UploadFileMultiple($file, $floder)
    {
        $fileName = $file->hashName();
        $fileOriginalName = $file->getClientOriginalName();
        $path = $file->storeAs("public/" . Str::plural($floder) . "/" . auth()->user()->id, $fileName);
        $dataUpload = [
            'fileName' => $fileOriginalName,
            'filePath'=>Storage::url($path),
        ];
        return $dataUpload;
    }
}
