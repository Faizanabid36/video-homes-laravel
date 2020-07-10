<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //

    protected $guarded=[];
    public function scopeViewPage($query,$slug){
        return $query->where(compact('slug'))->whereIsPublic(1);
    }
}
