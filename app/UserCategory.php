<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model
{
    //
    protected $table = 'user_categories';

    protected $guarded = [];

//    protected $with=['parent','children'];

    public function children()
    {
        return $this->hasMany(UserCategory::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(UserCategory::class, 'parent_id');
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function ($user_category) { // before delete() method call this
            $user_category->children()->each(function ($child) {
                $child->delete(); // <-- direct deletion
            });
        });
    }

    public function user_role()
    {
        return $this->belongsTo(UserRole::class,'role_id','id');
    }

    public function sub_roles()
    {
        return $this->hasMany(AccountType::class,'sub_role','id');
    }
    public function sub_roles_category()
    {
        return $this->hasMany(AccountType::class,'sub_role_category','id');
    }
}
