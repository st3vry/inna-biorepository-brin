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

Route::get('/submission', function () {
    return view('submission', [
        'title' => 'Submission',
    ]);
});


Route::get('/profile', function () {
    return view('profile', [
        'title' => 'Profile',
        'name' => 'Sahid Bismantoko',
        'email' => 'sahid.bismantoko@gmail.com'
    ]);
});
