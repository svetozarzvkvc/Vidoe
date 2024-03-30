<?php

namespace App\Providers;

use App\Models\Menu;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


//sesija
use App\Models\User;
use Illuminate\Support\Facades\Session;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrap();

        $user = Auth::user();

       $menu = Menu::where('admin',0)->get();
       $menuAdmin = Menu::where('admin',1)->get();
        //$currentUser = Session::get('user');
        //$sidebarSubs = User::with('subscriptions')->find($currentUser->id);


        View::share([
           'menu'=>$menu,
           'menuAdmin'=>$menuAdmin
            //'user'=>$user,
            //'sidebarSubs'=>$sidebarSubs
        ]);
    }
}
