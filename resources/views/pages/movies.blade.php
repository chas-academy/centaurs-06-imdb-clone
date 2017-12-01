<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.themoviedb.org/3/movie/top_rated?page=1&language=en-US&api_key=6975fbab174d0a26501b5ba81f0e0b3c",
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


$movies = json_decode($response, true);

// print_r($movies);
// die;

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  
    foreach ($movies['results'] as $value) {
        
        echo "<pre>";
        print_r("Title: " . $value['original_title']);
        echo "<pre>";
        print_r("Plot: " . $value['overview']);
        echo "<pre>";
        print_r("Rating: " . $value['vote_average']);
        

        
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.themoviedb.org/3/movie/" . $value['id'] . "/credits?api_key=6975fbab174d0a26501b5ba81f0e0b3c",
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

        $actors = json_decode($response, true);

        foreach ($actors['cast'] as $key) {
            echo '<pre>';
            print_r("Name: " . $key['name']);
            echo '<pre>';

            }   
            
            echo "<hr>";

    }

        curl_close($curl);


}





?>