<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoEditRequest;
use App\Http\Requests\VideoStoreRequest;
use App\Models\ActionLog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Playlist;
use App\Models\Reaction;
use App\Models\User;
use App\Models\Video;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use FFMpeg\FFProbe;
use FFMpeg\Filters\Frame\CustomFrameFilter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use Mockery\Exception;

class VideoController extends GenesisController
{
    //
    public function show(Request $request, $video)
    {
        $randomVideos = Video::with('getCategories')->where('id','!=',$video)->inRandomOrder()->limit(10)->get();
        $videoJedan = Video::with(['getCategories','getUser'])->find($video);

        if (Auth::check()){
            $userId = Auth::user()->id;
            $historyObj = Playlist::where([
                ['name','History'],
                ['user_id',$userId]
            ])->first();
            if($historyObj!=null){
                if(!$historyObj->videos()->where('video_id',$video)->exists()){
                    $historyObj->videos()->attach($video);
                }
            }
        }
        $logData = [
            "ip"=>$request->ip(),
            "path" => "videos.show",
            "method"=>"GET",
            "user_id"=> Auth::user() ? Auth::user()->id : null,
            "action"=>"User viewed video (ID:".$video.")"
        ];

        $videoView = ActionLog::where('action', "User viewed video (ID:".$video.")")
            ->where('ip', $request->ip())
            ->first();

        if (!$videoView) {
            $videoUpdate = Video::find($video);
            $videoUpdate->total_views++;
            $videoUpdate->save();
        }
        $action = new ActionLog();
        $action->insertLog($logData);

        return view('pages.client.videos.show',['video'=>$videoJedan,'randomVideos'=>$randomVideos]);
    }

    public function edit(Request $request, $video)
    {
        $videoSlanje = Video::with('getCategories')->find($video);
        $categories = Category::all();
        return view('pages.client.videos.edit',['video'=>$videoSlanje, "categories"=>$categories]);
    }

    public function update(VideoEditRequest $request, $video)
    {
        $data = $request->only('title','description');
        try {
            DB::beginTransaction();
            $videoUpdate = Video::find($video);
            $videoUpdate-> title = $data['title'];
            $videoUpdate-> description = $data['description'];

            $videoUpdate->getCategories()->detach($video);
            foreach ($request->categories as $category){
                $videoUpdate->getCategories()->attach($category);
            }
            $videoUpdate->save();

            $logData = [
                "ip"=>$request->ip(),
                "path" => "videos.update",
                "method"=>"PUT",
                "user_id"=> Auth::user()->id,
                "action"=>"User updated video (ID:".$video.")"
            ];
            $action = new ActionLog();
            $action->insertLog($logData);


            DB::commit();


            return redirect()->back()->with('success-update','You have successfully updated your video.');
        }
        catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error-msg', "Server encountered  an error" . $e->getMessage());
        }
    }

    public function destroy(Request $request, $video)
    {
        $videoBaza = Video::find($video);
        if($videoBaza->exists()){
            $videoBaza->getCategories()->detach();

            foreach ($videoBaza->getComments as $comment){
                $comment->reactions()->detach();
            }
            foreach ($videoBaza->getComments as $comment){
                $comment->delete();
            }

            $videoBaza->playlist()->detach();
            $videoBaza->reactions()->detach();
            $videoBaza->delete();

            $logData = [
                "ip"=>$request->ip(),
                "path" => "videos.destroy",
                "method"=>"DELETE",
                "user_id"=> Auth::user()->id,
                "action"=>"User deleted video (ID:".$video.")"
            ];
            $action = new ActionLog();
            $action->insertLog($logData);

            return redirect()->back()->with('success-deleted','You have successfully deleted your video.');
        }
        else{
            return redirect()->back()->with('error-msg', 'Server error');
        }
    }
    public function create()
    {
        $kategorije = Category::all();
//        if(!Auth::check()){
//            return redirect()->route('login.index')->with('please-login','Please login in order to view this page.');
//        }
        return view('pages.client.videos.create',['kategorije'=>$kategorije]);
    }

    public function store(VideoStoreRequest $request)
    {
        $podaci = $request->only('title','description');
        $videoName = time() . '.' . $request->video->extension();
        $timestamp = explode('.', $videoName)[0];

        if (Auth::check()){
            $trenutniUserAuthId = Auth::user()->id;
        }

        try{
            DB::beginTransaction();
            $request->video->move(public_path('assets/video'),$videoName);

            $ffmpeg = FFMpeg::create([
                'ffmpeg.binaries'  => base_path('vendor/ffmpeg/bin/ffmpeg.exe'),

                'ffprobe.binaries' => base_path('vendor/ffmpeg/bin/ffprobe.exe'),
            ]);


            $videoPath = public_path('assets/video/'.$videoName);
            $framePath = public_path('assets/thumbnail/'.$timestamp.'.jpg');
            $filesize = filesize(public_path('assets/video/'.$videoName));
            $video = $ffmpeg->open($videoPath);
            $video -> frame(TimeCode::fromSeconds(6))
                ->addFilter(new CustomFrameFilter('scale=270x169'))
                ->save($framePath);

            $ffprobe = FFProbe::create([
                'ffmpeg.binaries'  => base_path('vendor/ffmpeg/bin/ffmpeg.exe'),
                'ffprobe.binaries' => base_path('vendor/ffmpeg/bin/ffprobe.exe')
            ]);

            $mediaInfo = $ffprobe
                ->format($videoPath)
                ->get('duration');

            $durationInSeconds = $mediaInfo;

            $videoId = Video::create([
               "title"=>$podaci['title'],
               "description"=>$podaci['description'],
               "src"=>$videoName,
               "thumbnail"=>$timestamp.'.jpg',
                "duration"=>$durationInSeconds,
                "size"=>$filesize,
                "user_id"=>$trenutniUserAuthId
            ]);
            foreach($request->categories as $categoryId){
                $videoPoslenji = Video::find($videoId->id);
                $videoPoslenji->getCategories()->attach($categoryId);
            }

            $logData = [
                "ip"=>$request->ip(),
                "path" => "videos.store",
                "method"=>"POST",
                "user_id"=> Auth::user()->id,
                "action"=>"User created video (ID:".$videoId->id.")"
            ];
            $action = new ActionLog();
            $action->insertLog($logData);


            DB::commit();

            return redirect()->back()->with('success-message', "Video uploaded successfully.");
        }
        catch (Exception $e){
            DB::rollBack();
            if(File::exists(public_path('/assets/video/' . $videoName))){
                File::delete(public_path('/assets/video/' . $videoName));
            }
            return redirect()->back()->with('error-msg', "Server encountered an error ".$e->getMessage());
        }

    }

    public function getReactions(Request $request, $videoId)
    {
        $video = Video::findOrFail($videoId);
        $likesCount = $video->reactions()->where('reaction_id', 1)->count();
        $dislikesCount = $video->reactions()->where('reaction_id', 2)->count();


        return response()->json([
            'likesCount' => $likesCount,
            'dislikesCount' => $dislikesCount
        ]);
    }



    public function videoReaction(Request $request)
    {

        $video = Video::find($request->videoId);
        if (Auth::check()){
            $trenutniUserAuthId = Auth::user()->id;
            $reaction = Reaction::find($request->reactionId);
            $video->reactions()->attach($reaction->id, ['user_id' => $trenutniUserAuthId]);
            $historyObj = Playlist::where([
                ['name','Liked videos'],
                ['user_id',$trenutniUserAuthId]
            ])->first();
            $reactionType = "liked";
            if ($reaction->id == 2){
                $reactionType = "disliked";
                $historyObj->videos()->detach($video->id);
            }
            else{
                if($historyObj!= null){
                    if(!$historyObj->videos()->where('video_id',$video)->exists()){
                        $historyObj->videos()->attach($video);
                    }
                }
            }
        }

        $logData = [
            "ip"=>$request->ip(),
            "path" => "videoReaction",
            "method"=>"POST",
            "user_id"=> Auth::user()->id,
            "action"=>"User " .$reactionType." video (ID:".$video->id.")"
        ];
        $action = new ActionLog();
        $action->insertLog($logData);

        $lajkovi = $video->getTotalLikes->count();

        $dislajkovi = $video->getTotalDislikes->count();
        $video->total_likes = $lajkovi;
        $video->total_dislikes = $dislajkovi;

        $video->save();
    }

    public function videoReactionDelete(Request $request)
    {
        $video = Video::find($request->videoId);
        $reaction = Reaction::find($request->reactionId);

        if (Auth::check()){
            $trenutniUserAuthId = Auth::user()->id;
        }

        $video->reactions()->wherePivot('user_id', $trenutniUserAuthId)->wherePivot('reaction_id', $reaction->id)->detach();
        $userId = Auth::user()->id;
        $historyObj = Playlist::where([
            ['name','Liked videos'],
            ['user_id',$userId]
        ])->first();
        if ($reaction->id == 1){
            $historyObj->videos()->detach($video->id);
        }

        $lajkovi = $video->getTotalLikes->count();
        $dislajkovi = $video->getTotalDislikes->count();
        $video->total_likes = $lajkovi;
        $video->total_dislikes = $dislajkovi;
        $video->save();

    }
}
