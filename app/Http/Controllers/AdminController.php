<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\VideoEditRequest;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Playlist;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash as Hash;
use Intervention\Image\Tests\Colors\Hsl\ChannelTest;
use Mockery\Exception;

class AdminController extends Controller
{
    //
    public function index(Request $request)
    {
        $obj = new Admin();
        $stats = $obj->dashBoardStats();
        return view('pages.admin.dashboard',['stats'=>$stats]);
    }

    public function actions(Request $request){
        $obj = new Admin();
        $actions = $obj->filter($request->input('from'), $request->input('to'));
        return view('pages.admin.actions.index',['actions'=>$actions]);
    }

    public function users(){
        $obj = new Admin();
        $users = $obj->returnUsers();
        return view('pages.admin.users.index',['users'=>$users]);
    }

    public function videos(){
        $obj = new Admin();
        $videos = $obj->returnVideos();
        return view('pages.admin.videos.index',['videos'=>$videos]);
    }

    public function categories(){
        $obj = new Admin();
        $categories = $obj->returnCategories();
        return view('pages.admin.categories.index',['categories'=>$categories]);
    }

    //USERS POCETAK
    public function create()
    {
        return view('pages.admin.users.create');
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->only('username','email','password');

        try {
            DB::beginTransaction();
            $passwordInput = Hash::make($data['password']);
            $user = User::create([
                "username"=>$data['username'],
                "email"=>$data['email'],
                "password" => $passwordInput,
                //"country_id"=>$countryId->id,
                "country_id"=>rand(1,150),
                'role_id'=>1,
                'email_verified_at'=>\Carbon\Carbon::now()
            ]);
            //dd($user);
            Playlist::insert([
                [
                    "name"=>"History",
                    "user_id"=>$user->id
                ],
                [
                    "name"=>"Liked videos",
                    "user_id"=>$user->id
                ]
            ]);
            DB::commit();
            //$user->sendEmailVerificationNotification();
            return redirect()->back()->with('success-msg','User added successfully.');
        }
        catch (Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error-msg', "Server encountered an error ".$e->getMessage());
        }
    }

    public function destroy($user)
    {
        $userDelete = User::find($user);

        if ($userDelete) {
            try {
                DB::beginTransaction();

                foreach ($userDelete->getVideos as $video){
                    $video->getCategories()->detach();
                    $video->playlist()->detach();
                    $video->reactions()->detach();


                    foreach ($video->getComments as $comment){
                        $comment->reactions()->detach();

                    }
                    foreach ($video->getComments as $deleteComment){
                        $deleteComment->delete();
                    }
                }
                foreach ($userDelete->getComments as $userComment){
                    $userComment->reactions()->detach();
                }
                foreach ($userDelete->getComments as $userCommentDelete){
                    $userCommentDelete->delete();
                }

                foreach ($userDelete->playlists as $playlist){
                    $playlist->videos()->detach();
                }

                foreach ($userDelete->playlists as $playlist){
                    $playlist->delete();
                }

                foreach ($userDelete->getVideos as $video){
                    $video->delete();
                }
                $userDelete->videoReactions()->detach();
                $userDelete->commentReactions()->detach();
                $userDelete->subscriptions()->detach();
                $userDelete->subscribers()->detach();

                $userDelete->delete();
                DB::commit();
                return redirect()->back()->with('success-msg', 'User deleted successfully.');
            }
            catch (Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error-msg', 'Server encountered an error '.$e->getMessage());
            }
        }
        return redirect()->back()->with('error-msg', 'User not found.');
    }

    public function edit($user)
    {
        $user = User::find($user)->first();
        return view('pages.admin.users.edit',['user'=>$user]);
    }

    public function update(UserEditRequest $request, $user)
    {
        try{
            $data = $request->only('username','email');
            $userUpdate = User::find($user)->first();
            $userUpdate->username = $data['username'];
            $userUpdate->email = $data['email'];
            $userUpdate->save();
            return redirect()->back()->with('success-msg', 'User deleted successfully.');
        }
        catch (Exception $e){
            return redirect()->back()->with('error-msg', 'Server encountered an error '.$e->getMessage());
        }
    }
    //USERS KRAJ

    //VIDEOS POCETAK
    public function videoEdit($video)
    {
        $video = Video::find($video)->first();
        return view('pages.admin.videos.edit',['video'=>$video]);
    }

    public function videoUpdate(Request $request, $video)
    {
        try{
            $validatedData = $request->validate([
                "title" => "required|string|min:5|max:100",
                "description" => "required|string|min:10|max:250",
            ]);

            $videoUpdate = Video::find($video)->first();
            $videoUpdate->update($validatedData);
            $videoUpdate->save();
            return redirect()->back()->with('success-msg', 'Video updated successfully.');
        }
        catch (Exception $e){
            return redirect()->back()->with('error-msg', 'Server encountered an error '.$e->getMessage());
        }
    }

    public function videoDestroy($video)
    {
        $videoDelete = Video::find($video);

        if ($videoDelete) {
            try {
                DB::beginTransaction();
                $videoDelete->getCategories()->detach();

                foreach ($videoDelete->getComments as $comment){
                    $comment->reactions()->detach();
                }

                $videoDelete->playlist()->detach();
                $videoDelete->reactions()->detach();
                foreach ($videoDelete->getComments as $comment){
                    $comment->delete();
                }

                $videoDelete->delete();

                DB::commit();
                return redirect()->back()->with('success-msg', 'Video deleted successfully.');
            }
            catch (Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error-msg', 'Server encountered an error '.$e->getMessage());
            }
        }
        return redirect()->back()->with('error-msg', 'User not found.');
    }

    //VIDEOS KRAJ

    //KATEGORIJE POCETAK
    public function categoryCreate()
    {
        return view('pages.admin.categories.create');
    }

    public function categoryEdit($category)
    {
        $category = Category::find($category)->first();
        return view('pages.admin.categories.edit',['category'=>$category]);
    }

    public function categoryStore(Request $request)
    {
        $validatedData = $request->validate([
            "categoryName" => "required|string|min:5|max:100"
        ]);
        Category::create([
            "name"=>$validatedData['categoryName']
        ]);

        return redirect()->back()->with('success-msg', 'Category added successfully.');

    }

    public function categoryDestroy($category)
    {
        $categoryDelete = Category::find($category);

        if ($categoryDelete) {
            try {
                DB::beginTransaction();
                $categoryDelete->getVideos()->detach();
                $categoryDelete->delete();

                DB::commit();
                return redirect()->back()->with('success-msg', 'Category deleted successfully.');
            }
            catch (Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error-msg', 'Server encountered an error '.$e->getMessage());
            }
        }
        return redirect()->back()->with('error-msg', 'Category not found.');
    }

    public function categoryUpdate(Request $request, $category)
    {
        try{
            $validatedData = $request->validate([
                "categoryname" => "required|string|min:5|max:100"
            ]);

            $categoryUpdate = Category::find($category)->first();
            $categoryUpdate->name= $validatedData['categoryname'];
            $categoryUpdate->save();
            return redirect()->back()->with('success-msg', 'Category updated successfully.');
        }
        catch (Exception $e){
            return redirect()->back()->with('error-msg', 'Server encountered an error '.$e->getMessage());
        }

    }

    //KATEGORIJE KRAJ

}
