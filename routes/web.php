<?php

use App\Http\Controllers\ActionLogController;
use App\Http\Controllers\AdministrativeController;
use App\Http\Controllers\AdminOrganismController;
use App\Http\Controllers\AdminRoleController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AffiliateController;
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
use App\Http\Controllers\ConsortiaController;
use App\Http\Controllers\DiseaseController;
use App\Http\Controllers\DataverseController;
use App\Http\Controllers\Dashboard\User\BiosampleController as UserSampleController;
use App\Http\Controllers\DownloadRequestController;
use App\Http\Controllers\PermissionRequestController;
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
| https://chatgpt.com/c/671070b1-3a24-8001-b8cc-31c173af64f4
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
Route::get('getStorageFileSizes', [SSHController::class, 'getStorageFileSizes'])->name('getStorageFileSizes');
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


Route::get('createFtpUser2', [SSHController::class, 'createFtpUser2'])->name('createFtpUser2');

// Account Routes
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
// Route::post('/logout', [LoginController::class, 'logout']);
Route::post('/logout', [SsoService::class, 'logout'])->name('logoutsso');
// Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
// Route::post('/register', [RegisterController::class, 'store']);

Route::post('/search', SearchController::class)->name('search');


Route::get('/bioprojects', [BioprojectController::class, 'index']);
Route::get('/bioprojects/{bioproject}', [BioprojectController::class, 'show']);
Route::get('/biosamples', [BiosampleController::class, 'index']);
Route::get('/biosamples/{biosample}', [BiosampleController::class, 'show']);
Route::get('/bioarchives', [BioarchiveController::class, 'index']);
Route::get('/bioarchives/{bioarchive}', [BioarchiveController::class, 'show']);

Route::post('/button-action', [DownloadRequestController::class, 'handleButtonClick'])->name('button.action');
// Route for handling the download button click and redirecting to the form
Route::get('/permission-request/{bioarchive_id?}', [PermissionRequestController::class, 'showForm'])->name('permission.request.form');
// // Route to handle the submission of the permission form
Route::post('/permission-request', [PermissionRequestController::class, 'store'])->name('permission.request');

//rsemua route didalam dashboard disimpan disini tanpa prefix "dashboard"
Route::prefix('dashboard')->group(function () {
    Route::get('/', [DashboardIndexController::class, 'index'])->middleware('authsso');

    Route::get('/profile', [ProfileController::class, 'index'])->name('users.profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('users.profile.update');
    Route::post('/password', [ProfileController::class, 'password'])->name('users.password.update');
    Route::post('/markasread', [ActionLogController::class, 'markAsRead'])->name('notif.mark.as.read');

    Route::get('/bioprojects/fetchfundingagency', [DashboardBioprojectController::class, 'fetchfundingagency'])->middleware('authsso');

    Route::resource('/bioprojects', DashboardBioprojectController::class)->middleware(['authsso', 'is_labcenterexist']);
    Route::resource('/biosamples', UserSampleController::class)->middleware(['is_labcenterexist', 'authsso']);
    // Route::resource('/biosamples', DashboardBiosampleController::class)->middleware('authsso');
    Route::resource('/bioarchives', DashboardBioarchiveController::class)->middleware(['is_labcenterexist', 'authsso']);

    // INNAlysis
    Route::get('/galaxy_workflows', [InnalysisGalaxyController::class, 'index'])->middleware('authsso');
    Route::get('/innalysis_galaxy/create', [InnalysisController::class, 'create'])->middleware('authsso');
    Route::get('/innalysis_galaxy', [InnalysisController::class, 'index'])->middleware('authsso');
    Route::post('/send-workflow', [InnalysisController::class, 'send'])->middleware('authsso')->name('send.workflow');
    Route::get('/innalysis_galaxy/{innalysis_galaxy}', [InnalysisController::class, 'show'])->middleware('authsso');
    Route::get('/innalysis_galaxy/getArchive/{id}', [InnalysisController::class, "getArchive"])->middleware('authsso');
    Route::get('/innalysis_galaxy/getExperiment/{id}', [InnalysisController::class, "getExperiment"])->middleware('authsso');
    Route::get('/innalysis_galaxy/getExperiment2/{id}', [InnalysisController::class, "getExperiment2"])->middleware('authsso');
    Route::get('/innalysis_galaxy/getRun/{id}', [InnalysisController::class, "getRun"])->middleware('authsso');

    // Admin
    Route::resource('/organisms', AdminOrganismController::class)->except('show')->middleware('can:isAdmin');
    Route::resource('/roles', AdminRoleController::class)->except('show')->middleware('can:isAdmin');
    Route::resource('/users', AdminUserController::class)->except('show')->middleware('can:isAdmin');
    Route::resource('/bioticrels', BioticRelationController::class)->except('show')->middleware('can:isAdmin');
    Route::resource('/captures', CaptureController::class)->except('show')->middleware('can:isAdmin');
    Route::resource('/celularities', CelularityController::class)->except('show')->middleware('can:isAdmin');
    Route::resource('/centers', CenterController::class)->except('show')->middleware('can:isAdmin');
    Route::resource('/affiliates', AffiliateController::class)->except('show')->middleware('can:isAdmin');
    Route::resource('/administratives', AdministrativeController::class)->except('show')->middleware('can:isAdmin');
    Route::resource('/consortium', ConsortiaController::class)->except('show')->middleware('can:isAdmin');
    Route::resource('/diseases', DiseaseController::class)->except('show')->middleware('can:isAdmin');
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
    Route::post('/curator/fileCuration', [CuratorBioArchiveController::class, 'fileCuration'])->name('fileCuration')->middleware(['authsso']);

    Route::post('file/upload', [UploaderController::class, 'upload'])->name('file-upload')->middleware('authsso');
    Route::post('file/delete', [UploaderController::class, 'delete'])->name('file-delete')->middleware('authsso');
    Route::post('file/download', [UploaderController::class, 'download'])->name('file-download')->middleware('authsso');
    Route::get('ssh', [SSHController::class, 'tesSSH'])->name('tesSSH');
    Route::get('createFtpUser/{accession}', [SSHController::class, 'createFtpUser'])->name('createFtpUser');
    Route::post('createDataverse', [DataverseController::class, 'createDataverse'])->name('createDataverse');
    Route::post('createDatasetSample', [DataverseController::class, 'createDatasetSample'])->name('createDatasetSample');
    Route::post('createDatasetArchive', [DataverseController::class, 'createDatasetArchive'])->name('createDatasetArchive');
    Route::get('createDataFile/{type}/{accession}', [DataverseController::class, 'createDataFile'])->name('createDataFile');



    Route::prefix('v2')->group(function () {
        Route::resource('/biosamples', UserSampleController::class)->middleware('authsso');



        Route::get('/biosamples/getSample/{id}', [UserSampleController::class, "getSample"])->middleware('authsso');
        Route::get('/biosamples/getAttributes/{id}', [UserSampleController::class, "getAttributes"])->middleware('authsso');
        Route::get('/biosamples/getValueAttributes/{id}', [UserSampleController::class, "getValueAttributes"])->middleware('authsso');
        Route::get('/biosamples/getOrganism/{slug}', [UserSampleController::class, "getOrganism"])->middleware('authsso');
    });
});

Route::get('/undev', function () {
    return view('error.undev', ['title' => 'Under Development']);
});

Route::fallback(function () {
    // return "Hm, why did you land here somehow?";
    return view('error.404');
});
