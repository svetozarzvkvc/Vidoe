<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public function getChildren()
    {
        return $this->hasMany(Menu::class,'parent_id','id');
    }

}
