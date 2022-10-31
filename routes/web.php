<?php

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
});

Route::get('/', function () {
    return view('home', [
        'title' => 'Home',
    ]);
});

Route::get('/bioproject', function () {
    return view('bioproject', [
        'title' => 'Bioproject',
    ]);
});

Route::get('/biosample', function () {
    return view('biosample', [
        'title' => 'BioSample',
    ]);
});


Route::get('/bioarchive', function () {
    return view('bioarchive', [
        'title' => 'BioArchive'
    ]);
});


Route::get('/login', function () {
    return view('login', [
        'title' => 'Login'
    ]);
});
