<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

use DB;

class Genre extends Model
{
    public function getAllGenres()
    { 
        $genres = DB::table('genres')->get();
        return $genres;
    }

    public function sortByGenre($selectedGenres)
    {

        
        var_dump($genres);
        die;
    }
}
