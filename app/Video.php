<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //
    protected $guarded = [];
    protected $dates = ['converted_for_streaming_at',];
    protected $hidden = [];
    protected $with = ['user', 'comments'];
    protected $casts = ['processed' => 'boolean'];


    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function ($video) {
            $playlist = Playlist::whereUserId(auth()->id())->first()->id;
            $video->setAttribute('user_id', auth()->id());
            $video->setAttribute('video_id', \Str::random(16));
            $video->setAttribute('disk', "public");
            $video->setAttribute('playlist_id', $playlist);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function video_actions()
    {
        return $this->hasMany(VideoAction::class, 'video_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class, 'video_id', 'id');
    }

}
