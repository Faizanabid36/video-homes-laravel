<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //
    protected $guarded = [];
    protected $dates = [ 'converted_for_streaming_at', ];
    protected $hidden = [];
    protected $with = ['user'];
    protected $casts = ['processed'=>'boolean'];


    protected static function boot() {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating(function ($video) {
            $video->setAttribute('user_id', auth()->id());
            $video->setAttribute('video_id', \Str::random( 16 ));
            $video->setAttribute('disk', 'public');
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
