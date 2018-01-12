<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class LedgerProducer extends Model
{
    protected $table = 'ledger_producers';

    public static function getMovieByProducerId($producerIds)
{
    $produceIn = [];

    foreach ($producerIds as $producerId) {
        
        $producermovie = DB::table('ledger_producers')->get()->where('producer_id', $producerId);
        $producesIn[] = $producermovie;
    }

    $producerInfo = [];
    
    foreach ($producesIn as $movieId) {
        $prudcerInfo[] = json_decode (json_encode ($movieId), FALSE);
    }

    $movieIds = [];
    
    foreach ($producerInfo as $movieId) {
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

