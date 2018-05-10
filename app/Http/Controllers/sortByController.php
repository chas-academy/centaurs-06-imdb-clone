<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Movie;

class sortByController extends Controller
{
    public function sortByGenre(Request $request)
    {
        $data = $request->all();
        $genre = implode("", $data);
        $movieModel = new Movie();
        $sortedMovies = $movieModel->getMoviesByGenre($genre);
        return $sortedMovies;
    }

    public function sortBySpec(Request $request)
    {
        $data = $request->all();
        $option = implode("", $data);
        $movieModel = new Movie();
        $sortedMovies = $movieModel->getMoviesBySpecSorting($option);
        print_r($option);
    }
}
