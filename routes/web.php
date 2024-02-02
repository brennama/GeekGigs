<?php

use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\JobController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\LogoutController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\RegisterController;
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

Route::get('/', [HomeController::class, 'show']);
Route::get('/jobs', [JobController::class, 'show']);
Route::get('/logout', [LogoutController::class, 'redirect']);

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'show');
    Route::post('/login', 'submit');
});

Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'show');
    Route::post('/profile', 'update');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'show');
    Route::post('/register', 'submit');
});
