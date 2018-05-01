<?php
use App\Http\Models\Movie;
use App\Http\Models\Review;
use App\Http\Models\TvShow;
use App\Http\Models\Genre;
use App\Http\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TvShowController;

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

Auth::routes();

Route::get('/', function () {
    $movies = Movie::all();
    $movies = ['movie' => $movies];
    $genres = Genre::all();

    if (Auth::check()) {
        $user = Auth::user();
        $view = View::make('pages.index')
                    ->with('movies', $movies)
                    ->with('genres', $genres)
                    ->with('user', $user);
    } else {
        $view = View::make('pages.index')
                    ->with('movies', $movies)
                    ->with('genres', $genres);
    };

    return $view;
})->name('index');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::get('/watchlist', function () {
    $user = Auth::user()->id;
    $movieModel = new Movie();
    $genreModel = new Genre();
    $movies = $movieModel->getAllMoviesFromWatchlist($user);
    $tvshows = $movieModel->getAllTvShowsFromWatchlist($user);
    $genres = $genreModel->getAllGenres();

    $view = View::make('pages.watchlist')->with('movies', $movies)->with('genres', $genres)->with('tvshows', $tvshows);
    return $view;
});

Route::get('/watchlist/delete/movie/{movieId}', 'MovieController@removeMovieFromWatchlist');
Route::get('/movie/{movieId}/addwatchlist', 'MovieController@addMovieToWatchlist');

Route::get('/tv-show/{tvshowId}/addwatchlist', 'TvShowController@addTvshowToWatchlist');
Route::get('/watchlist/delete/tvshow/{tvshowId}', 'TvShowController@removeTvshowFromWatchlist');

Route::get('movie/{movieId}', function ($movieId) {
    $movie = Movie::find($movieId);

    if (empty($movie)) {
        $view = View::make('pages.movie')->with([]);
    } else {
        $actors = $movie->with('actors')->get();
        $directors = $movie->with('directors')->get();
        $producers = $movie->with('producers')->get();
        $writers = $movie->with('writers')->get();
        $genres = $movie->with('genres')->get();
        $reviews = Review::with('author')->where('movie_id', $movieId)->get();

        $movieDetails = array(
            'movie' => $movie,
            'actors' => $movie->actors,
            'directors' => $movie->directors,
            'producers' => $movie->producers,
            'writers' => $movie->writers,
            'genres' => $movie->genres,
            'reviews' => $movie->reviews
        );

        $view = View::make('pages.movie')->with($movieDetails);
    }

    return $view;
});

// Delete movie from database
Route::get('movie/{movieId}/delete', 'MovieController@deleteMovie');

// Review
Route::post('movie/{movieId}/addreview', 'ReviewController@addReview');
Route::get('delete/review/movie/{reviewId}', 'ReviewController@removeReview');
Route::post('tv-show/{tvshowId}/addreview', 'ReviewController@addTvReview');
Route::get('delete/review/tv-show/{reviewId}', 'ReviewController@removeReview');
Route::get('approve/review/{reviewId}', 'ReviewController@approveReview');

// User Watchlist View
Route::post('profile', 'UserController@updateAvatar');

// Only used for generating genres for movies and tvshows (These should be seeders)
Route::get('/creategenres', 'MovieController@getMovieGenres');
Route::get('/createtvgenres', 'MovieController@getTvShowGenres');

Route::get('/apimovie/add/{movieApiId}', 'MovieController@searchMovieFromApiById');
Route::get('/apitvshow/add/{tvshowApiId}', 'TvShowController@searchTvshowFromApiById');
Route::get('/movietest', 'MovieController@createMovieFromApi');
Route::get('/tvshowtest', 'TvShowController@createTvShowFromApi');

Route::get('/search', 'Api\SearchController@search');

// For Genre Sorting
Route::post('/sortbygenre/updatemovies', 'sortByController@sortByGenre');

// For Special Sorting
Route::post('/sortbyspec/update', 'sortByController@sortBySpec');

// Admin routes
Route::middleware(['admin'])->group(function () {
    Route::get('/createmovie', 'MovieController@createMovie');
    Route::post('/createmovie', 'MovieController@storeMovie');
    Route::get('/movies/{id}/edit', 'MovieController@editMovie');
    Route::post('/movies/{id}/edit', 'MovieController@storeEditedMovie');
});

Route::get('/delete-account/{userId}', 'UserController@deleteAccount');
Route::post('/email-update/{userId}', 'UserController@updateEmail');
Route::post('/password-update/{userId}', 'UserController@updatePassword');

Route::get('/search-api', 'MovieController@searchMovieFromApi');
Route::get('/search-tv-api', 'TvShowController@searchTvshowFromApi');
Route::get('/tv-shows', 'TvShowController@readTvShows');
Route::get('/tv-show/{tvshowId}', 'TvShowController@list');
Route::get('/tv-show/{tvshowId}/season/{seasonId}', 'TvShowController@seasonlist');

// Don't know if the path is right but this prints out the reviews that are on hold.
Route::get('/admin/managereviews', 'ReviewController@getReviewsOnHold')->name('managereviews');

// Delete TvShow from database
Route::get('tv-show/{tvShowId}/delete', 'TvShowController@deleteTvShow');
