<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Movie;
use App\Http\Models\User;
use App\Http\Models\Actor;
use App\Http\Models\Director;
use App\Http\Models\Episode; 
use App\Http\Models\Genre; 
use App\Http\Models\Producer;
use App\Http\Models\LedgerActor;
use App\Http\Models\LedgerDirector;
use App\Http\Models\LedgerProducer;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request['q'];
        if (isset($query)) {
            $client = new \AlgoliaSearch\Client($_ENV['ALGOLIA_APP_ID'], $_ENV['ALGOLIA_SECRET']);

            $queries = [
                ['indexName' => 'movie.title', 'query' => $query],
                ['indexName' => 'tvshow.title', 'query' => $query],
                ['indexName' => 'actor.name', 'query' => $query],
                ['indexName' => 'director.name', 'query' => $query],
                ['indexName' => 'producer.name', 'query' => $query]
            ];
            
            $searchResults = $client->multipleQueries($queries, 'indexName');
            $searchResults = array_first($searchResults);

            $results = array(
                "movie.title" => [],
                "tvshow.title" => [],
                "actor.name" => [],
                "director.name" => [],
                "producer.name" => [],
                "actor.movies" => [],
                "actor.tvshows" => [],
                "director.movies" => [],
                "director.tvshows" => [],
                "producer.movies" => [],
                "producer.tvshows" => [],   
            );
            
            // To get movie from actorname
            foreach ($searchResults as $result) {
                
                if (!empty($result['hits'])) {
                    $type = array_get($result, 'index');
                    $results[$type] = $result['hits'];
                    switch ($type) {
                        case 'movie.title':
                        $movies = ['movie.title' => $results['movie.title']];
                        $results['movie.title'] = ['titles' => $results['movie.title']];
                            break;

                        case 'actor.name':
                            $actorIds = array_pluck($result['hits'], 'id');
                            $actsInMovies = array_flatten(LedgerActor::getMovieByActorId($actorIds));
                            $results['actor.movies'] = ['actors' => $actsInMovies];
                            break;
                            
                            
                        case 'director.name':
                            $directorIds = array_pluck($result['hits'], 'id'); 
                            $directorInMovies = array_flatten(LedgerDirector::getMovieByDirectorId($directorIds)); 
                            $results['director.movies'] = ['directors' => $directorInMovies]; 
                            break;

                        case 'producer.name':
                            $producerIds = array_pluck($result['hits'], 'id'); 
                            $producerInMovies = array_flatten(LedgerProducer::getMovieByProducerId($producerIds)); 
                            $results['producer.movies'] = ['producers' => $producerInMovies]; 
                            break;
                        
                        default:
                            break;
                        
                    }
                }
            }
  
            
            $movies = array_get($results, 'movie.title');
            $tvshows = array_get($results, 'tvshow.title');
            $actorsInMovie = array_get($results, 'actor.movies');
            $direcorsInMovie = array_get($results, 'director.movies');
            $producersInMovie = array_get($results, 'producer.movies');
            $movies = array_merge($movies, $actorsInMovie, $direcorsInMovie, $producersInMovie);
            
            
            

            if (empty($movies)) {
                $movies = Movie::getAllMovies();
                $message = 'No results found, please try with different keywords.';
                return redirect('/')->with('message', $message)->with('movies', $movies);
            }

            return view('pages.index')->with('movies', $movies);
        } else {
            $movies = [];
            $error = "This won't work, you need to actually put in the words...";
            return redirect('/')->with('error', $error)->with('movies', $movies);
        }
    }
}
