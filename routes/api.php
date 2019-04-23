<?php

use Illuminate\Http\Request;

// use Symfony\Component\Routing\Annotation\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::apiResource('users', 'UsersController'); // API routes for User

Route::apiResource('videos', 'VideosController'); // API routes for Video

Route::group(['prefix' => 'videos'], function () {
    Route::post('{video}/like', 'LikesController@store')->name('likeUnlike'); // API routes for liking/unliking a video
    Route::get('likes/count', 'LikesController@index')->name('AlllikeCount'); // API routes for like count of all video
    Route::get('{video}/likes/count', 'LikesController@show')->name('likeCount'); // API routes for like count of a video
});