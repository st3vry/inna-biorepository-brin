<?php

use App\Http\Controllers\AdminOrganismController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\BioprojectController;
use App\Http\Controllers\DashboardBioprojectController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Models\Bioproject;
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
    return view('frontend.welcome');
});

Route::get('/', function () {
    return view('frontend.home', [
        'title' => 'Home',
    ]);
});

// Route::get('/bioproject', function () {
//     return view('frontend.bioproject', [
//         'title' => 'Bioproject',
//     ]);
// });

// Route::get('/bioprojects', [BioprojectController::class, 'index'])->name('bioprojectindex');
// Route::get('/bioprojects/{$bioproject:alias}', [BioprojectController::class, 'show'])->name('bioprojectshow');

Route::get('/biosamples', function () {
    return view('frontend.biosample', [
        'title' => 'BioSample',
    ]);
});


Route::get('/bioarchives', function () {
    return view('frontend.bioarchive', [
        'title' => 'BioArchive'
    ]);
});


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth');


Route::resource('/dashboard/bioprojects', DashboardBioprojectController::class)->middleware('auth');
Route::resource('/bioprojects', BioprojectController::class);
Route::resource('/dashboard/organisms', AdminOrganismController::class)->except('show')->middleware('can:isAdmin');
Route::resource('/dashboard/roles', AdminRoleController::class)->except('show')->middleware('can:isAdmin');
