<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Models\ActionLog;
use App\Models\Country;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends GenesisController
{
    //
    public function show(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $userSubs = $user::with('subscriptions')->find($id);
        $videosData = $user->getVideos()->orderBy('created_at', 'desc')->paginate(4);
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $videosData = $user->getVideos()
                ->orderBy($sort_by, $sort_type)->paginate(4);
            $page='My videos';
            return view('pages.client.channels.data', compact('videosData','page'))->render();
        }
        return view("pages.client.dashboard.index",['page'=>'My videos','videosData'=>$videosData,'userSubs'=>$userSubs]);
    }
    public function insertSub(Request $request)
    {
        if (Auth::check()){
            $trenutniUserAuth = Auth::user();
        }
        $subbedId = $request->subbedChannel;

        $logData = [
            "ip"=>$request->ip(),
            "path" => "insertsub",
            "method"=>"POST",
            "user_id"=> Auth::user()->id,
            "action"=>"User subscribed to user (ID:".$subbedId.")"
        ];
        $action = new ActionLog();
        $action->insertLog($logData);
        $trenutniUserAuth->subscriptions()->attach($subbedId);
    }

    public function edit($id)
    {
        $userData = User::find($id);
        $cuntries = Country::all();
        return view('pages.client.dashboard.edit',['userData'=>$userData, 'countries'=>$cuntries]);
    }

    public function update(UserEditRequest $request, $user)
    {

        $userData = $request->only('username','email','country');
        $userUpdate = User::find($user);

        $userUpdate->username=$userData['username'];
        $userUpdate->email=$userData['email'];
        $userUpdate->country_id=$userData['country'];

        if ($request->avatar){
            $avatar = time() . "." . $request->avatar->extension();
            $request->avatar->move(public_path('assets/img'), $avatar);
            $userUpdate->avatar=$avatar;
        }

        $userUpdate->save();

        return redirect()->back()->with('success-updated','You have successfully updated your profile.');
    }

    public function getSubscribers(Request $request, $channelid)
    {
        $channel = User::findOrFail($channelid);
        $totalSubs = $channel->subscribers()->count();

        return response()->json([
            'totalSubs' => $totalSubs,
            'channel'=>$channel
        ]);
    }
    public function deleteSub(Request $request)
    {
        if (Auth::check()){
            $trenutniUserAuth = Auth::user();
        }

        $subbedId = $request->subbedChannel;

        $logData = [
            "ip"=>$request->ip(),
            "path" => "deleteSub",
            "method"=>"DELETE",
            "user_id"=> Auth::user()->id,
            "action"=>"User unsubscribed from user (ID:".$subbedId.")"
        ];
        $action = new ActionLog();
        $action->insertLog($logData);

        $trenutniUserAuth->subscriptions()->detach($subbedId);
    }

    public function showSubscriptions(Request $request, $id)
    {

        $userSubs = User::with('subscriptions')->find($id);
        $videos = collect();
        foreach ($userSubs->subscriptions as $sub){
            $videos = $videos->merge($sub->getVideos);
        }
        $videos = $videos->sortByDesc('created_at');

        $perPage = 10;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $items = $videos->forPage($currentPage, $perPage);
        $videosData = new LengthAwarePaginator($items, $videos->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');

            if ($sort_type == 'asc'){
                $videos = $videos->sortBy($sort_by);
            }
            if($sort_type == 'desc'){
                $videos = $videos->sortByDesc($sort_by);
            }

            $items = $videos->forPage($currentPage, $perPage);
            $videosData = new LengthAwarePaginator($items, $videos->count(), $perPage, $currentPage, [
                'path' => LengthAwarePaginator::resolveCurrentPath(),
            ]);
            $page='Subscriptions';
            return view('pages.client.channels.data', compact('videosData','page'))->render();
        }
         return view('pages.client.subscriptions.index',['page'=>'Subscriptions','videosData'=>$videosData]);
    }
}
