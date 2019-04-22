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