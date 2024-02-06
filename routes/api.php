<?php

use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

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

Route::controller(JobController::class)->group(function () {
    $uri = '/jobs';
    $param = '{job}';

    Route::get($uri, 'index');
    Route::get("$uri/$param", 'show');
    Route::post($uri, 'store');
    Route::put("$uri/$param", 'update');
    Route::delete("$uri/$param", 'destroy');
});

Route::controller(TagController::class)->group(function () {
    $uri = '/tags';
    $param = '{tag}';

    Route::get($uri, 'index');
    Route::get("$uri/$param", 'show');
    Route::post($uri, 'store');
    Route::put("$uri/$param", 'update');
    Route::delete("$uri/$param", 'destroy');
});

Route::controller(UserController::class)->group(function () {
    $uri = '/users';
    $param = '{user}';

    Route::get("$uri/$param", 'show');
    Route::post($uri, 'store');
    Route::put("$uri/$param", 'update');
    Route::delete("$uri/$param", 'destroy');
});

Route::controller(SearchController::class)->group(function () {
    Route::get('/search', 'show');
});
