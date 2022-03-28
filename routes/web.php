<?php

use App\Http\Controllers\AttemptController;
use App\Http\Controllers\PlantController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth.basic')->group(function () {
    Route::get('/', function () {
        return Redirect::route('plant.index');
    });

    Route::resource('plant', PlantController::class);
    Route::resource('attempt', AttemptController::class);
});
