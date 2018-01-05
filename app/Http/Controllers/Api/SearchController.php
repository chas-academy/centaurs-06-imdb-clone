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
    public function search($searchKey)
    {
    
        $client = new \AlgoliaSearch\Client($_ENV['ALGOLIA_APP_ID'], $_ENV['ALGOLIA_SECRET']);

        $error = ['error' => 'No results found, please try with different keywords.'];
        $query = $request['q'];

        $queries = [
            ['indexName' => 'movie.title', 'query' => $query],
            ['indexName' => 'tvshow.title', 'query' => $query],
            ['indexName' => 'actor.name', 'query' => $query],
            ['indexName' => 'director.name', 'query' => $query],
            ['indexName' => 'producer.name', 'query' => $query],
            ['indexName' => 'genre.name', 'query' => $query],
        ];
        
        $error = ['error' => 'No results found, please try with different keywords.'];
        $results = $client->multipleQueries($queries);
        $movies = array_first($results)[0]['hits'];
        $object = json_decode (json_encode ($movies), FALSE);
        
        
        return view('pages.index')->with('movies', $object);
    }
}
