<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    public function dashBoardStats()
    {
        $dashboardStatsArray = [
            [
                'color'=> "bg-primary",
                'icon'=> "fa-users",
                "text"=>"Users",
                "count" => User::count(),
                "route"=>"admin.users"
            ],
            [
                'color' => "bg-warning",
                'icon'=> "fa-video",
                "text"=>"Videos",
                "count" => Video::count(),
                "route"=>"admin.videos"
            ],
            [
                'color'=> "bg-success",
                'icon'=> "fa-eye",
                "text"=>"Views",
                "count" => number_format(Video::sum('total_views')),
                "route"=>"admin.videos"
            ],
            [
                'color'=> "bg-danger",
                'icon'=> "fa-list ",
                "text"=>"Categories",
                "count" => Category::count(),
                "route"=>"admin.categories"
            ],
        ];

        return $dashboardStatsArray;
    }

    public function returnActions()
    {
        return ActionLog::all();
    }
    public function returnUsers()
    {
        return User::with('role')->get();
    }

    public function returnVideos()
    {
        return Video::with('getUser')->get();
    }

    public function returnCategories()
    {
        return Category::all();
    }

    public function filter($dateFrom, $dateTo){
        if ($dateFrom && $dateTo){
            $dateFrom = Carbon::parse($dateFrom);
            $dateTo = Carbon::parse($dateTo)->endOfDay();
            $records = ActionLog::whereBetween('created_at', [$dateFrom, $dateTo])->get();
        }
        else{
            $records = ActionLog::all();
        }

        return $records;
    }
}
