<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Movie;
use App\User;
use App\Actor;
use App\Director;
use App\Episode; 
use App\Http\Models\Genre; 
use App\Producer; 

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request['q'];
        $client = new \AlgoliaSearch\Client($_ENV['ALGOLIA_APP_ID'], $_ENV['ALGOLIA_SECRET']);

        $queries = [
            ['indexName' => 'movie.title', 'query' => $query],
            ['indexName' => 'tvshow.title', 'query' => $query],
            ['indexName' => 'actor.name', 'query' => $query],
            ['indexName' => 'director.name', 'query' => $query],
            ['indexName' => 'producer.name', 'query' => $query],
            ['indexName' => 'genre.name', 'query' => $query]
        ];
        
        $results = $client->multipleQueries($queries, 'indexName');
        
        $results = array_first($results);
        $movies = [];

        foreach ($results as $result) {
            if(!empty($result['hits'])) {
                $result = json_decode (json_encode ($result['hits']), FALSE);
                array_push($movies, $result);
            }
        }
        
        $movies = array_first($movies);
        
        if (empty($movies)) {
            $movies = Movie::getAllMovies();
            $message = ['error' => 'No results found, please try with different keywords.'];
            return view('pages.index')->with('message', $message)->with('movies', $movies);
        }

        return view('pages.index')->with('movies', $movies);
    }
}
