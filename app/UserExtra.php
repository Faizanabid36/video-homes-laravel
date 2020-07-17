<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserExtra extends Model
{
    //

    protected $guarded = [];
    protected $with = ['user_id'];

    public function user_id(){
        return $this->hasOne(User::class,"id","user_id")->without('user_extra');
    }


}
