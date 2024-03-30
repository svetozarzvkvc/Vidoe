<?php

namespace App\Http\Controllers;

use App\Events\PostLiked;
use App\Models\ActionLog;
use App\Models\Comment;
use App\Models\Reaction;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;

class CommentController extends GenesisController
{
    //
    public function sendComments($id)
    {
        $trenutniUserAuth = null;
        if (Auth::check()){
            $trenutniUserAuth = Auth::user();
        }
        $komentari = Comment::with(['getChildren', 'getUser', 'getParent', 'getReaction','getTotalLikes','getTotalDislikes'])->where('video_id', $id)->get();
        $responseData = [
            "comments" => $komentari,
            "userData" => $trenutniUserAuth
        ];
        return response()->json($responseData);
    }

    public function getReactions(Request $request, $commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $likesCount = $comment->reactions()->where('reaction_id', 1)->count();
        $dislikesCount = $comment->reactions()->where('reaction_id', 2)->count();

        return response()->json([
            'likesCount' => $likesCount,
            'dislikesCount' => $dislikesCount
        ]);
    }
    public function commentReaction(Request $request)
    {

        if (Auth::check()){
            $trenutniUserAuthId = Auth::user()->id;
        }

        $comment = Comment::find($request->commentID);
        $reaction = Reaction::find($request->reactionId);

        $reactionType = "liked";
        if($request->reactionId == 2){
            $reactionType = "disliked";
        }
        $logData = [
            "ip"=>$request->ip(),
            "path" => "commentReaction",
            "method"=>"POST",
            "user_id"=> Auth::user()->id,
            "action"=>"User ".$reactionType ." comment (ID:".$comment->id.")"
        ];
        $action = new ActionLog();
        $action->insertLog($logData);


        $comment->reactions()->attach($reaction->id, ['user_id' => $trenutniUserAuthId]);

        $lajkovi = $comment->getTotalLikes->count();
        $dislajkovi = $comment->getTotalDislikes->count();
        $comment->total_likes = $lajkovi;
        $comment->total_dislikes = $dislajkovi;
        $comment->save();


    }

    public function deleteReaction(Request $request)
    {
        $comment = Comment::find($request->commentID);

        $reaction = Reaction::find($request->reactionId);
        if (Auth::check()){
            $trenutniUserAuthId = Auth::user()->id;
        }
        $comment->reactions()->wherePivot('user_id', $trenutniUserAuthId)->wherePivot('reaction_id', $reaction->id)->detach();

        $lajkovi = $comment->getTotalLikes->count();
        $dislajkovi = $comment->getTotalDislikes->count();
        $comment->total_likes = $lajkovi;
        $comment->total_dislikes = $dislajkovi;
        $comment->save();
    }

    public function deleteComment(Request $request)
    {
        $commentDelete = Comment::find($request->commentId);

        if ($commentDelete != null){
            $commentDelete->reactions()->detach();
            foreach ($commentDelete->children as $child){
                $child->reactions()->detach();
            }
            $commentDelete->delete();

            $logData = [
                "ip"=>$request->ip(),
                "path" => "deleteComment",
                "method"=>"DELETE",
                "user_id"=> Auth::user()->id,
                "action"=>"User deleted comment from video (ID:".$request->commentId.")"
            ];
            $action = new ActionLog();
            $action->insertLog($logData);

        }
    }

    public function store(Request $request)
    {

        if (Auth::check()){
            $trenutniUserAuthId = Auth::user()->id;
        }

        Comment::create([
            "text" => $request->videotext,
            "video_id"=>$request->videoid,
            "user_id"=>$trenutniUserAuthId,
            "parent_id"=>$request->parentid
        ]);

        $logData = [
            "ip"=>$request->ip(),
            "path" => "comments.store",
            "method"=>"POST",
            "user_id"=> Auth::user()->id,
            "action"=>"User commented on video (ID:".$request->videoid.")"
        ];
        $action = new ActionLog();
        $action->insertLog($logData);

        $komentari = Comment::with(['getChildren','getUser','getParent'])->where('video_id',$request->videoid)->get();
        return response()->json($komentari);
    }

    public function commentsCount(Request $request)
    {
        $comments = new Comment();
        return $comments->totalComments($request->videoId);
    }



}
