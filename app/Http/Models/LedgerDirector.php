<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class LedgerDirector extends Model
{
    protected $table = 'ledger_directors';

    public static function getMovieByDirectorId($directorIds)
    {
        $actsIn = [];

        foreach ($directorIds as $directorId) {
            
            $directormovie = DB::table('ledger_directors')->get()->where('director_id', $directorId);
            $directsIn[] = $directormovie;
        }

        $directorInfo = [];
        
        foreach ($directsIn as $movieId) {
            $directorInfo[] = json_decode (json_encode ($movieId), FALSE);
        }

        $movieIds = [];
        
        foreach ($directorInfo as $movieId) {
            foreach ($movieId as $test) {
                $movieIds[] = $test->movie_id;  
            }
        }
        
        $movies = [];
        
        foreach ($movieIds as $movieId) {
            array_push($movies, DB::table('movies')->get()->where('id', $movieId));
        }

        return $movies;
    }
}