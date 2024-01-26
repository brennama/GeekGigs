<?php

use App\Http\Controllers\JobController;
use Illuminate\Http\Request;
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

const PATH_JOBS = '/jobs';
const PATH_JOBS_ID = '/jobs/{id}';

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::controller(JobController::class)->group(function () {
    Route::get(PATH_JOBS, 'index');
    Route::get(PATH_JOBS_ID, 'show');
    Route::post(PATH_JOBS, 'store');
    Route::put(PATH_JOBS_ID, 'update');
    Route::delete(PATH_JOBS_ID, 'destroy');
});
