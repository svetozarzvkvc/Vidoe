<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class Comment extends Model
{
    use HasFactory;
    protected $fillable=['id','text','video_id','user_id','parent_id'];
    public function getChildren(){
        return $this->hasMany(Comment::class,'parent_id');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function getParent()
    {
        return $this->belongsTo(Comment::class,"id",'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Comment::class,"parent_id",'id');
    }

    public function getReaction(){


        if (Auth::check()){
            $trenutniUserAuthId = Auth::user()->id;
        }
        else{
            $trenutniUserAuthId = null;
        }
        return $this->belongsToMany(Reaction::class)->wherePivot('user_id',$trenutniUserAuthId);
    }


    public function reactions()
    {
        return $this->belongsToMany(Reaction::class,'comment_reaction');

    }

    public function getTotalLikes()
    {
        return $this->belongsToMany(Reaction::class)->wherePivot('reaction_id',1);
    }

    public function getTotalDislikes()
    {
        return $this->belongsToMany(Reaction::class)->wherePivot('reaction_id',2);
    }

    public function totalComments($videoId)
    {
        $video = Video::find($videoId);

        if ($video) {
            $totalComments = $video->getComments()->count();
            return $totalComments;
        }
        return "Comments not found.";
    }
}
