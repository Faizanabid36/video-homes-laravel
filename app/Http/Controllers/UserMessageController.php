<?php

namespace App\Http\Controllers;

use App\UserMessage;
use Chatify\Http\Models\Message;
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
     * @return \Illuminate\Http\RedirectResponse
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
        dd($userMessage);
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
     * @param \App\UserMessage $userMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserMessage $userMessage)
    {
        $userMessage->delete();
        return back()->withSuccess('Deleted');
    }



    public function send_message(Request $request)
    {
        $sent_message = UserMessage::create([
            'message' => $request->inputText,
            'reply_user_id' => $request->to_id,
            'contact_user_id' => auth()->user()->id,
            'type' => 'contact',
            'video_id' => -1,
        ]);
        return ['message' => $sent_message, 'user_id' => auth()->user()->id];
    }

    public function my_messages(Request $request)
    {
        $message = UserMessage::whereId($request->message_id)->first();
        $from_id = 0;
        $to_id = 0;
        if (!empty($message)) {
            $from_id = $message->contact_user_id;
            $to_id = $message->reply_user_id;
        }
        if(auth()->user()->id == $to_id)
        {
            $temp = $to_id;
            $to_id = $from_id;
            $from_id = $temp;
        }
        $messages = [];
        $messages = UserMessage::whereType('contact')->where('contact_user_id', $from_id)->where('reply_user_id', $to_id)
            ->orWhere('contact_user_id', $to_id)->where('reply_user_id', $from_id)->get();
        $messageIds = collect($messages)->map(function ($message) {
            return $message->id;
        });
        UserMessage::whereIn('id', $messageIds)->update(['read_at' => now()]);
        $user_id = auth()->user()->id;
        return compact('messages', 'to_id', 'user_id');
    }

    public function my_messages_list()
    {
        $messages = [];
        $usersList=[];
        $fromMe = UserMessage::whereType('contact')
            ->whereContactUserId(auth()->user()->id)->distinct('reply_user_id')->pluck('reply_user_id')->toArray()[0];
        $usersList[]=$fromMe;
        $toMe = UserMessage::whereType('contact')->whereReplyUserId(auth()->user()->id)->distinct('contact_user_id')->pluck('contact_user_id')->toArray();
        $usersList[]=$toMe;
        dd($usersList);
        foreach (array_unique($usersList) as $u) {
            if (!is_null($u))
                $messages[] = UserMessage::latest()
                    ->whereContactUserId(auth()->user()->id)->whereReplyUserId($u)
                    ->orWhere('contact_user_id', $u)->whereReplyUserId(auth()->user()->id)
                    ->first();
        }
        $messages = collect($messages)->filter(function ($value, $key) {
            return $value != null;
        })->values();
        $user_id = auth()->user()->id;
        return compact('messages', 'user_id');
    }

}
