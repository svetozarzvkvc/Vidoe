<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    public function getVideos()
    {
        return $this->belongsToMany(Video::class,'video_category');
    }

    public function kategorijaPoPregledima()
    {
        return Category::all()->sortByDesc(function ($element){
            $element->getVideos->sum('total_views');
        });
    }

    public function videosCount()
    {
        return $this->getVideos()->count();
    }
}
