<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileFollowerController;
use App\Http\Controllers\ProfileFollowingController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostImageController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\PostCommentController;

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
Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::resource('profiles', ProfileController::class);
});
Route::middleware('auth:api')->group(function () {
    Route::resource('profile_followers', ProfileFollowerController::class);
});
Route::middleware('auth:api')->group(function () {
    Route::resource('profile_followings', ProfileFollowingController::class);
});
Route::middleware('auth:api')->group(function () {
    Route::resource('posts', PostController::class);
});
Route::middleware('auth:api')->group(function () {
    Route::resource('post_images', PostImageController::class);
});
Route::middleware('auth:api')->group(function () {
    Route::resource('post_likes', PostLikeController::class);
});
Route::middleware('auth:api')->group(function () {
    Route::resource('post_comments', PostCommentController::class);
});


/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/
