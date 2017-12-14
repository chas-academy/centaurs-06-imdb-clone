<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\TvShow;

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
        $keyword = "Game";
        $argument = str_replace(' ', '%20', $keyword);
        $searchMethod = 'search/tv?';
        $search = '&language=en-US&query=' . $argument . '&page=1';

        $result = $this->TvShowApi($search, $searchMethod);

        $tvShow = new TvShow();
        $tvShow->createTvSHowFromApi($result['results'][0]);
        $this->getMovieStaffFromApi($result['results'][0]);
    }
}
