<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

class VideoController extends Controller
{
    //
    public function upload_video(Request $request)
    {
        $image = file_get_contents(\request('videos'));
        $fileName = \request('fileName');
        $message = 'Could not Upload';
        $uploaded = file_put_contents(public_path('/videos/' . $fileName), $image);
        if ($uploaded) {
            $message = 'Uploaded';
        }
        return compact('message');
    }

    public function watch_video()
    {
        $path = asset('/videos/Products.mp4');
        return compact('path');
    }
}
