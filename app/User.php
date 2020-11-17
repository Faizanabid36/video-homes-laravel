<?php

namespace App;

use App\Jobs\DeleteVideos;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Nagy\LaravelRating\Traits\Rate\CanRate;

class User extends Authenticatable
{
    use Notifiable, CanRate;

    protected $with = ['user_extra'];

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
            $playlist->name = 'Unlisted';
            $playlist->user_id = $user->id;
            $playlist->save();
        });
        static::deleting(function ($user) {
            $user->user_extra()->delete();
            Playlist::whereUserId($user->id)->delete();
            Video::whereUserId($user->id)->delete();
            UserMessage::where('reply_user_id', $user->id)->delete();
            UserMessage::where('contact_user_id', $user->id)->delete();
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

    public function account_types()
    {
        return $this->hasOne(AccountType::class, 'user_id');
    }

    public function user_role()
    {
        return $this->hasOne(UserRole::class, 'id', 'role');
    }

    public function user_extra()
    {
        return $this->hasOne(UserExtra::class, 'user_id', 'id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'user_id', 'id');
    }

    public function isAdmin()
    {
        return $this->role === 1;
    }

    public function to_me_messages()
    {
        return $this->hasMany(UserMessage::class, 'contact_user_id');
    }

    public function from_me_messages()
    {
        return $this->hasMany(UserMessage::class, 'reply_user_id');
    }

    public function isUser()
    {
        return $this->role > 1;
    }

    public function isActive()
    {
        return $this->active === 1;
    }
}
