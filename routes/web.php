<?php


Route::get('/', function () {
    return view('pages.index');
});

Route::get('movie', function (){
    return view('pages.movie');
});

Route::get('/movietest', 'MovieController@createMovieFromApi');
Route::get('/creategenres', 'MovieController@getMovieGenres');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
