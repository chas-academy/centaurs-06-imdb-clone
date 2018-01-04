<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search($searchKey)
    {
        $movies = movies::search($searchKey)->get(); return $movies;
        return view('search', compact('getstarted_actors')); 
        
        $error = ['error' => 'No results found, please try with different keywords.'];
    }
}
