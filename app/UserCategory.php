<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model {
    //

    protected $guarded = [];

    protected $with = [ 'children', 'list' ];

    public function children() {
        return $this->hasMany( $this, 'parent_id' );
    }

    public function list() {
        return $this->hasMany( UserExtra::class, 'user_category_id' );
    }
    public function parent() {
        return $this->belongsTo( $this, 'parent_id')->without(['children','list']);
    }


    public function scopeGetCategories( $query, $level1 = null, $level2 = null ) {
        return $query->when( ! $level1, function ( $query ) {
            return $query->whereNull( 'parent_id' );
        } )->when( $level1 && ! $level2, function ( $query ) use ( $level1 ) {
            return $query->whereSlug( $level1 );
        } )->when( $level2, function ( $query ) use ( $level2 ) {
            return $query->whereSlug( $level2 );
        } )->get();

    }

    public static function boot() {
        parent::boot();
        static::creating(function($user_category){
            $user_category->slug = \Str::slug(str_replace("&","-",$user_category->name));
        });
        static::updating(function($user_category){
            $user_category->slug = \Str::slug(str_replace("&","-",$user_category->name));
        });
        static::deleting( function ( $user_category ) { // before delete() method call this
            $user_category->children()->each( function ( $child ) {
                $child->delete(); // <-- direct deletion
            } );
        } );
    }

    public function scopeLevelCategories( $query ) {
        return $query->selectRaw( 'user_categories.*,uc1.name as parent_name' )
                     ->leftJoin( 'user_categories as uc1', 'user_categories.parent_id', 'uc1.id' )
                     ->get()->toArray();
    }

}
