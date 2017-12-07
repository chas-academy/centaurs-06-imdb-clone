<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\Movie;

class MovieController extends Controller
{
    public function MovieApi($argument) 
    {
        $api_key = 'api_key=6975fbab174d0a26501b5ba81f0e0b3c';

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.themoviedb.org/3/search/movie?" . $api_key . '&language=en-US&query=' . $argument . '&page=1&include_adult=false',
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

        $movie = new Movie();

        $movie->createMovie($result);

        
        
    }

    public function SearchForMovie() 
    {
        $keyword = 'fight club';
        $argument = str_replace(' ', '%20', $keyword);
        $search = $argument . '&page=1&include_adult=false';

        $this->MovieApi($search);
    } 
}
