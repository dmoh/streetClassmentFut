<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\ { Storage, File };
use Intervention\Image\Facades\Image;
use App\Upload;


class UploadImagesController extends Controller
{
    private $photos_path;
    private $thumbs_path;
    public function __construct()
    {
        $this->photos_path = public_path('/images');
        $this->thumbs_path = public_path('/thumbs');
    }
    /**
     * Saving images uploaded through XHR Request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $photos = $request->file('file');
        if (!is_array($photos)) {
            $photos = [$photos];
        }
        if (!is_dir($this->photos_path)) {
            mkdir($this->photos_path);
        }
        if (!is_dir($this->thumbs_path)) {
            mkdir($this->thumbs_path);
        }
        for ($i = 0; $i < count($photos); $i++) {
            $photo = $photos[$i];
            $name = str_random(30);
            $save_name = $name . '.' . $photo->getClientOriginalExtension();
            Image::make($photo)
               // ->crop(125, 130, 0, 0)
                /**/->resize(120, 130, function ($constraints) {
                    $constraints->aspectRatio();
                })
                ->save($this->thumbs_path . '/' . $save_name);
            $photo->move($this->photos_path, $save_name);
            $upload = new Upload();
            $upload->filename = $save_name;
            $upload->index = $request->session()->get('index');
            $upload->original_name = basename($photo->getClientOriginalName());
            $upload->user_id = 0;
            $upload->save();


        }
    }


    public function edit(Request $request){
        dd($request);
    }


    public function getServerImages(Request $request)
    {
        if($request->session()->has('index')) {
            $imageAnswer = [];
            $index = $request->session()->get('index');
            $images = Upload::whereIndex($index)->get();
            foreach ($images as $image) {
                $imageAnswer[] = [
                    'original' => $image->original_name,
                    'server' => $image->filename,
                    'size' => File::size($this->photos_path . '/' . $image->filename),
                ];
            }
            if(!empty($imageAnswer)) {
                return response()->json([
                    'images' => $imageAnswer
                ]);
            }
        }
    }


    public function destroy(Request $request)
    {
        $uploaded_image = Upload::where('original_name', basename($request->name))->first();
        if (!empty($uploaded_image)) {
            $file_path = $this->photos_path . '/' . $uploaded_image->filename;
            $thumb_file = $this->thumbs_path . '/' . $uploaded_image->filename;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            if (file_exists($thumb_file)) {
                unlink($thumb_file);
            }
            $uploaded_image->delete();
        }
    }

}
