<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\TvShow;
use App\Season;
use App\Episode;
use DB;
use Auth;
use View;
use App\Http\Models\Review;

class TvShowController extends Controller
{
    public function searchTvshowFromApi(request $request) 
    {
        $user = Auth::user();
        $api_key = 'api_key=6975fbab174d0a26501b5ba81f0e0b3c';
        $keyword = $request['q'];
        $argument = str_replace(' ', '%20', $keyword);
        $searchMethod = 'search/tv?';
        $query = $searchMethod . '&language=en-US&query=' . $argument . '&page=1&include_adult=false&' . $api_key;
        $result = $this->TvShowApi($query);
        return view('pages.api-tv-search')->with('hits', $result)->with('user', $user);
    }

    public function searchTvshowFromApiById($tvshowApiId) 
    {
        $user = Auth::user();
        $api_key = '?api_key=6975fbab174d0a26501b5ba81f0e0b3c';
        $searchMethod = 'tv/';
        $query = $searchMethod . $tvshowApiId . $api_key . '&page=1&include_adult=false';
        $result = $this->TvShowApi($query);
        $this->createTvShowFromApi($result);
        return redirect()->back()->with('hits', $result)->with('user', $user);
    }

    public function TvShowApi($query)
    {
        $api_key = 'api_key=6975fbab174d0a26501b5ba81f0e0b3c';
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.themoviedb.org/3/". $query,
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

    public function createTvShowFromApi($result)
    {
        $tvShowModel = new TvShow();
        $tvShowModel->createTvShowFromApi($result);

        $seasons = $this->getTvShowSeasons($result);
        $tvShow = $tvShowModel->getTvShowByName($seasons['name']);
        foreach ($seasons['seasons'] as $k => $season) {
            if($k <> 0) { 
                $tvShowModel->createSeasonFromApi($season, $tvShow);
                
                for ($i=1; $i <= $season['episode_count']; $i++) { 
                    
                    $episodeInfo = $this->getEpisodeInfoFromApi($result['id'], $season['season_number'], $i);
                    $episodeCredits = $this->getEpisodeActorsFromApi($result['id'], $season['season_number'], $i);

                    $tvShowModel->createEpisodeFromApi($episodeInfo, $tvShow->id, $seasons);
                    $tvShowModel->createEpisodeStaffFromApi($episodeCredits, $tvShow->id, $episodeInfo);
                } 
            }
        }
    }

    public function getEpisodeActorsFromApi($tvShowId, $seasonNr, $episodeNr)
    {
        $api_key = 'api_key=6975fbab174d0a26501b5ba81f0e0b3c';
        $query = 'tv/' . $tvShowId . '/' . 'season/' . $seasonNr . '/' . 'episode/' . $episodeNr . '/credits?' . $api_key . '&language=en-US';
        

        return $this->tvShowApi($query);
    }

    public function getEpisodeInfoFromApi($tvShowId, $seasonNr, $episodeNr)
    {
        $api_key = 'api_key=6975fbab174d0a26501b5ba81f0e0b3c';
        $query = 'tv/' . $tvShowId . '/' . 'season/' . $seasonNr . '/' . 'episode/' . $episodeNr . '?' . $api_key . '&language=en-US';

        return $this->tvShowApi($query);
    }
    public function getTvShowSeasons($tvShow)
    {
        $api_key = 'api_key=6975fbab174d0a26501b5ba81f0e0b3c';
        $query = 'tv/' . $tvShow['id'] . '?&language=en-US&' . $api_key;
 
        return $this->TvShowApi($query);
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
        $reviewModel = new Review();
        $tvShowInfo = $tvShowModel->getTvShowById($tvshow->id);
        $seasons = $tvShowModel->getTvShowSeasons($tvshow->id);
        $genre = $tvShowModel->getTvShowGenres($tvshow->id);
        $reviews = $reviewModel->getAllTvReviews($tvshow->id);

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
            'topepisodes' => $topEpisodes,
            'reviews' => $reviews
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

    public function deleteTvShow($tvShowId)
    {
        $tvshowModel = new TvShow();
        $tvShowDeleted = $tvshowModel->deleteTvShow($tvShowId);
        if($tvShowDeleted == true) {
            $message = 'TvShow has been deleted';
            return redirect('/')->with('message', $message);
        } else {
            //Tvshow with that id did not exists in db.
            return redirect('tv-shows/'. $movieId)->with('error', 'TvShow has not been deleted');
        }
    }
}

