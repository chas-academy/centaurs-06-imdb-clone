@extends('layouts.layout') @section('content')
<?php
// var_dump($movie->title);
// die;
?>
<header class="row">
    <div class="small-12 flex-align-sb-c">
        <img src="{{ asset('img/IMDB_Logo_2016.svg.png') }}" alt="IMDb Logo" class="logo">
        <i class="fa fa-search search-btn" id="search-btn" aria-hidden="true" data-toggle="search search-btn search-exit-btn" data-toggler=".hidden"></i>
        <i class="fa fa-times search-exit-btn" id="search-exit-btn" aria-hidden="true" data-toggle="search search-btn search-exit-btn" data-toggler=".visible"></i>
    </div>
    <form class="small-12 flex-align-sb-c fast" id="search" data-toggler=".visible" data-animate="fade-in fade-out">
        <input type="text" class="search-input" placeholder="Find Movies, Tv Shows and more...">
    </form>
</header>
<main class="row current-movie">
    <div class="small-12 flex-align-c-c">
        <div class="big-movie-info">
            <div class="movie-rating">
                <i class="fa fa-star" aria-hidden="true"></i>
                <p class="rating-num"><?php echo $movie->imdb_rating ?></p>
            </div>
            <img src="https://image.tmdb.org/t/p/w1000<?php echo $movie->poster ?>">
            <div class="small-12 movie-info">
                <h3 class="movie-title"><?php echo $movie->title ?></h3>
                <div class="year-genre">
                    <p class="movie-year"><?php echo $movie->releasedate ?></p>
                    <p class="separator">|</p>
                    <p class="movie-genre">
                    <ul>
                <?php foreach ($genres as $genre): ?>
                    <li><?php echo $genre ?></li>
                <?php endforeach; ?>
                    </ul>
                    </p>
                </div>
            </div>
            <div class="small-12 movie-plot">
                <p class="plot"><?php echo $movie->plot ?></p>
            </div>
            <div class="small-12 movie-crew">
                
                <p class="director"><b>Director :</b>                     
                    <ul>
                <?php foreach ($directors as $director): ?>
                    <li><?php echo $director ?></li>
                <?php endforeach; ?>
                    </ul></p>
                
                <p class="producer"><b>Producer :</b>                     
                    <ul>
                <?php foreach ($producers as $producer): ?>
                    <li><?php echo $producer ?></li>
                <?php endforeach; ?>
                    </ul></p>

                    <p class="producer">
                    <ul>
                <?php foreach ($actors as $actor): ?>
                    <li><?php echo $actor ?></li>
                <?php endforeach; ?>
                    </ul></p>

                <p class="w-credits"><b>Writing Credits :</b>                     
                    <ul>
                <?php foreach ($writers as $writer): ?>
                    <li><?php echo $writer ?></li>
                <?php endforeach; ?>
                    </ul></p></p>
            </div>
            <div class="small-12 reviews-btn">
                <button class="mobile-write-rev" data-toggle="write-rev">Write a review</button>
            </div> 
            <div id="write-rev" class="small-12 write-rev" data-toggler=".visible" data-animate="fade-in fade-out">
                <div class="rev-rate">
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                    <i class="fa fa-star-o" aria-hidden="true"></i>
                </div>
                <form id="write-rev-form">
                    <input type="text" placeholder="Title">
                    <textarea name="" id="" cols="30" rows="20" placeholder="Content of review"></textarea>
                    <button class="send-rev">Add review</button>
                </form>
            </div>
            <div class="small-12 reviews-btn">
                <button class="mobile-reviews" data-toggle="rev-container">Read reviews</button>
            </div>   
            <div id="rev-container" data-toggler=".visible">
            <div id="review" class="small-12 review">
                <h3 class="rev-title">The artist you would never know</h3>
                <div class="small-12 review-info-wrap">
                    <div class="small-6 review-info">
                        <p class="rev-auth">Author: Adam K</p>
                        <p class="rev-date">Date: 1 december 2017</p>                    
                    </div>
                    <div class="small-6 review-rate">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-half" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="small-12 ">
                    <p class="rev-text">
                    Aside from appearances in Paddington or Blue Jasmine, 
                    I'd never really thought about Sally Hawkins as a leading lady of a 
                    major production, but sometimes you're proved to be severely wrong 
                    because her performance here floored me. I was incredibly invested 
                    in every single moment her character was on-screen and anything 
                    I didn't like about this movie faded away every time she interacted 
                    with someone and had to display her emotions through her sign language 
                    or by just simply tearing up or showing emotion through her eyes. 
                    I will be remembering this performance as one of the best
                    of the year by year.</p>
                    <p class="rev-text">
                    In the end, where I think this film slightly fails is in its addition of human villains.
                    The Shape of Water is a beautiful romance at its core, but I didn't feel the 
                    movie shows quite enough of it to really be a masterpiece, even though 
                    the production designers sure made it feel like a damn elegant piece of cinema. 
                    If for nothing else, the set design, along with the visual effects and art 
                    direction, will surely be included in the awards season to come, because it's 
                    some of the best I've seen all year (possibly even the absolute best).</p>
                </div>
            </div>
            <hr class="rev-separator">
            <div class="small-12 review">
                <h3 class="rev-title">This movie sucks</h3>
                <div class="small-12 review-info-wrap">
                    <div class="small-6 review-info">
                        <p class="rev-auth">Author: lil coder</p>
                        <p class="rev-date">Date: 2 february 2222</p>                    
                    </div>
                    <div class="small-6 review-rate">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star-half" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="small-12">
                    <p class="rev-text">
                    Aside from appearances in Paddington or Blue Jasmine, 
                    I'd never really thought about Sally Hawkins as a leading lady of a 
                    major production, but sometimes you're proved to be severely wrong 
                    because her performance here floored me. I was incredibly invested 
                    in every single moment her character was on-screen and anything 
                    I didn't like about this movie faded away every time she interacted 
                    with someone and had to display her emotions through her sign language 
                    or by just simply tearing up or showing emotion through her eyes. 
                    I will be remembering this performance as one of the best
                    of the year by year.
                    </p>
                    <p class="rev-text">
                    In the end, where I think this film slightly fails is in its addition of human villains.
                    The Shape of Water is a beautiful romance at its core, but I didn't feel the 
                    movie shows quite enough of it to really be a masterpiece, even though 
                    the production designers sure made it feel like a damn elegant piece of cinema. 
                    If for nothing else, the set design, along with the visual effects and art 
                    direction, will surely be included in the awards season to come, because it's 
                    some of the best I've seen all year (possibly even the absolute best). 
                    </p>
                </div>
            </div>
            </div>
        </div>
    </div>
</main>
@endsection 