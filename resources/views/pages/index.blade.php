@extends('layouts.layout')
@section('content')
    <div class="grid-container">
        <div class="grid-x grid-margin-x">
        <h1>Centaurs IMDb-clone</h1>
        </div>
        <a href="/test" class="button">Test</a>
        <a href="/actors" class="button">Actors</a>
        <a href="/movies" class="button">Movies</a>
    </div>

  <?php
    // Need some work, just for testing.
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
    
    $Mresponse = curl_exec($curl);

    $err = curl_error($curl);
    
    curl_close($curl);
    $movies = json_decode($Mresponse, true);

    if ($err) {
      echo "cURL Error #:" . $err;
    } else {

        foreach ($movies['results'] as $value) { ?>

        <div class="row large-12 medium-up-4">
            <div class="column">
                <div class="card">
                    <?php echo "<img " . "src=" . "http://image.tmdb.org/t/p/w185/" . $value['poster_path'] . ">"; ?>  
                    <div class="card-section">
                    <?php echo "<a href=" . "/" . $value['id'] . ">" . "<button " . "class=" ."button" .">" . $value['original_title'] . "</button>" . "</a>"; ?>
                    </div>
                </div>
            </div>
        </div>

        <?php

        }

    }
?>

@endsection