@extends('layouts.layout') @section('content')
<header class="row">
    <div class="small-12 header-flex-align-sb-c">
        <a href="{{ URL::to('/') }}"><img src="{{ asset('img/Logo.svg') }}" alt="IMDb Logo" class="logo"></a>
        <i class="fa fa-search search-btn" id="search-btn" aria-hidden="true" data-toggle="search search-btn search-exit-btn" data-toggler=".hidden"></i>
        <i class="fa fa-times search-exit-btn" id="search-exit-btn" aria-hidden="true" data-toggle="search search-btn search-exit-btn" data-toggler=".visible"></i>
    </div>
    <form class="small-12 header-flex-align-sb-c fast" id="search" data-toggler=".visible" data-animate="fade-in fade-out">
        <input type="text" class="search-input" placeholder="Find Movies, Tv Shows and more...">
    </form>
</header>

<main class="row current-movie">
    <div class="small-12 movie-flex-align">
        <div class="movie-info">
            <div class="movie-rating">
                <p class="rating-num">{{ $movie->imdb_rating }}</p>
                <i class="fa fa-star" aria-hidden="true"></i>
            </div>
            <img src="https://image.tmdb.org/t/p/w1000{{ $movie->poster }}">
            <div class="small-12 movie-desciption">
                <div class="small-12">
                <h3 class="movie-title">{{ $movie->title }}</h3>
                </div>
                <div class="small-12 year-play">
                    <p class="movie-year">{{ $movie->releasedate }}</p>
                    <p>|</p>
                    <p class="playtime">
                        {{ $movie->playtime }} min
                    </p>
                </div>
                <div class="small-12 movie-genre">
                    @foreach ($genres as $genre)
                        <p class="genre">{{ $genre }}</p>
                    @endforeach
                </div>
            </div>
            <div class="small-12 movie-crew">
                <b>Director</b>
                <p class="director">
                    @foreach ($directors as $director)
                        {{ $director }}
                    @endforeach
                </p>

                <b>Writers</b>
                <p class="w-credits">
                    @foreach ($writers as $writer)
                        {{ $writer }}
                    @endforeach
                </p> 

                <b>Producer</b>
                <p class="producer">
                    @foreach ($producers as $producer)
                        {{ $producer }}
                    @endforeach
                </p>

                <b>Cast</b>
                <p class="actor">
                    @foreach ($actors as $actor)
                        {{ $actor }}
                    @endforeach
                </p>           
            </div>
            <div class="small-12 movie-plot">
                <b>Storyline :</b>
                <p class="plot">{{ $movie->plot }}</p>
            </div>
        </div>
    </div>
    <div class="small-12 btn-container">
        <button class="read-review" data-toggle="read-reviews">Read reviews</button>
        <button class="writer-review" data-toggle="write-reviews">Write a review</button>
    </div> 
    <div class="small-12 review-flex-align">
        <div id="write-reviews" class="write-reviews" data-toggler=".visible">
            <div class="review-rate">
                <fieldset class="rating">
                    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                    <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                    <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                    <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                    <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                    <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                </fieldset>
            </div>
            <form class="write-review-form">
                <input type="text" placeholder="Title">
                <textarea name="" id="" cols="30" rows="20" placeholder="Content of review"></textarea>
                <button class="send-review">Add review</button>
            </form>                     
        </div>
        <div id="read-reviews" class="read-reviews" data-toggler=".visible">
            <div id="review-1" class="small-12 review">
                <div class="small-12 review-rate">
                    <i class="fa fa-star-half" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </div>
                <h3 class="review-title">The artist you would never know</h3>
                <div class="small-12 review-description">
                    <div class="small-12 review-info">
                        <p class="review-auth"><b>Author:</b> Adam K</p>
                        <p class="review-date"><b>Date:</b> 1 December 2017</p>
                    </div>
                    <div class="small-12">
                        <p class="review-content">
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
                    </div>
                </div>
            </div>
            <div id="review-1" class="small-12 review">
                <div class="small-12 review-rate">
                    <i class="fa fa-star-half" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </div>
                <h3 class="review-title">The artist you would never know</h3>
                <div class="small-12 review-description">
                    <div class="small-12 review-info">
                        <p class="review-auth"><b>Author:</b> Lil Coder</p>
                        <p class="review-date"><b>Date:</b> 48 December 2069</p>
                    </div>
                    <div class="small-12">
                        <p class="review-content">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection 