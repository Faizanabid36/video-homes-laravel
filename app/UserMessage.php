<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{
    //
    protected $guarded = [];
    protected $with = ['user'];
    public function user(){
        $this->belongsTo(User::class,'contact_user_id');
    }
}
