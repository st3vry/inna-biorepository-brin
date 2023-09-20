<?php

use App\Http\Controllers\InnalysisGalaxyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Whoops\Run;

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

// Route::apiResource('innalysisworkflows', InnalysisGalaxyController::class);
Route::post('/innalysisworkflows/run', [InnalysisGalaxyController::class, 'run']);
Route::get('/innalysisworkflows', [InnalysisGalaxyController::class, 'index']);
