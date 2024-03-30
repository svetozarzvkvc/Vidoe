<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikedVideosController extends GenesisController
{
    //
    public function show(Request $request, $user = null)
    {
//        if ($user !== null){
            $userObj = User::findOrFail($user);
//        }
//        else{
//            return redirect()->route('login.index')->with('please-login','Please login in order to view this page.');
//        }
        $historyObj = Playlist::where([
            ['name','Liked videos'],
            ['user_id',$userObj->id]
        ])->first();
        $videosData = $historyObj->videos()->orderBy('created_at','desc')->paginate(4);
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $videosData = $historyObj->videos()
                ->orderBy($sort_by, $sort_type)->paginate(4);
            $page='Liked videos';
            return view('pages.client.channels.data', compact('videosData','page'))->render();
        }
        return view('pages.client.history.show',['page'=>'Liked videos','videosData'=>$videosData]);
    }

    public function destroy($video)
    {
        $videoObj = Video::find($video);
        $userId = Auth::user()->id;
        $historyObj = Playlist::where([
            ['name','Liked videos'],
            ['user_id',$userId]
        ])->first();
        if($historyObj->videos()->where('video_id',$video)->exists()){
            $historyObj->videos()->detach($video);
            $videoObj->reactions()->wherePivot('user_id', $userId)->wherePivot('reaction_id', 1)->detach();
            return redirect()->back()->with('success-deleted','You have successfully deleted the video from liked playlist.');
        }
        else{
            return redirect()->back()->with('error-msg', 'Server error');
        }
    }
}
