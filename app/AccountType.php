<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    //
//    protected $with = 'user_tag';

    protected $table = 'account_types';

    protected $guarded = [];

    public function user_tag()
    {
        return $this->hasOne(UserTags::class, 'id', 'account_type');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function user_category()
    {
        return $this->hasMany(UserCategory::class,'role_id','role');
    }

    public function user_sub_cat()
    {
        return $this->hasMany(UserCategory::class,'id','sub_role');
    }
    public function user_sub_role_cat()
    {
        return $this->hasMany(UserCategory::class,'id','sub_role_category');
    }

}
