<?php

// First, Get Movie (or movies), extrakt ID.
// then, get movie detail where Movie_id = Movie_detail_id.

$curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.themoviedb.org/3/movie/666?language=en-US&api_key=6975fbab174d0a26501b5ba81f0e0b3c",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_POSTFIELDS => "{}",
    ));
    
    $Mresponse = curl_exec($curl);

    $err = curl_error($curl);
    
    curl_close($curl);
    $movies = json_decode($Mresponse, true);
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {

       echo '<pre>'; 
       print_r("Title: " . $movies['original_title']);
       echo '<pre>';

       echo '<pre>';
       print_r("Plot: " . $movies['overview']);
       echo '<pre>';
       
       echo '<pre>';
       print_r("Rating: " . $movies['popularity']);
       echo '<pre>';
    }

?>