<?php

use App\Http\Controllers\ClassementController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\ScoreController;
use App\Models\Classement;
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

Route::get('/', function () {
    return view('welcome');
})->name("dashboard");

Route::get("/clubs", [ClubController::class, "index"])->name("clubs.index");
Route::get("/clubs/create", [ClubController::class, "create"])->name("clubs.create");
Route::post("/clubs", [ClubController::class, "store"])->name("clubs.store");

Route::get("/scores", [ScoreController::class, "index"])->name("scores.index");
Route::get("/scores/create", [ScoreController::class, "create"])->name("scores.create");
Route::post("/scores", [ScoreController::class, "store"])->name("scores.store");

Route::get("/classements", [ClassementController::class, "index"])->name("classements.index");

