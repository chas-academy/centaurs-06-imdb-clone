<?php


Route::get('/', function () {
    return view('pages.index');
});

Route::get('movie', function (){
    return view('pages.movie');
});

Route::get('profile', 'UserController@profile');
Route::post('profile', 'UserController@updateAvatar');

Route::get('/movietest', 'MovieController@createMovieFromApi');
Route::get('/creategenres', 'MovieController@getMovieGenres');

Auth::routes();

Route::get('/home', function () {
    return view('pages.index');
});
