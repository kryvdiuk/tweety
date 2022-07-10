<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware("auth")->group(function() {

    Route::get("/tweets", "TweetsController@index")->name('home');
    Route::post("/tweets", "TweetsController@store");

    // Like/dislike
    Route::post("/tweets/{tweet}/likes", "TweetLikesController@storeLike");
    Route::post("/tweets/{tweet}/dislikes", "TweetLikesController@storeDislike");
    Route::delete("/tweets/{tweet}/likes", "TweetLikesController@destroy");

    // Retweet
    Route::post("/tweets/{tweet}/retweet", "TweetsRetweetController@store");

    Route::get("/explore", "ExploreController")->name('explore');
    Route::get("/profile/{user:username}", "ProfileController@index")->name("profile");
    Route::get("/profile/{user:username}/edit", "ProfileController@edit")->middleware('can:edit,user');
    Route::patch("/profile/{user:username}", "ProfileController@update")->middleware('can:edit,user');
    Route::post("/profile/{user:username}/follow", "FollowsController@store");
    Route::get('/profile/{user:username}/followers', 'FollowersController@index');
    Route::get('/profile/{user:username}/followees', 'FolloweesController@index');
});


Auth::routes();
