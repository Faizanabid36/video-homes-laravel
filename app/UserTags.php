<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTags extends Model
{
    //
    public function account_types()
    {
        return $this->hasMany(AccountType::class,'account_type','id');
    }
}
