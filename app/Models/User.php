<?php

namespace App\Models;

use App\Notifications\VerifyEmailNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens,HasFactory, Notifiable
;

    protected $fillable=['firstname','password','lastname','username','email','avatar','role_id','country_id','email_verified_at'];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification);
    }
    public function getVideos()
    {
        return $this->hasMany(Video::class);
    }

    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }


    public function subscribers()
    {
        return $this->belongsToMany(User::class,'subscriptions','subscribed_id', 'subscriber_id');
    }

    public function subscriptions()
    {
        return $this->belongsToMany(User::class,'subscriptions','subscriber_id', 'subscribed_id');
    }

    public function isSubscribedTo($userId)
    {
        return $this->subscriptions()->where('subscribed_id', $userId)->exists();
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function username($id)
    {
        $user = User::find($id)->first();
        return $user->username;
    }

    public function videoReactions(){
        return $this->belongsToMany(Video::class,'video_reaction');
    }

    public function commentReactions(){
        return $this->belongsToMany(Comment::class,'comment_reaction');
    }

    public function getComments(){
        return $this->hasMany(Comment::class);
    }
}
