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

    public function createSeasonsFromApi($season, $tvShow)
    {
        if(!$this->IfSeasonExists($tvShow->id, $season['season_number'])){
            DB::table('seasons')->insert([
                'season_number' => $season['season_number'],
                'tv_show_id' => $tvShow->id
            ]);
        }
    }

    public function createEpisodeFromApi($episodeInfo, $episodeCredits, $tvShowId, $seasons)
    {
        print_r($seasons); print_r($episodeInfo); die;
        if(!$this->ifEpisodeExists($tvShowId, $episodeInfo['name'])) {
            DB::table('episodes')->insert([
                'episode_nr' => $episodeInfo['episode_number'],
                'title' => $episodeInfo['name'],
                'plot' => $episodeInfo['overview'],
                'playtime' => $seasons['episode_run_time'][0],
                'poster' => $episodeInfo['still_path'],
                'backdrop' => $seasons['seasons']

            ]);
        }
    }

    // season_id	int(10) unsigned	 
// episode_nr	int(11)	 
// title	varchar(255)	 
// plot	text	 
// playtime	int(11)	 
// poster	varchar(255)	 
// backdrop	varchar(255)	 
// releasedate	date	 
// imdb_rating	int(11) NULL	 
// chas_rating	int(11) NULL

    public function getTvShowByName($tvShowName)
    {
        return DB::table('tv_shows')->where('title', $tvShowName)->first();
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
