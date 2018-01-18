@extends('layouts.layout') @section('content')
<?php $user = Auth::user();
$i = $_GET['episode'];

$currentEpisode = 'Episode-' . $i;
// dd($episodeDetails)
?>


<header id="desk-hide" class="row">
    <div id="desk-hide" class="small-12 header-flex-align-sb-c">
        <a href="{{ URL::to('/') }}"><img src="{{ asset('img/Logo.svg') }}" alt="IMDb Logo" class="logo"></a>
        <i class="fa fa-search search-btn" id="search-btn" aria-hidden="true" data-toggle="search search-btn search-exit-btn" data-toggler=".hidden"></i>
        <i class="fa fa-times search-exit-btn" id="search-exit-btn" aria-hidden="true" data-toggle="search search-btn search-exit-btn" data-toggler=".visible"></i>
    </div>
    <form class="small-12 header-flex-align-sb-c fast" id="search" data-toggler=".visible" data-animate="fade-in fade-out">
        <input type="text" class="search-input" placeholder="Find Movies, Tv Shows and more...">
    </form>
</header>
<div id="mobile-hide">
<img class="current-movie backdrop-image" src="https://image.tmdb.org/t/p/w1920{{ $episodeDetails['episodes'][$currentEpisode]->backdrop }}">
</div>
<main class="row current-movie">
    <div class="small-12 large-12 movie-flex-align">
        <div class="movie-info">
        <div class="movie-content">
            <div class="poster-section">
                <div class="small-12 flex-align-c-c">
                    <a class="watchlist-btn" href="/addwatchlist"><i class="fa fa-list"></i> Add to watchlist</a>
                </div>

                <div class="movie-rating">
                    <p class="rating-num">{{ $episodeDetails['episodes'][$currentEpisode]->imdb_rating }}</p>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </div>
                <img class="poster-image" src="{{ App\Http\Models\Movie::getPosterUrl($episodeDetails['episodes'][$currentEpisode]->poster) }}">
            </div>

            <div class="movie-info-section">
                <div class="small-12 movie-description">
                    <div class="small-12">
                    <h3 class="movie-title">{{ $episodeDetails['episodes'][$currentEpisode]->title }}</h3>
                    </div>
                    <div class="small-12 year-play">
                        <p class="movie-year">{{ $episodeDetails['episodes'][$currentEpisode]->releasedate }}</p>
                        <p>|</p>
                        <p class="playtime">{{ $episodeDetails['episodes'][$currentEpisode]->playtime }} min</p>
                        <p>|</p>
                        <p class="season-nr">Season: {{ $episodeDetails['episodes'][$currentEpisode]->season_id }}</p>
                    </div>
                    <div class="small-12 episodes-container">
                        <b>Seasons: </b>
                        <ul class="episode-list">
                            @if (empty($episodeDetails['seasons']))
                            <p>No seasons found</p>
                            @else
                            @foreach ($episodeDetails['seasons'] as $season)
                            <a href="/tv-show/{{ $season->tvshow_id }}/season/{{ $season->season_number }}?episode=1"><li class="episode-number">{{ $season->season_number }}</li></a>
                            @endforeach
                            @endif
                        </ul>
                    </div>         
                    <div class="small-12 episodes-container">
                        <b>Episodes: </b>
                        <ul class="episode-list">
                            @if (empty($episodeDetails['episodes'][$currentEpisode]))
                                <p>No episodes found</p>
                            @else
                            @foreach($episodeDetails['episodes'] as $episode)
                                <a id="currentEpisode1" href="?episode={{  $episode->episode_nr  }}"><li class="episode-number">{{ $episode->episode_nr }}</li></a>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                </div>

                <div class="small-12 movie-crew">
                    <div class="movie-crew-card">
                        <b>Directors</b>
                        <ul class="director">
                        @if (empty($episodeDetails['directors'][$currentEpisode]))
                            <p>No directors found</p>
                        @else
                        @foreach ($episodeDetails['directors'][$currentEpisode] as $directors)
                            <li class="person-name">{{ $directors['name'][0] }}</li>
                        @endforeach
                        @endif
                        </ul>
                    </div>
                    <div class="movie-crew-card">
                        <b>Writers</b>
                        <ul class="w-credits">
                        @if (empty($episodeDetails['writers'][$currentEpisode]))
                            <p>No writers found</p>
                        @else
                        @foreach ($episodeDetails['writers'][$currentEpisode] as $writers)
                            <li class="person-name">{{ $writers['name'][0] }}</li>
                        @endforeach
                        @endif
                        </ul>
                    </div>
                    <div class="movie-crew-card">
                        <b>Producer</b>
                        <ul class="producer">
                            @if (empty($episodeDetails['producers'][$currentEpisode]))
                                <p>No producers found</p>
                            @else
                            @foreach ($episodeDetails['producers'][$currentEpisode] as $producers)
                                <li class="person-name">{{ $producers['name'][0] }}</li>
                            @endforeach
                            @endif
                        </ul>
                    </div>
                    <div class="movie-crew-card">
                        <b>Cast</b>
                        <ul class="actor">
                        @if (empty($episodeDetails['actors'][$currentEpisode]))
                            <p>No actors found</p>
                        @else
                        @foreach ($episodeDetails['actors'][$currentEpisode] as $actors)
                            <li class="person-name">{{ $actors['name'][0] }}</li>
                        @endforeach
                        @endif
                        </ul>
                    </div>          
                </div>
                <div class="small-12 movie-plot">
                    <b>Storyline :</b>
                    <p class="plot">{{ $episodeDetails['episodes'][$currentEpisode]->plot }}</p>
                </div>
            </div>
        </div>
            <div class="small-12 btn-container">
                <button class="read-review" data-toggle="read-reviews">Read reviews</button>

                @if(Auth::check())
                    <button class="writer-review" data-toggle="write-reviews">Write a review</button>
                @endif
            </div> 
        </div>
    </div>
    <div class="small-12 review-flex-align">
        <div id="write-reviews" class="write-reviews" data-toggler=".visible">
            <div class="review-rate">
                <form class="write-review-form" action="/addreview" method="POST">
                    {{ csrf_field() }}
                    <fieldset class="rating">
                        <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                        <input type="radio" id="star4half" name="rating" value="4.5" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                        <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                        <input type="radio" id="star3half" name="rating" value="3.5" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                        <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                        <input type="radio" id="star2half" name="rating" value="2.5" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                        <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                        <input type="radio" id="star1half" name="rating" value="1.5" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                        <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                        <input type="radio" id="starhalf" name="rating" value="0.5" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                    </fieldset>
            </div>
                <input type="text" placeholder="Title" name="title">
                <textarea name="content" id="" cols="30" rows="20" placeholder="Content of review"></textarea>
                <button class="send-review" type="submit" name=''>Add review</button>
            </form>                   
        </div>
                <div id="review-1" class="small-12 review">
                    <div class="small-12 review-rate">
                        <p>No reviews written for this movie yet.</p>
                    </div>
                </div>
            
                </div>
            </div>
        </div>
    </div>
</main>
@endsection 