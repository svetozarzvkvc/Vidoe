<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable=['title','src','description','duration','thumbnail','size','user_id'];

    public function getCategories()
    {
        return $this->belongsToMany(Category::class,'video_category');
    }

    public function getComments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getUser()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function reactions()
    {
        return $this->belongsToMany(Reaction::class,'video_reaction');
    }
    public function getTotalLikes()
    {
        return $this->belongsToMany(Reaction::class,'video_reaction')->wherePivot('reaction_id',1);
    }

    public function getTotalDislikes()
    {
        return $this->belongsToMany(Reaction::class,'video_reaction')->wherePivot('reaction_id',2);
    }

    public function userLikedVideo($id)
    {
        return $this->reactions()->where('user_id',$id)->where('reaction_id',1)->exists();
    }

    public function userDislikedVideo($id)
    {
        return $this->reactions()->where('user_id',$id)->where('reaction_id',2)->exists();
    }

    public function playlist()
    {
        return $this->belongsToMany(Playlist::class,'video_playlist');
    }
}
