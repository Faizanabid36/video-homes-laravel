<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\AccountType;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::created(function ($user) {
            $playlist = new Playlist;
            $playlist->name = "Unlisted";
            $playlist->user_id = $user->id;
            $playlist->save();
        });
    }

    public function blockedusers()
    {
        return $this->hasMany(BlockedUser::class, 'user_id', 'id');
    }

    public function blockedbyusers()
    {
        return $this->hasMany(BlockedUser::class, 'blocked_user_id', 'id');
    }
}
