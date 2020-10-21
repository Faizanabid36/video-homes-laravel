<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{
    //
    protected $guarded = [];
    protected $with = ['user','video'];

    public function user()
    {
        return $this->belongsTo(User::class, 'contact_user_id');
    }

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id', 'id');
    }


    public function scopeUserRating($q, $user_id)
    {
        return $q->latest()->whereReplyUserId($user_id)
            ->whereType('rating');
    }
}
