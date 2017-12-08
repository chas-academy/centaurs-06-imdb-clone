<?php

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
    return view('pages.index');
});

Route::get('/login', function () {
    return view('pages.login');
});

Route::get('/footer', function () {
    return view('pages.footer');
});
Route::get('/movietest', 'MovieController@SearchForMovie');
Route::get('/movietest', 'MovieController@SearchForMovie');

Route::get('/creategenres', 'MovieController@getMovieGenres');
