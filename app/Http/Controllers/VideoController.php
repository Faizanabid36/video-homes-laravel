<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

class VideoController extends Controller
{
    //
    public function upload_video(Request $request)
    {

        $image = \request('videos');
        $fileName = \request('fileName');
        $video=Image::make($image)->save(public_path('/images/'.$fileName));
        $message='Could not Upload';
        if($video)
            $message='Successfully Uploaded';
        return compact('message');
    }
}
