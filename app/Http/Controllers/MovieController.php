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

use Resources\views\pages;
use App\Http\Controllers\UserController;
use Auth;

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
            $keyword = "fifty shades of gray";
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
        private function storeMovieHelper($person, $model, $request) {
            $persons = $request[$person] ?? [];
            $persons = array_map(function ($id) use ($model) {
                return $model::find($id);
            }, $persons);

            $newPersons = $request[$person.'_new'] ?? [];
            $newPersons = array_map(function($name) use ($model) {
                $existingPerson = $model::where('name', $name)->first();

                if($existingPerson) {
                    return $existingPerson;
                }

                $person = new $model;
                $person->name = $name;
                $person->timestamps = false;
                $person->save();
                return $person;
            }, $newPersons);

            return $persons = array_merge($persons, $newPersons);
        }

        // Store movie
        public function storeMovie(Request $request)
        {
            $validatedData = $request->validate([
                'title' => 'required|unique:movies|max:255',
                'plot' => 'required'
            ]);

            //var_dump($request);
            //die();

            // for ($i=0; $i<count($request->actor); $i++) {

            // }
            $db_actors = Actor::all();
            //var_dump($db_actors->name);
            //die();

            $exisitingActors = array_map(function($actor) {
            
                return $actor;
                
            }, $db_actors->toArray());
            
            // Validate the request...
            $validatedData = $request->validate([
                'title' => 'required|unique:movies|max:255',
                'plot' => 'required',
                'playtimeHours' => 'required|digits_between:0,9',
                'playtimeMins' => 'required|digits_between:0,59',
                'releaseyear' => 'required',
            ]);

            //Lägga till validering, digits funkar ej
            //Lägga till autorizaton
            //kolla hur hämtas playtime
            $request->file('poster')->store('posters');

            $actors = $this->storeMovieHelper('actor', Actor::class, $request);
            $directors = $this->storeMovieHelper('director', Director::class, $request);
            $producers = $this->storeMovieHelper('producer', Producer::class, $request);

            $movie = new Movie;
            $movie->title = $request->title;
            $movie->plot = $request->plot;
            $movie->playtime = ($request->playtimeHours).($request->playtimeMins);
            $movie->poster = $request->file('poster')->hashName();;
            //$movie->backdrop = null;
            $movie->releasedate = ($request->releaseyear.'-01-01');
            //$movie->imdb_rating = 1;
            //$movie->chas_rating = 2;
            $movie->save();
            //     //$movie->created_at = $request->created_at;
            //     //$movie->updated_at = $request->updated_at;
            
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
}
