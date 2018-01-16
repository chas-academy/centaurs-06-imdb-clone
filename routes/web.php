<?php
use App\Http\Models\Movie;
use App\Http\Models\Review;
use App\Http\Models\Genre;
use App\User;
use App\Http\Controllers\UserController;

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

// Home Also called index view

Route::get('/', function () 
{
    $movieModel = new Movie();
    $genreModel = new Genre();
    $movies = $movieModel->getAllMovies();
    $genres = $genreModel->getAllGenres();

    $view = View::make('pages.index')->with('movies', $movies)->with('genres', $genres);

    if(Auth::check()) {
        $userController = new UserController;
        $user = $userController->profile();

        $view = View::make('pages.index')->with('movies', $movies)->with('genres', $genres)->with('user', $user);
    } else {
        $view = View::make('pages.index')->with('movies', $movies)->with('genres', $genres);
    };

    return $view;
});

Route::get('/login', function () {
    return view('pages.login');
});

Route::get('/watchlist', function () 
{
    $user = Auth::user()->id;
    $movieModel = new Movie();
    $genreModel = new Genre();
    $movies = $movieModel->getAllMoviesFromWatchlist($user);
    $genres = $genreModel->getAllGenres();

    $view = View::make('pages.watchlist')->with('movies', $movies)->with('genres', $genres);
    return $view;
});

Route::get('/watchlist/delete/{movieId}', 'MovieController@removeMovieFromWatchlist');

Route::get('/movie/{movieId}/addwatchlist', 'MovieController@addMovieToWatchlist');

Route::get('movie/{movieId}', function ($movieId)
{

    $movieModel = new Movie();
    $reviewModel = new Review();
    $userModel = new User();
    $movie = $movieModel->getMovieById($movieId);
    $actors = $movieModel->getMovieActors($movieId);
    $directors = $movieModel->getMovieDirectors($movieId);
    $producers = $movieModel->getMovieProducers($movieId);
    $writers = $movieModel->getMovieWriters($movieId);
    $genres = $movieModel->getMovieGenres($movieId);
    $reviews = $reviewModel->getAllReviews($movieId);

    $movieDetails = array(
        'movie' => $movie,
        'actors' => $actors,
        'directors' => $directors,
        'producers' => $producers,
        'writers' => $writers,
        'genres' => $genres,
        'reviews' => $reviews
    );

    $view = View::make('pages.movie')->with($movieDetails);
    return $view;
});


// Review
Route::post('movie/{movieId}/addreview', 'ReviewController@addReview');
Route::get('delete/review/{reviewId}', 'ReviewController@removeReview');

// User Watchlist View

Route::get('profile', 'UserController@profile');
Route::post('profile', 'UserController@updateAvatar');


Route::get('/apimovie/add/{movieApiId}', 'MovieController@searchMovieFromApiById');
Route::get('/movietest', 'MovieController@createMovieFromApi');
Route::get('/creategenres', 'MovieController@getMovieGenres');
Route::get('/tvshowtest', 'TvShowController@createTvShowFromApi');

Route::get('/search', 'Api\SearchController@search');

Auth::routes();

Route::get('/home', function () {
    return view('pages.index');
});

// For Genre Sorting
Route::post('/sortbygenre/updatemovies', 'sortByController@sortByGenre');

// For Special Sorting
Route::post('/sortbyspec/update', 'sortByController@sortBySpec');

Route::get('/createmovie', 'MovieController@createMovie');
Route::post('/createmovie', 'MovieController@storeMovie');

Route::post('/sortbygenre/updatemovies', 'sortByController@sortByGenre');

Route::get('/delete-account/{userId}', 'UserController@deleteAccount');

Route::post('/email-update/{userId}', 'UserController@updateEmail');

Route::post('/password-update/{userId}', 'UserController@updatePassword');
Route::get('/updatemovie', 'MovieController@updateMovie');
Route::post('/updatemovie', 'MovieController@storeMovie');


Route::get('/movies/{id}/edit', 'MovieController@editMovie');

Route::post('/movies/{id}/edit', 'MovieController@storeMovie');

Route::post('/movies/{id}/edit', 'MovieController@storeEditedMovie');


Route::get('/search-api', 'Moviecontroller@searchMovieFromApi');
