<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Movie;
use App\Http\Models\Actor;
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

            return view('pages.test', ['actors' => $actors]);
            // // Validate the request...
            // if ($request->isMethod('post') && validateRequest($request)) {
            //     $movie = new Movie;
                
            //     //$movie->movie_api_id = $request->movie_api_id;
            //     $movie->title = $request->title;
            //     $movie->plot = $request->plot;
            //     //$movie->playtime = $request->playtime;
            //     //$movie->poster = $request->poster;
            //     //$movie->backdrop = $request->backdrop;
            //     //$movie->releasedate = $request->releasedate;
            //     //$movie->imdb_rating = $request->imdb_rating;
            //     //$movie->chas_rating = $request->chas_rating;
            //     //$movie->created_at = $request->created_at;
            //     //$movie->updated_at = $request->updated_at;

            //     $movie->save();

            //     return view('/test', [
            //         "created" => true,
            //     ]);
            // } 

            // return view('/test', [
            //     "request" => $request,
            // ]);
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
           
            

            $newActors = array_map(function($name) {
                $actor = new Actor;
                $actor->name = $name;
                $actor->timestamps = false;
                $actor->save();
                return $actor;
            }, $request->new_actor);
            //var_dump($newActors);



            //var_dump($validatedData);

            // if ($request->isMethod('post') &&
            $movie = new Movie;
            $movie->title = $request->title;
            $movie->plot = 'test';
            $movie->playtime = 123;
            $movie->poster = 'test';
            $movie->backdrop = '';
            $movie->releasedate = now();
            $movie->imdb_rating = 1;
            $movie->chas_rating = 2;
            $movie->save();
        }
}
