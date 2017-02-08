<?php

/**
 * Created by PhpStorm.
 * User: Samuel.James
 * Date: 6/6/2016
 * Time: 11:07 PM
 */
namespace App\Services\Photo;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class UploadPicture
{

    public $filename=null;
    public $thumb_path;
    public $full_path;
    public function __construct()
    {
        if ($this->filename == null) {
            $this->filename = str_random(40);
        }
    }

    public function  process($request) {
            if($request->hasFile("photo")){  //name of the input field must be input
            $path_dir =public_path(config('photo.uploads.full_path'));
                $thumb_dir =$path_dir .DIRECTORY_SEPARATOR. config('photo.uploads.thumb_path');

                if(!File::exists($path_dir)) File::makeDirectory($path_dir, 775);

                if(!File::exists($thumb_dir)) File::makeDirectory($thumb_dir, 775);
                //get file extension
            $extension = $request->file('photo')->getClientOriginalExtension();
            $filename =$this->filename.".".$extension;
                $request->file("photo")->move($path_dir.DIRECTORY_SEPARATOR,$filename);
             $this->full_path =$path_dir.DIRECTORY_SEPARATOR.$filename;
                $img = Image::make($this->full_path);
                $img->fit(config('photo.standard_width'),config('photo.standard_height'));
                $this->create_thumb($thumb_dir.DIRECTORY_SEPARATOR.$filename);
                $this->thumb_path =$thumb_dir.DIRECTORY_SEPARATOR.$filename;
            }


        }

    public function create_thumb($path){
        $img = Image::make($this->full_path);
        $img->fit(config('photo.thumb_width'),config('photo.thumb_height'));
        $img->save($path);

    }

    public function ImageFromUrlOrString(array $string)
    {
        if(!empty($string)){
            $path=[];
            $path_dir =config('photo.uploads.full_path');
            $thumb_dir =$path_dir .DIRECTORY_SEPARATOR. config('photo.uploads.thumb_path');

            if(!File::exists($path_dir)) File::makeDirectory($path_dir, 775);

            if(!File::exists($thumb_dir)) File::makeDirectory($thumb_dir, 775);

            foreach($string as $s){

            $img =Image::make($s)->encode('jpg');
                $filename=str_random(40).'.jpg';
                $full_path =$path_dir.DIRECTORY_SEPARATOR.$filename;
                $img->save($full_path);
                $img->fit(config('photo.standard_width'),config('photo.standard_height'));
                $thumb_path =$thumb_dir.DIRECTORY_SEPARATOR.$filename;
                $this->full_path =$full_path;
                $this->create_thumb($thumb_path);
                $data[] =['full_path'=>$full_path,'thumb_path'=>$thumb_path];
            }
        }
        return $data;
    }

    }

