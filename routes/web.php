<?php

use App\Http\Controllers\Web\ForgotPasswordController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\JobListController;
use App\Http\Controllers\Web\JobPostController;
use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\LogoutController;
use App\Http\Controllers\Web\ProfileController;
use App\Http\Controllers\Web\RegisterController;
use App\Http\Controllers\Web\ResetPasswordController;
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

Route::get('/jobs', [JobListController::class, 'show']);

Route::controller(JobPostController::class)->group(function () {
    $uri = '/post-job';
    $param = '{job}';
    Route::get($uri, 'index');
    Route::get("$uri/$param", 'show');
    Route::post($uri, 'create');
    Route::put("$uri/$param", 'update');
    Route::delete("$uri/$param", 'delete');
});

Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('/forgot-password', 'show')
    ->middleware('guest')
    ->name('password.request');
    Route::post('/forgot-password', 'submit')
    ->middleware('guest')
    ->name('password.email');
});

Route::controller(ResetPasswordController::class)->group(function () {
    Route::get('/reset-password/{token}', 'show')
        ->middleware('guest')
        ->name('password.reset');
    Route::post('/reset-password', 'submit')
        ->middleware('guest')
        ->name('password.update');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'show')->name('login');
    Route::post('/login', 'submit');
});

Route::get('/logout', [LogoutController::class, 'redirect']);

Route::controller(ProfileController::class)->group(function () {
    Route::get('/profile', 'show');
    Route::post('/profile', 'update');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'show');
    Route::post('/register', 'submit');
});
