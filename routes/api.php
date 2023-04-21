<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\ApplyController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'V1'], function () {
    Route::apiResource('posts', PostController::class);
    Route::get('posts/search/{title}', [PostController::class, 'search']);
});

Route::group(['prefix' => 'V1'], function () {
    Route::apiResource('applies', ApplyController::class);
   
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//show the apply by that have a pending status
Route::get('showPending', [ApplyController::class, 'showPending']);
//accept or reject the apply
Route::put('accepte/{id}', [ApplyController::class, 'accepte']);
Route::put('reject/{id}', [ApplyController::class, 'reject']);

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::get('showCompany', 'showCompany');
    //change role
    Route::put('accepted/{id}', 'accepted');
    Route::put('rejected/{id}', 'rejected');
    Route::get('logout', 'logout');
});
