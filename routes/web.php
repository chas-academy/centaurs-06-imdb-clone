<?php
use App\Http\Models\Movie;
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

Route::get('/', function () 
{
    $movieModel = new Movie();
    $movies = $movieModel->getAllMovies();
    $view = View::make('pages.index')->with('movies', $movies);
    return $view;
});

Route::get('/login', function () {
    return view('pages.login');
});

Route::get('movie/{movieId}', function ($movieId)
{

    $movieModel = new Movie();
    $movie = $movieModel->getMovieById($movieId);
    $actors = $movieModel->getMovieActors($movieId);
    $directors = $movieModel->getMovieDirectors($movieId);
    $producers = $movieModel->getMovieProducers($movieId);

    // $movieDetails = [];

    // array_push($movieDetails, ['movie' => $movie, 'actors' => $actors]);
    $movieDetails = array(
        'movie' => $movie,
        'actors' => $actors,
        'directors' => $directors,
        'producers' => $producers
    );
    // var_dump($movieDetails);
    // die;

    $view = View::make('pages.movie')->with($movieDetails);
    return $view;
});
Route::get('/movietest', 'MovieController@createMovieFromApi');

Route::get('/creategenres', 'MovieController@getMovieGenres');
