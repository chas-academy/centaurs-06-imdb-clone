<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\TvShow;
use App\Season;
use App\Episode;
use DB;
use Auth;

use View;

class TvShowController extends Controller
{
    public function TvShowApi($argument, $searchMethod)
    {
        $api_key = 'api_key=6975fbab174d0a26501b5ba81f0e0b3c';
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.themoviedb.org/3/". $searchMethod . $api_key . $argument,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{}",
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            $result = json_decode($response, true);
            
            return $result; 
    }

    public function createTvShowFromApi()
    {
        $keyword = "Game Of Thrones";
        $argument = str_replace(' ', '%20', $keyword);
        $searchMethod = 'search/tv?';
        $search = '&language=en-US&query=' . $argument . '&page=1';

        $result = $this->TvShowApi($search, $searchMethod);
        
        $tvShowModel = new TvShow();
        $tvShowModel->createTvSHowFromApi($result['results'][0]);

        $seasons = $this->getTvShowSeasons($result['results'][0]);
        $tvShow = $tvShowModel->getTvShowByName($seasons['name']);

        foreach ($seasons['seasons'] as $k => $season) {
            if($k <> 0) { 
                $tvShowModel->createSeasonFromApi($season, $tvShow);
                
                for ($i=1; $i <= $season['episode_count']; $i++) { 
                    $episodeInfo = $this->getEpisodeInfoFromApi([$seasons][0]['id'], $season['season_number'], $i);
                    $episodeCredits = $this->getEpisodeActorsFromApi([$seasons][0]['id'], $season['season_number'], $i);
                    $tvShowModel->createEpisodeFromApi($episodeInfo, $tvShow->id, $seasons);
                    $tvShowModel->createEpisodeStaffFromApi($episodeCredits, $tvShow->id, $episodeInfo);
                } 
            }
        }
    }

    public function getEpisodeActorsFromApi($tvShowId, $seasonNr, $episodeNr)
    {
        $searchMethod = 'tv/' . $tvShowId . '/' . 'season/' . $seasonNr . '/' . 'episode/' . $episodeNr . '/credits?';
        $languageEndString = '&language=en-US';

        return $this->tvShowApi($languageEndString, $searchMethod);
    }

    public function getEpisodeInfoFromApi($tvShowId, $seasonNr, $episodeNr)
    {
        $searchMethod = 'tv/' . $tvShowId . '/' . 'season/' . $seasonNr . '/' . 'episode/' . $episodeNr . '?';
        $languageEndString = '&language=en-US';

        return $this->tvShowApi($languageEndString, $searchMethod);
    }
    public function getTvShowSeasons($tvShow)
    {
        $searchMethod = 'tv/' . $tvShow['id'] . '?';
        $languageEndString = '&language=en-US';

        return $this->TvShowApi($languageEndString, $searchMethod);
    }
    public function readTvShows()
    {
        $tvShowModel = new TvShow();
        $tvshows = $tvShowModel->getAllTvShows();

        $view = View::make('pages.tvshows')->with('tvshows', $tvshows);

        return $view;

    }
    public function list($id)
    {
        $tvshow = TvShow::find($id);
        $tvShowModel = new TvShow;
        $tvShowInfo = $tvShowModel->getTvShowById($tvshow->id);
        $seasons = $tvShowModel->getTvShowSeasons($tvshow->id);
        $genre = $tvShowModel->getTvShowGenres($tvshow->id);

        $topEpisodes = DB::table('episodes', 'seasons')
                            ->leftJoin('seasons', 'episodes.season_id', '=', 'seasons.id')
                            ->leftJoin('tv_shows', 'tv_shows.id', '=', 'seasons.tvshow_id')
                            ->where('tv_shows.id', '=', $tvshow->id)
                            ->orderBy('episodes.imdb_rating', 'desc')
                            ->select('episodes.*', 'seasons.*')
                            ->limit(6)
                            ->get();

        $tvDetails = array(
            'tvshow' => $tvShowInfo,
            'seasons' => $seasons,
            'genres' => $genre,
            'topepisodes' => $topEpisodes
        );

        $view = View::make('pages.tvshow')->with('tvDetails', $tvDetails);
        
        return $view;

    }
    public function seasonlist($tvshowId, $seasonId)
    {
        $tvShowModel = new TvShow;
        $seasonId = $tvShowModel->getEpisodeBySeason($seasonId, $tvshowId);
        $episodes = $tvShowModel->getEpisodesFromSpecificSeason($seasonId);
        $episodeIds = [];
        
        
        foreach ($episodes as $episode) {
            array_push($episodeIds, $episode->id);
        }

        $actorIds = $tvShowModel->getActorsFromEpisode($episodeIds);
        $actors = $tvShowModel->getActorNamesFromActorId($actorIds);
        $directorIds = $tvShowModel->getDirectorsFromEpisode($episodeIds);
        $directors = $tvShowModel->getDirectorNamesFromDirectorId($directorIds);
        $producerIds = $tvShowModel->getProducersFromEpisode($episodeIds);
        $producers = $tvShowModel->getProducerNamesFromProducerId($producerIds);
        $writerIds = $tvShowModel->getWritersFromEpisode($episodeIds);
        $writers = $tvShowModel->getWriterNamesFromWriterId($writerIds);
        $seasons = $tvShowModel->getTvShowSeasons($tvshowId);
        
        $episodeDetails = array(
            'episodes' => $episodes,
            'actors' => $actors,
            'directors' => $directors,
            'producers' => $producers,
            'writers' => $writers,
            'seasons' => $seasons
        );

        $view = View::make('pages.episodes')->with('episodeDetails', $episodeDetails);
        
        return $view;
        
    }

    public function addTvshowToWatchlist($tvshowId)
    {
        $userId = Auth::user()->id;

        $tvShowModel = new TvShow();
        $tvShowModel->addTvshowToWatchlist($userId, $tvshowId);

        return redirect('tv-show/'. $tvshowId);

    }

    public function removeTvshowFromWatchlist($tvshowId)
    {

        $userId = Auth::user()->id;
        $tvShowModel = new TvShow();
        $tvShowModel->removeTvshowFromWatchlist($userId, $tvshowId);

        if ($tvshowId)
        {
            $message = 'Tvshow has been deleted';

            return redirect('/watchlist')->with('message', $message);
        }

        else {
            $error = 'Tvshow could not be deleted from watchlist, please try again';

            return redirect('/watchlist')->with('error', $error); 
        }

    }

}

