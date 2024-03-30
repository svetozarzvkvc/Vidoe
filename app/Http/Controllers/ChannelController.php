<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChannelController extends GenesisController
{

    public function show(Request $request,$channel)
    {

        $user = User::findOrFail($channel);
        $videosData = $user->getVideos()->orderBy('created_at', 'desc')->paginate(8);
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('search1');
            $query = str_replace(" ", "%", $query);
            $videosData = $user->getVideos()
                ->when($request->search1, function ($query) use ($request) {
                    $query->where('title', 'like', '%' . $request->search1 . '%');
                })
                ->orderBy($sort_by, $sort_type)->paginate(8);
            $page='Videos';
            return view('pages.client.channels.data', compact('videosData','page'))->render();
        }


        return view("pages.client.channels.show",['page'=>'Videos','userData'=>$user,'videosData'=>$videosData]);
    }
}
