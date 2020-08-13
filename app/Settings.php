<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model {
    //
    protected $guarded = [];
    protected $cast = [ "box_1" => "array","box_2" => "array","box_3" => "array","box_4" => "array" ];
}
