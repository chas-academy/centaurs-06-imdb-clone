<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use DB;

class TvShow extends Model
{
    public function createTvSHowFromApi($tvShow)
    {
        if(!$this->ifTvShowExists($tvShow['name'])){
            DB::table('tv_shows')->insert([
                'title' => $tvShow['name'],
                'plot' => $tvShow['overview'],
                'poster' => $tvShow['poster_path'],
                'backdrop' => $tvShow['backdrop_path'],
                'releasedate' => $tvShow['first_air_date'],
                'imdb_rating' => $tvShow['vote_average'],
                'chas_rating' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
    
    public function ifTvShowExists($TvShowTitle): bool
    {
        return DB::table('tv_shows')->where('title', $TvShowTitle)->exists();
    }

    public function ifEpisodeExists($seasonId, $episodeTitle): bool
    {
        return DB::table('episodes')->where('season_id', $seasonId)->where('title', $episodeTitle)->exists();
    }
    
    public function IfSeasonExists($tvShowId, $seasonNumber): bool
    {
        return DB::table('seasons')->where('tv_show_id', $tvShowId)->where('season_number', $seasonNumber)->exists();
    }
}
