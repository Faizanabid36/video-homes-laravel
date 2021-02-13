<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    //
    protected $guarded = [];

    public function videos() {
        return $this->hasMany( Video::class );
    }

    public function scopeApprovedVideos( $query ) {
        return $query->with( [
            'videos' => function ( $q ) {
                return $q->whereProcessed( 1 )->whereIsVideoApproved( 1 )->whereVideoType('Public');
            }
        ] );
    }
}
