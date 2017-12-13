<?php

namespace App\Http\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

use DB;

class Genre extends Model
{
    public function getAllGenres()
    { 
        $genres = DB::table('genres')->get();
        return $genres;
    }
    use Searchable;
}
