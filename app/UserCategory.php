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
}
