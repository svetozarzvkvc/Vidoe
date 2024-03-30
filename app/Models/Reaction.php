<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    public function getVideo(){
        return $this->belongsToMany(Video::class);
    }

    public function comments()
    {
        return $this->belongsToMany(Comment::class);

    }
}
