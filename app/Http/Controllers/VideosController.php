<?php

namespace App\Http\Controllers;

use App\Category;
use App\Jobs\ConvertVideoForStreaming;
use App\Video;
use App\VideoView;
use App\Playlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VideosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {

        $Videos = Video::where('user_id', auth()->id())->where('processed', 1)->latest()
            ->with(array('user', 'category'))->withCount('views')->get();

        $videos = $Videos->groupBy('is_video_approved');
        $pendingVideos = isset($videos[0]) ? $videos[0] : [];
        $approvedVideos = isset($videos[1]) ? $videos[1] : [];
        return compact('approvedVideos', 'pendingVideos');
    }

    public function video_with_views()
    {
        $endDate = \request('endDate');
        $startDate = \request('startDate');
        $videos = Video::whereUserId(auth()->user()->id)->whereProcessed(1)->whereIsVideoApproved(1)->get();
        $videos_table_data = collect($videos)->map(function ($d) use ($startDate, $endDate) {
            $views = VideoView::whereVideoId($d->id)
                ->where('created_at', '>=', \Carbon\Carbon::parse($startDate))
                ->where('created_at', '<=', \Carbon\Carbon::parse($endDate))
                ->count();
            return ['key' => $d->id, 'title' => $d->title, 'views_count' => $views];
        });
        return compact('videos_table_data');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = \Str::random(16) . '.' . request()->video->getClientOriginalExtension();
        request()->video->storeAs('public/uploads/', $file);
        $path = 'public/uploads/' . $file;
        $media = \FFMpeg::open($path);
        $videostream = collect($media->getStreams())->first();
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
                'video_type' => ucfirst(auth()->user()->user_extra->default_video_state),
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
                'processed' => 1,
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

        return compact('message', 'video');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return array
     */
    public function show($id)
    {
        $video = Video::whereVideoId($id)->without(array('user', 'comments'))->firstOrFail();
        $categories = Category::orderBy('name', 'ASC')->get();
        $playlists = Playlist::whereUserId(auth()->user()->id)->get();
        $thumbnails = array();
        for ($i = 1; $i <= 3; $i++) {
            $thumbnails[$i] = preg_replace('/(-)\d(\.png)/', "-$i$2", $video->thumbnail, 1);
        }
        $video->username = auth()->user()->username;
        $user = auth()->user();
        // return compact('video', 'thumbnails', 'categories', 'user');
        return compact('video', 'thumbnails', 'categories', 'user', 'playlists');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return array
     */
    public function update($id)
    {
        $video = Video::whereVideoId($id)->firstOrFail();
        $video->update(request(array('description', 'video_location', 'latitude', 'longitude', 'title', 'thumbnail', 'video_type', 'tags', 'category_id', 'playlist_id')));
        return array('message' => $video ? 'Information Updated' : 'Error Updating');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return int[]
     */
    public function destroy($id)
    {

        Video::whereUserId(auth()->id())->find($id)->delete();
        return array('success' => 1);
    }
}
