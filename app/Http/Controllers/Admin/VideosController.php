<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\ConvertVideoForStreaming;
use App\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $videos = Video::where('thumbnail', 'LIKE', "%$keyword%")
                ->orWhere('title', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")->
                latest()->paginate($perPage);
        } else {
            $videos = Video::whereHas('user', function ($q) {
                return $q->where('role', '!=', 1);
            })->latest()->paginate($perPage);
        }
        return view('admin.videos.index', compact('videos'));
    }

    public function my_videos(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $videos = Video::where('thumbnail', 'LIKE', "%$keyword%")
                ->orWhere('title', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")->whereHas('user', function ($q) {
                    return $q->whereRole(1);
                })->latest()->paginate($perPage);
        } else {
            $videos = Video::whereHas('user', function ($q) {
                return $q->whereRole(1);
            })->latest()->paginate($perPage);
        }
        return view('admin.videos.my_videos', compact('videos'));
    }

    public function edit_my_video(Request $request, $id)
    {
        $video = Video::whereId($id)->whereUserId(auth()->user()->id)->firstOrFail();
        return view('admin.videos.edit_my_video', compact('video'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.videos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
//        ini_set('max_execution_time', '300');
        $file = \Str::random(16) . '.' . request()->video->getClientOriginalExtension();
        request()->video->storeAs('public/uploads/', $file);
        $path = 'uploads/' . $file;
        $media = \FFMpeg::open($path);
        $videostream = $media->getStreams()->videos()->first();
        $angle = getVideoRotation($videostream);
        Log::info("Rotation: $angle");
        $dimension = $videostream->getDimensions();
        $newThumbnails = generateThumbnailsFromVideo($media, $path, $angle);
        $video = Video::create(
            array(
                'thumbnail' => $newThumbnails[1],
                'original_name' => request()->video->getClientOriginalName(),
                'video_path' => $path,
                'title' => request()->video->getClientOriginalName(),
                'duration' => $media->getDurationInSeconds(),
                'size' => request()->video->getSize(),
                'category_id' => 1,
                'video_type' => 'Public',
                'width' => $dimension->getWidth(),
                'stream_path' => getCleanFileName($path, '_240p_converted.mp4'),
            )
        );

        ConvertVideoForStreaming::dispatch(
            $video,
            320,
            240,
            array(
                'converted_for_streaming_at' => Carbon::now(),
                'processed' => true,
            ),
            $angle
        );
        if ($video->width >= 640) {
            ConvertVideoForStreaming::dispatch($video, 640, 360, array('360p' => 1), $angle);
        }
        if ($video->width >= 854) {
            ConvertVideoForStreaming::dispatch($video, 854, 480, array('480p' => 1), $angle, 1000);
        }
        if ($video->width >= 1280) {
            ConvertVideoForStreaming::dispatch($video, 1280, 720, array('720p' => 1), $angle, 1000);
        }
        if ($video->width >= 1920) {
            ConvertVideoForStreaming::dispatch($video, 1920, 1080, array('1080p' => 1), $angle, 2000);
        }
        if ($video->width >= 2560) {
            ConvertVideoForStreaming::dispatch($video, 2560, 1440, array('1440p' => 1), $angle, 2000);
        }
        if ($video->width >= 3840) {
            ConvertVideoForStreaming::dispatch($video, 3840, 2160, array('4k' => 1), $angle, 2000);
        }
        if ($video->width >= 7680) {
            ConvertVideoForStreaming::dispatch($video, 7680, 4320, array('8k' => 1), $angle, 2000);
        }
        $message = 'Video is uploading... in background';

//        return compact('message', 'video');
        return back()->withMessage('Video Has Been Uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $video = Video::findOrFail($id);

        return view('admin.videos.show', compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $video = Video::findOrFail($id);

        return view('admin.videos.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'is_video_approved' => 'required'
		]);
        $requestData = $request->all();


        $video = Video::findOrFail($id);
        $video->update($requestData);

        return redirect('admin/videos')->with('flash_message', 'Video updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Video::destroy($id);

        return redirect('admin/videos')->with('flash_message', 'Video deleted!');
    }

    public function upload()
    {
        return view('admin.videos.uploads.upload_video');
    }

    public function update_my_video(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:64',
            'description' => 'required|max:500'
        ]);
        Video::whereId($id)->whereUserId(auth()->user()->id)->update($request->except('_token'));
        return back()->withSuccess('Updated Successfully');
    }

}
