<?php

namespace App\Http\Controllers;

use App\UserMessage;
use Illuminate\Http\Request;

class UserMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $usermessages = UserMessage::where('message', 'LIKE', "%$keyword%")
                                  ->latest()->paginate($perPage);
        } else {
            $usermessages = UserMessage::latest()->paginate($perPage);
        }

        return view('admin.user-messages.index', compact('usermessages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            "contact_user_id" => "required|exists:users,id",
            "video_id" => "required|exists:videos,id",
        ]);
        UserMessage::create(request()->except('_token'));
        return back()->with(["message_sent" => "Message Sent!"]);
    }

    public function my_ratings(Request $request)
    {
        $all_ratings = UserMessage::userRating(auth()->user()->id)->get();
        $ratings = collect($all_ratings)->map(function ($rate) {
            return [
                'name' => collect($rate->user)->get('name'),
                'video_title' => collect($rate->video)->get('title'),
                'review' => $rate->message,
                'rating' => $rate->rating,
                'time' => $rate->created_at->diffForHumans(),
            ];
        });
        return compact('ratings');
    }

    public function reported_videos()
    {
        $reported_queries = UserMessage::whereType('report')
            ->paginate(10);
        return view('admin.reported.view_reported_videos', compact('reported_queries'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\UserMessage $userMessage
     * @return \Illuminate\Http\Response
     */
    public function show(UserMessage $userMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserMessage  $userMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(UserMessage $userMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserMessage  $userMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserMessage $userMessage)
    {
        $userMessage->update($request->only('is_resolved'));
        return back()->withSuccess('Resolved');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserMessage  $userMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserMessage $userMessage)
    {
        $userMessage->delete();
        return back()->withSuccess('Deleted');
    }

}
