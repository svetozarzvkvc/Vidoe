<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use App\Models\Video;
use Couchbase\DesignDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends GenesisController
{

    public function index(Request $request)
    {

        $currentUserData = Auth::user();
        $videosData = Video::orderby('created_at','desc')->paginate(8);
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');

            $query = $request->get('search');

            $query = str_replace(" ", "%", $query);
            //dd($query);

            $videosData = Video::where('id','like','%'.$query.'%')
                ->orWhere('title', 'like', '%'.$query.'%')
                ->orWhere('description', 'like', '%'.$query.'%')
                ->orderBy($sort_by, $sort_type)
                ->paginate(8);

            $page='Featured videos';
            return view('pages.client.channels.data', compact('videosData','page'))->render();
        }

        if (!$request->is('home') && $request->has('search')) {

            $query = $request->input('search');
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $users = User::with('subscribers','getVideos')->get()->sortByDesc(function ($user){
                return $user->getVideos->sum('total_views');
            })->take(4);

            $kategorije = Category::all();

            $videosData = Video::where('id','like','%'.$query.'%')
                ->orWhere('title', 'like', '%'.$query.'%')
                ->orWhere('description', 'like', '%'.$query.'%')
                ->orderBy($sort_by, $sort_type)
                ->paginate(8);
            return view("pages.client.home",['currentUserData'=>$currentUserData,'page'=>'Featured videos','videosData'=>$videosData, "users"=>$users,'categories'=>$kategorije]);
        }

        $users = User::with('subscribers','getVideos')->get()->sortByDesc(function ($user){
            return $user->getVideos->sum('total_views');
        })->take(4);

        $kategorije = Category::all();
        return view("pages.client.home",['currentUserData'=>$currentUserData,'page'=>'Featured videos','videosData'=>$videosData, "users"=>$users,'categories'=>$kategorije]);
    }

    public function categoriesFilter(Request $request, $category)
    {

        $categoryObj = Category::findOrFail($category);
        $categoryVideos = $categoryObj::with('getVideos')->find($category);

        $videosData = $categoryVideos->getVideos()->orderBy('created_at', 'desc')->paginate(4);
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $videosData = $categoryVideos->getVideos()
                ->orderBy($sort_by, $sort_type)->paginate(4);
            $page=$categoryObj->name;
            return view('pages.client.channels.data', compact('videosData','page'))->render();
        }
        return view('pages.client.categories.filteredCategories',['page'=>$categoryObj->name,'videosData'=>$videosData]);
    }

}
