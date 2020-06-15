<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    //
    protected $table = 'user_roles';

    public function account_types()
    {
        return $this->hasMany(AccountType::class,'role','id');
    }
}
