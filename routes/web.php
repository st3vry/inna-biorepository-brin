<?php

use App\Http\Controllers\AdminOrganismController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\BioprojectController;
use App\Http\Controllers\BiosampleController;
use App\Http\Controllers\CuratorBioprojectController;
use App\Http\Controllers\DashboardBioprojectController;
use App\Http\Controllers\DashboardBiosampleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Models\Bioproject;
use App\Models\Biosample;
use App\Models\Fundagency;
use App\Models\Organism;
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

// Route::get('/', function () {
//     return view('frontend.welcome');
// });

// Route::get('/', function () {
//     return view('frontend.home', [
//         'title' => 'Home',
//     ]);
// });

// Route::get('/bioproject', function () {
//     return view('frontend.bioproject', [
//         'title' => 'Bioproject',
//     ]);
// });
Route::get('/', [HomeController::class, 'index'])->name('home');
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

Route::get('/dashboard/bioprojects/fetchfundingagency', [DashboardBioprojectController::class, 'fetchfundingagency'])->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware('auth');

Route::get('/bioprojects', [BioprojectController::class, 'index']);
Route::get('/bioprojects/{bioproject}', [BioprojectController::class, 'show']);
Route::get('/biosamples', [BiosampleController::class, 'index']);
Route::get('/biosamples/{biosample}', [BiosampleController::class, 'show']);


Route::resource('/dashboard/bioprojects', DashboardBioprojectController::class)->middleware('auth');
Route::resource('/dashboard/biosamples', DashboardBiosampleController::class)->middleware('auth');
Route::resource('/dashboard/organisms', AdminOrganismController::class)->except('show')->middleware('can:isAdmin');
Route::resource('/dashboard/roles', AdminRoleController::class)->except('show')->middleware('can:isAdmin');
Route::resource('/dashboard/users', AdminUserController::class)->except('show')->middleware('can:isAdmin');

// Curator
Route::get('/dashboard/curator/bioprojects', [CuratorBioprojectController::class, 'index'])->middleware(['can:isCurator']);
Route::get('/dashboard/curator/bioprojects/{bioproject}', [CuratorBioprojectController::class, 'edit'])->middleware(['can:isCurator']);

Route::fallback(function () {
    // return "Hm, why did you land here somehow?";
    return view('error.404');
});
