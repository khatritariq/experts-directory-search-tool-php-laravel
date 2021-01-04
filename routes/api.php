<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/member', \App\Http\Controllers\Member\CreateController::class);
Route::post('/friendship', \App\Http\Controllers\Friendship\CreateController::class);
Route::get('/members', \App\Http\Controllers\Member\GetAllController::class);
Route::get('/member/{id}', \App\Http\Controllers\Member\GetController::class);
Route::get('/member/{id}/experts_for/{topic}', \App\Http\Controllers\Member\GetDetailsForExpertController::class);
