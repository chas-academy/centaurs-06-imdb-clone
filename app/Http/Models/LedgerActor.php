<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class LedgerActor extends Model
{
    protected $table = 'ledger_actors';

    public static function getMovieByActorId($actorIds)
    {
        $actsIn = [];

        foreach ($actorIds as $actorId) {
            $actormovie = DB::table('ledger_actors')->get()->where('actor_id', $actorId);
            $actsIn[] = $actormovie;
        }

        $actorInfo = [];
        
        foreach ($actsIn as $movieId) {
            $actorInfo[] = json_decode(json_encode($movieId), false);
        }

        $movieIds = [];
        
        foreach ($actorInfo as $movieId) {
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
