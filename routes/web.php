<?php

use App\Http\Controllers\ChannelController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LikedVideosController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//home kontroler
Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/categories/{category}',[HomeController::class,'categoriesFilter'])->name('categoriesFilter')->where('category','[0-9]+');

//comment kontroler
Route::get('/commentsCount',[CommentController::class,'commentsCount']);
Route::get('/comments/{id}',[CommentController::class,'sendComments']);
Route::get('/comments/{comment}/reactions',[CommentController::class,'getReactions']);


//video kontroler
Route::post('/videoReaction',[VideoController::class,'videoReaction'])->name('videoReaction');
Route::delete('/videoReactionDelete',[VideoController::class,'videoReactionDelete'])->name('videoReactionDelete');
Route::get('/videos/{video}/reactions',[VideoController::class,'getReactions'])
->where('video','[0-9]+');
Route::get('/videos/{video}',[VideoController::class,'show'])->name('videos.show')
    ->where('video','[0-9]+');


Route::middleware('isLoggedIn')->group(function () {
    Route::get('/history/{user?}',[HistoryController::class,'show'])->name('history.show');
    Route::delete('/history/{video}',[HistoryController::class,'destroy'])->name('history.destroy');


    Route::get('/liked/{user?}',[LikedVideosController::class,'show'])->name('liked.show');
    Route::delete('/liked/{video}',[LikedVideosController::class,'destroy'])->name('liked.destroy');

    Route::get('/videos/create',[VideoController::class,'create'])->name('videos.create');
    Route::post('/videos',[VideoController::class,'store'])->name('videos.store');
    Route::get('/videos/{video}/edit',[VideoController::class,'edit'])->name('videos.edit')->where('video','[0-9]+');
    Route::put('/videos/{video}',[VideoController::class,'update'])->name('videos.update');
    Route::delete('/videos/{video}',[VideoController::class,'destroy'])->name('videos.destroy');

    Route::post('/insertSub',[UserController::class,'insertSub'])->name('insertsub');
    Route::delete('/deleteSub',[UserController::class,'deleteSub'])->name('deleteSub');
    Route::get('/dashboard/{id}',[UserController::class,'show'])->name('dashboard.show')->where('id','[0-9]+');
    Route::get('/dashboard/{id}/edit',[UserController::class,'edit'])->name('dashboard.edit')->where('id','[0-9]+');
    Route::put('/dashboard/{user}',[UserController::class,'update'])->name('dashboard.update')->where('user','[0-9]+');
    Route::get('/subscriptions/{id}',[UserController::class,'showSubscriptions'])->name('subscriptions.show');

    Route::post('/commentReaction',[CommentController::class,'commentReaction'])->name('commentReaction');
    Route::post('/comments',[CommentController::class,'store'])->name('comments.store');
    Route::delete('/deleteComment',[CommentController::class,'deleteComment'])->name('deleteComment');
    Route::delete('/deleteReaction',[CommentController::class,'deleteReaction'])->name('deleteReaction');

});



//channel kontroler
Route::get('/channels/{channel}',[ChannelController::class,'show'])->name('channels.show');


//user kontroler
Route::get('/users/{user}/subscribers',[UserController::class,'getSubscribers'])->where('user','[0-9]+');


//auth i verifikacija
Auth::routes(['verify' => true]);
Auth::routes();
Route::get('verify-email/{id}/{hash}', [VerificationController::class,'verifyAndRedirect'])->name('verification.verify');
Route::get('/login',[AuthController::class,'showLoginForm'])->name('login.index');
Route::post('/login',[AuthController::class,'login'])->name('login.auth');
Route::post('/logout',[AuthController::class,'logout'])->name('login.logout');
Route::get('/register',[AuthController::class,'index'])->name('register.index');
Route::post('/register',[AuthController::class,'store'])->name('register.store');


//contact kontroler
Route::get('/contact',[ContactController::class,'index'])->name('contact.index');
Route::post('/contact',[ContactController::class,'store'])->name('contact.mail');

//admin kontroler
Route::middleware(['isLoggedIn','isAdmin'])->group(function (){
    Route::get('/dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('/dashboard/actions',[AdminController::class,'actions'])->name('admin.actions');
    Route::get('/dashboard/users',[AdminController::class,'users'])->name('admin.users');
    Route::get('/dashboard/videos',[AdminController::class,'videos'])->name('admin.videos');
    Route::get('/dashboard/categories',[AdminController::class,'categories'])->name('admin.categories');

    Route::get('/dashboard/users/create',[AdminController::class,'create'])->name('dashboard.users.create');
    Route::get('/dashboard/users/{user}/edit',[AdminController::class,'edit'])->name('dashboard.users.edit');
    Route::put('/dashboard/users/{user}',[AdminController::class,'update'])->name('dashboard.users.update');
    Route::post('/dashboard/users',[AdminController::class,'store'])->name('dashboard.users.store');
    Route::delete('/dashboard/users/{user}',[AdminController::class,'destroy'])->name('dashboard.users.destroy');


    Route::get('/dashboard/videos/{video}/edit',[AdminController::class,'videoEdit'])->name('dashboard.videos.edit');
    Route::put('/dashboard/videos/{video}',[AdminController::class,'videoUpdate'])->name('dashboard.videos.update');
    Route::delete('/dashboard/videos/{video}',[AdminController::class,'videoDestroy'])->name('dashboard.videos.destroy');

    Route::get('/categories/create',[AdminController::class,'categoryCreate'])->name('categories.create');
    Route::get('/categories/{category}/edit',[AdminController::class,'categoryEdit'])->name('categories.edit');
    Route::put('/categories/{category}',[AdminController::class,'categoryUpdate'])->name('categories.update');
    Route::post('/categories',[AdminController::class,'categoryStore'])->name('categories.store');
    Route::delete('/categories/{category}',[AdminController::class,'categoryDestroy'])->name('categories.destroy');
});

