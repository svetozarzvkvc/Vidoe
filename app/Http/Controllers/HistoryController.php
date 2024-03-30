<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends GenesisController
{
    //
    public function show(Request $request, $user = null)
    {
//        if ($user !== null){
//
//        }
        $userObj = User::findOrFail($user);
//        else{
//            return redirect()->route('login.index')->with('please-login','Please login in order to view this page.');
//        }
        $historyObj = Playlist::where([
            ['name','History'],
            ['user_id',$userObj->id]
        ])->first();
        $videosData = $historyObj->videos()->orderBy('created_at','desc')->paginate(4);
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $videosData = $historyObj->videos()
                ->orderBy($sort_by, $sort_type)->paginate(4);
            $page='History';
            return view('pages.client.channels.data', compact('videosData','page'))->render();
        }
       return view('pages.client.history.show',['page'=>'History','videosData'=>$videosData]);
    }

    public function destroy($video)
    {
        $userId = Auth::user()->id;
        $historyObj = Playlist::where([
            ['name','History'],
            ['user_id',$userId]
        ])->first();
        if($historyObj->videos()->where('video_id',$video)->exists()){
            $historyObj->videos()->detach($video);
            return redirect()->back()->with('success-deleted','You have successfully deleted your video.');
        }
        else{
            return redirect()->back()->with('error-msg', 'Server error');
        }
    }
}
