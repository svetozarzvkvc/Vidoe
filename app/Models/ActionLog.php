<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionLog extends Model
{
    use HasFactory;

    protected $table="action_log";
    protected $fillable= ['ip','path','method','user_id','action'];
    public function insertLog($data)
    {
        ActionLog::create($data);
    }

    public function username($id){
        $user = User::find($id);
        if ($user) {
            return $user->username;
        }
        return "Account deleted";
    }
}
