<?php
use App\Http\Models\Movie;
use App\Http\Models\Genre;

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
    $genreModel = new Genre();
    $movies = $movieModel->getAllMovies();
    $genres = $genreModel->getAllGenres();
    
    $view = View::make('pages.index')->with('movies', $movies)->with('genres', $genres);
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
    $writers = $movieModel->getMovieWriters($movieId);
    $genres = $movieModel->getMovieGenres($movieId);

    $movieDetails = array(
        'movie' => $movie,
        'actors' => $actors,
        'directors' => $directors,
        'producers' => $producers,
        'writers' => $writers,
        'genres' => $genres
    );
    // var_dump($movieDetails);
    // die;

    $view = View::make('pages.movie')->with($movieDetails);
    return $view;
});

Route::get('profile', 'UserController@profile');
Route::post('profile', 'UserController@updateAvatar');

Route::get('/movietest', 'MovieController@createMovieFromApi');
Route::get('/creategenres', 'MovieController@getMovieGenres');
Route::get('/tvshowtest', 'TvShowController@createTvShowFromApi');

Auth::routes();

Route::get('/home', function () {
    return view('pages.index');
});

// Route::get('/genres/{genres}', function($genres) {
//     dd($genres);

     // $genreModel = new Genre();
     // $movies = $genreModel->sortByGenre($genres);

//     return 200;
// });