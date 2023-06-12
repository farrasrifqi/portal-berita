<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//login
Route::post('login', [App\Http\Controllers\API\AuthController::class, 'login']);
//logout
Route::post('logout', [App\Http\Controllers\API\AuthController::class, 'logout'])->middleware('auth:sanctum');
//register
Route::post('register', [App\Http\Controllers\API\AuthController::class, 'register']);
//update password
Route::post('update-password', [App\Http\Controllers\API\AuthController::class, 'updatePassword'])->middleware('auth:sanctum');

//get all user
Route::get('getalluser', [App\Http\Controllers\API\UserController::class, 'getalluser']);
Route::get('getuserbyid/{id}', [App\Http\Controllers\API\UserController::class, 'getuserbyid']);

//category
Route::get('category', [App\Http\Controllers\API\CategoryController::class, 'index']);
Route::post('category', [App\Http\Controllers\API\CategoryController::class, 'create'])->middleware('auth:sanctum');
Route::delete('category/{id}',[\App\Http\Controllers\API\CategoryController::class, 'destroy'])->middleware('auth:sanctum');
Route::get('category/{id}', [App\Http\Controllers\API\CategoryController::class, 'show']);

//slider
Route::get('slider', [App\Http\Controllers\API\SliderController::class, 'index']);
Route::post('slider', [App\Http\Controllers\API\SliderController::class, 'create'])->middleware('auth:sanctum');
Route::delete('slider/{id}',[\App\Http\Controllers\API\SliderController::class, 'destroy'])->middleware('auth:sanctum');

//news
Route::get('news', [App\Http\Controllers\API\NewsController::class, 'index']);
Route::get('news/{id}', [\App\Http\Controllers\API\NewsController::class, 'show'])->middleware('auth:sanctum');