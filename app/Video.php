<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //
    protected $guarded = [];
    protected $dates = [
        'converted_for_streaming_at',
    ];
}
