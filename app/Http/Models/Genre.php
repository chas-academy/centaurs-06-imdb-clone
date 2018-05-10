<?php

namespace App\Http\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

use DB;

class Genre extends Model
{
    use Searchable;

    protected $table = 'genres';

    public function getAllGenres()
    {
        $genres = DB::table('genres')->get();
        return $genres;
    }

    public function searchableAs()
    {
        return 'genre.name';
    }

    public function movies()
    {
        return $this->belongsToMany('App\Http\Models\Movie');
    }
}
