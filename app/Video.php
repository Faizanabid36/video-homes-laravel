<?php

namespace App;

use App\Jobs\DeleteVideos;
use Illuminate\Database\Eloquent\Model;
use Nagy\LaravelRating\Traits\Rate\Rateable;

class Video extends Model {
    use Rateable;
    //
    protected $guarded = [];
    protected $dates = [ 'converted_for_streaming_at', ];
    protected $hidden = [];
    protected $with = [ 'user', 'comments' ];
    protected $casts = [ 'processed' => 'boolean', 'tags' => 'array' ];


    protected static function boot() {
        parent::boot(); // TODO: Change the autogenerated stub
        static::creating( function ( $video ) {
            $playlist = Playlist::whereUserId( auth()->id() )->first()->id;
            $video->setAttribute( 'user_id', auth()->id() );
            $video->setAttribute( 'video_id', \Str::random( 16 ) );
            $video->setAttribute( 'disk', 'public' );
            $video->setAttribute( 'playlist_id', $playlist );
        } );
        static::created( function ( $video ) {
            $video->slug = \Str::slug( $video->video_id . " " . $video->title );
            $video->save();
        } );


        static::deleting( function ( $video ) {
            VideoView::whereVideoId( $video->id )->delete();
            DeleteVideos::dispatch( $video );
        } );
    }

    public function user() {
        return $this->belongsTo( User::class, 'user_id', 'id' );
    }

    public function video_actions() {
        return $this->hasMany( VideoAction::class, 'video_id', 'id' );
    }

    public function category() {
        return $this->belongsTo( Category::class, 'category_id' );
    }

    public function comments() {
        return $this->hasMany( Comment::class, 'video_id', 'id' );
    }

    public function scopeUserVideos( $query, $username, $video_id = false, $related = false ) {
        return $query->whereHas( 'user', function ( $query ) use ( $username ) {
            $query->whereUsername( $username );
        } )->when( ! auth()->check() || auth()->user()->username !== $username, function ( $q ) {
            $q->whereProcessed( 1 )->whereIsVideoApproved( 1 )->whereHas( 'user', function ( $query ) {
                $query->whereActive( 1 );
            } );
        } )->when( $video_id, function ( $query ) use ( $video_id, $related ) {
            return $related ? $query->where(function($q) use ($video_id){
                return $q->where('id','!=', $video_id );
            })  : $query->where(function($q) use ($video_id){
                return $q->whereVideoId( $video_id )->orWhere('slug',$video_id);
            });

        } )->when( ! $video_id, function ( $query ) {
            $query->latest();
        } )->take( 5 );
    }

    public function scopeSingleVideo( $query, $video_id ) {
        return $query->whereProcessed( 1 )->whereIsVideoApproved( 1 )->where(function($q) use ($video_id){
            return $q->whereVideoId( $video_id )->orWhere('slug',$video_id);
        });
    }

}
