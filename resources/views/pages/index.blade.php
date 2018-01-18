@extends('layouts.layout') @section('content')
<div class="off-canvas-content" data-off-canvas-content>
    @include('includes.header')
    @include('includes.messages')
        @include('includes.errors')
<main class="row">
    @include('includes.menu-btn')
        <section class="small-12">
            @include('includes.messages')
            @include('includes.errors')
        </section>
        <div class="small-12 tv-shows">
            <a id="movies-link" href="/">Movies</a>
            <a id="tvshows-link" href="/tv-shows">Tv-Shows</a>
        </div>
        @foreach($movies as $key => $movie)
            @if ($key === 'movie')
                <section class="small-12 flex-align-sb-c">
                @foreach($movies['movie'] as $movie)
                    <div class="movie-poster">
                        <div class="movie-rating">
                            <p class="rating-num">{{ $movie->imdb_rating }}</p>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div> 
                        <a href="movie/{{ $movie->id }}" class="none">
                            <img class="poster-size" src="{{ App\Http\Models\Movie::getPosterUrl($movie->poster) }}" >
                                @if($movie->poster === null)
                                    <p class="movie-title">{{$movie->title}}</p>
                                @endif
                        </a>
                    </div>
                @endforeach
                </section>

            @elseif ($key === 'titles')
                <div>
                    <h5>Search results for Movies</h5>
                </div>
                <section class="small-12 flex-align-sb-c">
                @foreach($movies['titles'] as $movie)
                    <div class="movie-poster">
                        <div class="movie-rating">
                            <p class="rating-num">{{ $movie['imdb_rating'] }}</p>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div> 
                        <a href="movie/{{ $movie['id'] }}" class="none">
                        <img class="poster-size" src="{{ App\Http\Models\Movie::getPosterUrl($movie['poster']) }}" >
                            @if($movie['poster'] === null)
                                <p class="movie-title">{{$movie['title']}}</p>
                            @endif
                        </a>
                    </div>
                @endforeach
                </section>

                @elseif ($key === 'actors')
                    <div>
                        <h5>Search results for Actors</h5>
                    </div>
                    <section class="small-12 flex-align-sb-c">
                    @foreach($movies['actors'] as $movie)
                        <div class="movie-poster">
                            <div class="movie-rating">
                                <p class="rating-num">{{ $movie->imdb_rating }}</p>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div> 
                            <a href="movie/{{ $movie->id }}" class="none">
                            <img class="poster-size" src="{{ App\Http\Models\Movie::getPosterUrl($movie->poster) }}" >
                                @if($movie->poster === null)
                                    <p class="movie-title">{{$movie->title}}</p>
                                @endif
                            </a>
                        </div>
                    @endforeach
                    </section>    

                @elseif ($key === 'directors')
                    <div>
                        <h5>Search results for Directors</h5>
                    </div>
                    <section class="small-12 flex-align-sb-c">
                    @foreach($movies['directors'] as $movie)
                        <div class="movie-poster">
                            <div class="movie-rating">
                                <p class="rating-num">{{ $movie->imdb_rating }}</p>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div> 
                            <a href="movie/{{ $movie->id }}" class="none">
                            <img class="poster-size" src="{{ App\Http\Models\Movie::getPosterUrl($movie->poster) }}" >
                                @if($movie->poster === null)
                                    <p class="movie-title">{{$movie->title}}</p>
                                @endif
                            </a>
                        </div>
                    @endforeach
                    </section>
                
                @elseif ($key === 'producers')
                    <div>
                        <h5>Search results for Directors</h5>
                    </div>
                    <section class="small-12 flex-align-sb-c">
                    @foreach($movies['producers'] as $movie)
                        <div class="movie-poster">
                            <div class="movie-rating">
                                <p class="rating-num">{{ $movie->imdb_rating }}</p>
                                <i class="fa fa-star" aria-hidden="true"></i>
                            </div> 
                            <a href="movie/{{ $movie->id }}" class="none">
                            <img class="poster-size" src="{{ App\Http\Models\Movie::getPosterUrl($movie->poster) }}" >
                                @if($movie->poster === null)
                                    <p class="movie-title">{{$movie->title}}</p>
                                @endif
                            </a>
                        </div>
                    @endforeach
                    </section>
                @else
            @endif
        @endforeach
        <div class="algolia-container">
            <a href="https://www.algolia.com/">
                <img class="algolia" src="{{ asset('img/algolia/search-by-algolia-white.png') }}" >
            </a>
        </div>
</main>

@include('includes.footer')
</div>
@endsection 

@section('page-scripts')


@endsection