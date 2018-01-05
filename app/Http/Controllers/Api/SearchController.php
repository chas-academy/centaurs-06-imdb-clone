<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

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
        ];
        
        $error = ['error' => 'No results found, please try with different keywords.'];
    }
}
