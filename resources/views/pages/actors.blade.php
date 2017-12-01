
<div class="content" id="content">

<?php

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.themoviedb.org/3/movie/666/credits?api_key=6975fbab174d0a26501b5ba81f0e0b3c",
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

    curl_close($curl);
    $actors = json_decode($response, true);
    
    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        
        // print all cast & crew.
        foreach ($actors as $actor) {
            echo '<pre>';
            print_r($actor);
            echo '<pre>';
        }
      
    }

    // print cast name.
    foreach ($actors['cast'] as $key) {
        echo '<pre>';
        print_r($key['name']);
        echo '<pre>';
    }

    ?>

    </div>