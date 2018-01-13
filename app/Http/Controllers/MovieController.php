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
use Illuminate\Support\Facades\Storage;

use Resources\views\pages;
use App\Http\Controllers\UserController;
use Auth;
use DB;

class MovieController extends Controller
{

    public function MovieApi($argument, $searchMethod) 
    {
        $api_key = 'api_key=6975fbab174d0a26501b5ba81f0e0b3c';
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.themoviedb.org/3/". $searchMethod . $api_key . $argument,
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
        
        public function createMovieFromApi() 
        {
            $keyword = "Power of Ten";
            $argument = str_replace(' ', '%20', $keyword);
            $searchMethod = 'search/movie?';
            $search = '&language=en-US&query=' . $argument . '&page=1&include_adult=false';
            
            $result = $this->MovieApi($search, $searchMethod);

            $movie = new Movie();
            $movie->createMovie($result);
            $this->getMovieStaff($result);
        }
        
        public function getMovieStaff($argument)
        {
            $movieId = $argument['results'][0]['id'];
            $searchMethod = 'movie/' . $movieId . '/credits?';
            $movieStaff = $this->MovieApi(null, $searchMethod);
            $movie = new Movie();
            $movie->createMovieStaff($movieStaff);    
        }

        public function getMovieGenres()
        {
            $searchMethod = 'genre/movie/list?';
            $search = '&language=en-US';
            $movieGenres = $this->MovieApi($search, $searchMethod);
            $movie = new Movie();
            $movie->createMovieGenres($movieGenres);
        }


        public function getAllMovies()
        {
            $movieModel = new Movie();
            $movies = $movieModel->getAllMovies();

            return $movies;  
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
        }

        public function addMovieToWatchlist($movieId)
        {
            $userId = Auth::user()->id;

            $movieModel = new Movie();
            $movieModel->addMovieToWatchlist($userId, $movieId);

            return redirect('movie/'. $movieId);
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

        //Helperfunktion för hantera alla actors, directors, producers
        private function storeMovieHelper($choice, $model, $request) {
            $choices = $request[$choice] ?? [];
            $choices = array_map(function ($id) use ($model) {
                return $model::find($id);
            }, $choices);

            $newChoices = $request[$choice.'_new'] ?? [];
            $newChoices = array_map(function($name) use ($model) {
                $existingChoice = $model::where('name', $name)->first();

                if($existingChoice) {
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
        public function editMovie(Request $request, $id) {

            $movie = Movie::find($id);
            echo $movie->title;

            $initialActors = Movie::find($id)->actors()->get();
            foreach ($initialActors as $actor) {

                echo $actor->name;
            }

            $initialDirectors = Movie::find($id)->directors()->get();
            foreach ($initialDirectors as $director) {

                echo $director->name;
            }

            $initialProducers = Movie::find($id)->producers()->get();
            foreach ($initialProducers as $producer) {

                echo $producer->name;
            }

            $activeGenre = Movie::find($id)->genres()->first();
                echo $activeGenre->genre_name;

            $actors = Actor::all()->toArray();
            $directors = Director::all()->toArray();
            $producers = Producer::all()->toArray();
            $genres = Genre::all()->toArray();
            $releaseyears = range(date('Y'), 1910);

            return view('pages.editmovie', ['movie' => $movie, 'genres' => $genres, 'releaseyears' => $releaseyears, 'actors' => $actors, 'directors' => $directors, 'producers' => $producers, 'activeGenre' => $activeGenre, 'initialActors' => $initialActors, 'initialProducers' => $initialProducers, 'initialDirectors' => $initialDirectors]);
        }

        // Store movie
        public function storeMovie(Request $request)
        {
            $db_actors = Actor::all();

            $exisitingActors = array_map(function($actor) {
            
                return $actor;
                
            }, $db_actors->toArray());
            
            // Validate the request...
            $validatedData = $request->validate([
                'title' => 'required|unique:movies|max:255',
                'plot' => 'required',
                'playtimeMins' => 'required|digits_between:1,600',
                'releaseyear' => 'required',
            ]);
            //To do:
            //Add validation, digits not working
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
                $poster->store('posters');
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

            return $this->createMovie();
        }

        public function storeEditedMovie (Request $request, $id) 
        {
            //Fixa med val data...
            $validatedData = $request->validate([
                'title' => 'required|max:255',
                'plot' => 'required',
                'playtimeMins' => 'required|digits_between:1,600',
                'releaseyear' => 'required',
            ]);

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

                if($oldPoster) {
                    Storage::delete('/posters/'.$oldPoster);
                }

                $poster->store('posters');
                $movie->poster = $poster->hashName();
            }

            $movie->genres()->detach();
            $movie->genres()->attach($request->genre);

            $movie->actors()->detach();
            foreach ($actors as $actor) 
            {
                $movie->actors()->attach($actor->id);
            }

            $movie->directors()->detach();
            foreach ($directors as $director) 
            {
                $movie->directors()->attach($director->id);
            }

            $movie->producers()->detach();
            foreach ($producers as $producer) 
            {
                $movie->producers()->attach($producer->id);
            }

            $movie->save();
        }
}
