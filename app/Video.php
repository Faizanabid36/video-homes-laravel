<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model {
    //
    protected $guarded = [];
    protected $dates = [
        'converted_for_streaming_at',
    ];
    protected $hidden = [ 'created_at',
        'disk',
        'updated_at',
        'duration', 'original_name', 'size', 'video_id', 'video_path','user_id' ];
}
