<?php

namespace App\Http\Controllers;

use App\ImageRepository;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use App\Image;

class ImageController extends Controller
{
    protected $image;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->image = $imageRepository;
    }


    public function getUpload()
    {
        return view('pages.upload');
    }

    /**
        * API / Post processing of image upload.
        *
        * @param  Request $request
        * @return Response
    */
    public function postUpload()
    {
        
        config(['images.full_size' => '/var/www/openpad/public/cdn/'.\Auth::User()->id.'/']);
        config(['images.icon_size' => '/var/www/openpad/public/cdn/'.\Auth::User()->id.'/thumbnails/']);
        File::makeDirectory('/var/www/openpad/public/cdn/'.\Auth::User()->id.'/', $mode = 0777, true, true);
        File::makeDirectory('/var/www/openpad/public/cdn/'.\Auth::User()->id.'/thumbnails/', $mode = 0777, true, true);

         
        $photo = Input::all();
        $response = $this->image->upload($photo);
        return $response;

    }

    /**
        * API / Post Processing for deleting an existing image.
        *
        * @param  Request $request
        * @return Response
    */
    public function deleteUpload()
    {

        $filename = Input::get('id');

        if(!$filename)
        {
            return 0;
        }

        $response = $this->image->delete( $filename );

        return $response;
    }
}