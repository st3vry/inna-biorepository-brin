<?php

use App\Http\Controllers\ActionLogController;
use App\Http\Controllers\AdminOrganismController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\BioprojectController;
use App\Http\Controllers\BiosampleController;
use App\Http\Controllers\BioarchiveController;
use App\Http\Controllers\CuratorBioprojectController;
use App\Http\Controllers\CuratorBioSampleController;
use App\Http\Controllers\CuratorBioArchiveController;
use App\Http\Controllers\Dashboard\Innalysis\InnalysisController;
use App\Http\Controllers\DashboardBioprojectController;
use App\Http\Controllers\DashboardBiosampleController;
use App\Http\Controllers\DashboardBioarchiveController;
use App\Http\Controllers\DashboardIndexController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InnalysisGalaxyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginSsoController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UploaderController;
use App\Http\Controllers\SSHController;
use App\Http\Controllers\BioticRelationController;
use App\Http\Controllers\CaptureController;
use App\Http\Controllers\CelularityController;
use App\Http\Controllers\CenterController;
use App\Models\Bioproject;
use App\Models\Biosample;
use App\Models\BioticRelationship;
use App\Models\Fundagency;
use App\Models\Organism;
use App\Services\SsoService;
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

// Route::get('/biosamples', function () {
//     return view('frontend.biosample', [
//         'title' => 'BioSample',
//     ]);
// });

// Route::get('/bioarchives', function () {
//     return view('frontend.bioarchive', [
//         'title' => 'BioArchive'
//     ]);
// });
//SSO Routes
// Route::get('/loginsso', [LoginSsoController::class, 'index'])->name('loginsso')->middleware('guest');
// Route::post('/loginsso', [LoginSsoController::class, 'authenticate']);
Route::get('/login/sso', [LoginSsoController::class, 'sso'])->name('loginsso');
Route::post('/logout/sso', [SsoService::class, 'logout'])->name('logoutsso');



// Account Routes
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::post('/search', SearchController::class)->name('search');


Route::get('/bioprojects', [BioprojectController::class, 'index']);
Route::get('/bioprojects/{bioproject}', [BioprojectController::class, 'show']);
Route::get('/biosamples', [BiosampleController::class, 'index']);
Route::get('/biosamples/{biosample}', [BiosampleController::class, 'show']);
Route::get('/bioarchives', [BioarchiveController::class, 'index']);
Route::get('/bioarchives/{bioarchive}', [BioarchiveController::class, 'show']);

//rsemua route didalam dashboard disimpan disini tanpa prefix "dashboard"
Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardIndexController::class, 'index'])->middleware('authsso');

    Route::get('/profile', [ProfileController::class, 'index'])->name('users.profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('users.profile.update');
    Route::post('/password', [ProfileController::class, 'password'])->name('users.password.update');
    Route::post('/markasread', [ActionLogController::class, 'markAsRead'])->name('notif.mark.as.read');

    Route::get('/bioprojects/fetchfundingagency', [DashboardBioprojectController::class, 'fetchfundingagency'])->middleware('authsso');

    Route::resource('/bioprojects', DashboardBioprojectController::class)->middleware('authsso');
    Route::resource('/biosamples', DashboardBiosampleController::class)->middleware('authsso');
    Route::resource('/bioarchives', DashboardBioarchiveController::class)->middleware('authsso');

    // INNAlysis
    Route::get('/galaxy_workflows', [InnalysisGalaxyController::class, 'index'])->middleware('authsso');
    Route::get('/innalysis_galaxy/create', [InnalysisController::class, 'create'])->middleware('authsso');
    Route::get('/innalysis_galaxy', [InnalysisController::class, 'index'])->middleware('authsso');
    Route::post('/send-workflow', [InnalysisController::class, 'send'])->middleware('authsso')->name('send.workflow');

    // Admin
    Route::resource('/organisms', AdminOrganismController::class)->except('show')->middleware('can:isAdmin');
    Route::resource('/roles', AdminRoleController::class)->except('show')->middleware('can:isAdmin');
    Route::resource('/users', AdminUserController::class)->except('show')->middleware('can:isAdmin');
    Route::resource('/bioticrels', BioticRelationController::class)->except('show')->middleware('can:isAdmin');
    Route::resource('/captures', CaptureController::class)->except('show')->middleware('can:isAdmin');
    Route::resource('/celularities', CelularityController::class)->except('show')->middleware('can:isAdmin');
    Route::resource('/centers', CenterController::class)->except('show')->middleware('can:isAdmin');
    // Route::post('/users', [AdminUserController::class, 'filter'])->name('users.filter')->middleware('can:isAdmin');
    // Route::get('/curation/bioprojects', [DashboardBioprojectController::class, 'curation'])->middleware('can:isAdmin');
    // Route::get('/curation/biosamples', [DashboardBiosampleController::class, 'curation'])->middleware('can:isAdmin');

    // Curator
    // Route::get('/curator/bioprojects', [CuratorBioprojectController::class, 'index'])->middleware(['can:isCurator',]);
    // Route::get('/curator/bioprojects/{bioproject}', [CuratorBioprojectController::class, 'edit'])->middleware(['can:isCurator']);

    Route::resource('/curator/biosamples', CuratorBioSampleController::class)->middleware(['is_admin']);
    Route::resource('/curator/bioprojects', CuratorBioprojectController::class)->middleware(['is_admin']);
    Route::resource('/curator/bioarchives', CuratorBioArchiveController::class)->middleware(['is_admin']);

    // Route::get('/curator/biosamples/{biosample}', [CuratorBioSampleController::class, 'edit'])->middleware(['is_admin']);


    Route::post('/curator/biorun', [CuratorBioArchiveController::class, 'updateBiorun'])->name('updateBiorun')->middleware(['authsso']);

    Route::post('file/upload', [UploaderController::class, 'upload'])->name('file-upload')->middleware('authsso');
    Route::post('file/delete', [UploaderController::class, 'delete'])->name('file-delete')->middleware('authsso');
    Route::post('file/download', [UploaderController::class, 'download'])->name('file-download')->middleware('authsso');
    Route::post('ssh', [SSHController::class, 'tesSSH'])->name('tesSSH');
});

Route::fallback(function () {
    // return "Hm, why did you land here somehow?";
    return view('error.404');
});
