<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Movie;
use App\Http\Models\Actor;
use App\Http\Models\LedgerActor;
use App\Http\Models\Producer;
use App\Http\Models\LedgerProducer;
use App\Http\Models\Director;
use App\Http\Models\LedgerDirector;
use App\Http\Models\Genre;
use App\Http\Models\LedgerGenre;
use App\Http\Models\LedgerWatchList;
use Illuminate\Support\Facades\Storage;
use Resources\views\pages;
use App\Http\Controllers\UserController;

use Auth;
use DB;

class MovieController extends Controller
{
    public function searchMovieFromApi(request $request)
    {
        $user = Auth::user();
        $api_key = 'api_key=6975fbab174d0a26501b5ba81f0e0b3c';
        $keyword = $request['q'];
        $argument = str_replace(' ', '%20', $keyword);
        $searchMethod = 'search/movie?';
        $query = $searchMethod . '&language=en-US&query=' . $argument . '&page=1&include_adult=false&' . $api_key;
        $result = $this->MovieApi($query);

        return view('pages.api-search')->with('hits', $result)->with('user', $user);
    }

    public function searchMovieFromApiById($movieApiId)
    {
        $user = Auth::user();
        $api_key = '?api_key=6975fbab174d0a26501b5ba81f0e0b3c';
        $searchMethod = 'movie/';
        $query = $searchMethod . $movieApiId . $api_key . '&page=1&include_adult=false';
        $result = $this->MovieApi($query);

        $movieModel = new Movie();
        if ($movieModel->ifMovieExists($result['title'])) {
            $error = 'Movie already exists centaurs-imdb';

            return redirect()->back()->with('hits', $result)->with('user', $user)->with('error', $error);
        } else {
            $this->createMovieFromApi($result);

            $message = 'Movie has been added to centaurs-imdb';

            return redirect()->back()
                    ->with('hits', $result)
                    ->with('user', $user)
                    ->with('message', $message);
        }
    }

    public function MovieApi($query)
    {
        $api_key = 'api_key=6975fbab174d0a26501b5ba81f0e0b3c';


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.themoviedb.org/3/" . $query,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{}",
            ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        $result = json_decode($response, true);

        return $result;
    }

    public function createMovieFromApi($result)
    {
        $movie = new Movie();
        $movie->createMovie($result);
        $this->getMovieStaff($result);
    }

    public function getMovieStaff($argument)
    {
        $api_key = 'api_key=6975fbab174d0a26501b5ba81f0e0b3c';
        $movieId = $argument['id'];
        $query = 'movie/' . $movieId . '/credits?' . $api_key;
        $movieStaff = $this->MovieApi($query);
        $movie = new Movie();
        $movie->createMovieStaff($movieStaff);
    }

    public function getMovieGenres()
    {
        $api_key = 'api_key=6975fbab174d0a26501b5ba81f0e0b3c';
        $searchMethod = 'genre/movie/list?';
        $search = '&language=en-US';
        $query = $searchMethod . $api_key . $search;
        $movieGenres = $this->MovieApi($query);
        $movie = new Movie();
        $movie->createMovieGenres($movieGenres);
    }

    public function getTvShowGenres()
    {
        $api_key = 'api_key=6975fbab174d0a26501b5ba81f0e0b3c';
        $searchMethod = 'genre/tv/list?';
        $search = '&language=en-US';
        $query = $searchMethod . $api_key . $search;
        $movieGenres = $this->MovieApi($query);
        $movie = new Movie();
        $movie->createMovieGenres($movieGenres);
    }

    public function sortByGenre($genre)
    {
        $movieModel = new Movie();
        $sortedMovies = $movieModel->getMoviesByGenre($genre);
        return $sortedMovies;
    }

    public function removeMovieFromWatchlist($movieId)
    {
        $userId = Auth::user()->id;

        $movieModel = new Movie();
        $movieModel->removeMovieFromWatchlist($userId, $movieId);

        if ($movieId) {
            $message = 'Movie has been removed from watchlist';

            return redirect('/watchlist')->with('message', $message);
        } else {
            $error = 'Movie could not be deleted from watchlist, please try again';

            return redirect('/watchlist')->with('error', 'Movie could not be deleted from watchlist. Please try again');
        }
    }

    public function addMovieToWatchlist($movieId)
    {
        $userId = Auth::user()->id;

        $movieModel = new Movie();
        $ledgerWatchlistModel = new LedgerWatchList();

        $movieExistsInWatchlist = $ledgerWatchlistModel->ifMovieExistsInWatchlist($movieId, $userId);


        if (!$movieExistsInWatchlist) {
            $movieModel->addMovieToWatchlist($userId, $movieId);
            $message = 'Movie has been added to watchlist';

            return redirect('movie/'. $movieId)->with('message', $message);
        } else {
            return redirect('movie/' . $movieId)->with('error', 'Movie already in watchlist');
        }
    }


    // Create movie
    public function createMovie()
    {
        $actors = Actor::all()->toArray();
        $directors = Director::all()->toArray();
        $producers = Producer::all()->toArray();
        $genres = Genre::all()->toArray();
        $releaseyears = range(date('Y'), 1910);

        return view('pages.createmovie', ['actors' => $actors, 'directors' => $directors,'producers' => $producers,'genres' => $genres, 'releaseyears' => $releaseyears]);
    }

    //Helperfunction for handling actors, directors, producers
    private function storeMovieHelper($choice, $model, $request)
    {
        $choices = $request[$choice] ?? [];
        $choices = array_map(function ($id) use ($model) {
            return $model::find($id);
        }, $choices);

        $newChoices = $request[$choice.'_new'] ?? [];
        $newChoices = array_map(function ($name) use ($model) {
            $existingChoice = $model::where('name', $name)->first();

            if ($existingChoice) {
                return $existingChoice;
            }

            $choice = new $model;
            $choice->name = $name;
            $choice->timestamps = false;
            $choice->save();
            return $choice;
        }, $newChoices);

        return $choices = array_merge($choices, $newChoices);
    }

    // Update movie
    public function editMovie(Request $request, $id)
    {
        $movie = Movie::find($id);

        $initialActors = Movie::find($id)->actors()->get();
        $initialDirectors = Movie::find($id)->directors()->get();
        $initialProducers = Movie::find($id)->producers()->get();
        $activeGenres = Movie::find($id)->genres()->get();

        $activeGenreIds = array_map(function ($model) {
            return $model["id"];
        }, $activeGenres->toArray());

        $actors = Actor::all()->toArray();
        $directors = Director::all()->toArray();
        $producers = Producer::all()->toArray();
        $genres = Genre::all()->toArray();
        $releaseyears = range(date('Y'), 1910);

        return view('pages.editmovie', [
                'movie' => $movie,
                'genres' => $genres,
                'releaseyears' => $releaseyears,
                'actors' => $actors,
                'directors' => $directors,
                'producers' => $producers,
                'activeGenreIds' => $activeGenreIds,
                'initialActors' => $initialActors,
                'initialProducers' => $initialProducers,
                'initialDirectors' => $initialDirectors
            ]);
    }

    // Store movie
    public function storeMovie(Request $request)
    {

            //Ev ta bort detta?
        $db_actors = Actor::all();

        $exisitingActors = array_map(function ($actor) {
            return $actor;
        }, $db_actors->toArray());

        $validatedData = $request->validate([
                'title' => 'required|unique:movies|max:255',
                'plot' => 'required',
                'playtimeMins' => 'required|digits_between:1,3',
                'releaseyear' => 'required',
            ]);
        //To do:
        //Add autorization

        $actors = $this->storeMovieHelper('actor', Actor::class, $request);
        $directors = $this->storeMovieHelper('director', Director::class, $request);
        $producers = $this->storeMovieHelper('producer', Producer::class, $request);

        $movie = new Movie;
        $movie->title = $request->title;
        $movie->plot = $request->plot;
        $movie->playtime = $request->playtimeMins;
        $movie->releasedate = ($request->releaseyear.'-01-01');

        $poster = $request->file('poster');
        if ($poster) {
            $poster->store('/public/posters');
            $movie->poster = $poster->hashName();
        }

        $movie->save();

        foreach ($actors as $actor) {
            $ledgerActor = new LedgerActor;
            $ledgerActor->actor_id = $actor->id;
            $ledgerActor->movie_id = $movie->id;
            $ledgerActor->timestamps = false;
            $ledgerActor->save();
        }

        foreach ($directors as $director) {
            $ledgerDirector = new LedgerDirector;
            $ledgerDirector->director_id = $director->id;
            $ledgerDirector->movie_id = $movie->id;
            $ledgerDirector->timestamps = false;
            $ledgerDirector->save();
        }

        foreach ($producers as $producer) {
            $ledgerProducer = new LedgerProducer;
            $ledgerProducer->producer_id = $producer->id;
            $ledgerProducer->movie_id = $movie->id;
            $ledgerProducer->timestamps = false;
            $ledgerProducer->save();
        }

        foreach ($request->genres as $genre) {
            $ledgerGenre = new LedgerGenre;
            $ledgerGenre->genre_id = $genre;
            $ledgerGenre->movie_id = $movie->id;
            $ledgerGenre->timestamps = false;
            $ledgerGenre->save();
        }

        $request->session()->flash('message', 'The movie has been saved');

        return $this->createMovie();
    }

    public function storeEditedMovie(Request $request, $id)
    {
        $validatedData = $request->validate([
                'title' => 'required|max:255',
                'plot' => 'required',
                'playtimeMins' => 'required|digits_between:1,3',
                'releaseyear' => 'required',
            ]);


        //To do:
        //Add autorization

        $actors = $this->storeMovieHelper('actor', Actor::class, $request);
        $directors = $this->storeMovieHelper('director', Director::class, $request);
        $producers = $this->storeMovieHelper('producer', Producer::class, $request);

        $movie = Movie::find($id);
        $movie->title = $request->title;
        $movie->plot = $request->plot;
        $movie->playtime = $request->playtimeMins;
        $movie->releasedate = ($request->releaseyear.'-01-01');

        $poster = $request->file('poster');
        if ($poster) {
            $oldPoster = $movie->poster;

            if ($oldPoster) {
                Storage::delete('/public/posters/'.$oldPoster);
            }

            $poster->store('/public/posters');
            $movie->poster = $poster->hashName();
        }

        $movie->genres()->detach();
        foreach ($request->genres as $genre) {
            $movie->genres()->attach($genre);
        }

        $movie->actors()->detach();
        foreach ($actors as $actor) {
            $movie->actors()->attach($actor->id);
        }

        $movie->directors()->detach();
        foreach ($directors as $director) {
            $movie->directors()->attach($director->id);
        }

        $movie->producers()->detach();
        foreach ($producers as $producer) {
            $movie->producers()->attach($producer->id);
        }

        $movie->save();

        $request->session()->flash('message', 'The movie has been updated');

        return $this->editMovie($request, $id);
    }

    public function deleteMovie($movieId)
    {
        $movieModel = new Movie();
        $movieDeleted = $movieModel->deleteMovie($movieId);
        if ($movieDeleted == true) {
            $message = 'Movie has been deleted';

            return redirect('/')->with('message', $message);
            ;
        } else {

                //Movie with that id did not exists in db.

            return redirect('movie/'. $movieId)->with('error', 'Movie has not been deleted');
        }
    }
}
