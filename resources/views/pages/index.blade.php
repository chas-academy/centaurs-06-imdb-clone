@extends('layouts.layout') @section('content')
<div class="off-canvas-content" data-off-canvas-content>
    @include('includes.header')
<main class="row">
    @include('includes.menu-btn')
    <section class="small-12">
        <p style="color: white">{{$message['error'] or ''}}</p>
    </section>
    <section class="small-12 flex-align-sb-c">
        @foreach ($movies as $movie)
            <div class="movie-poster">
                <div class="movie-rating">
                    <p class="rating-num">{{ $movie->imdb_rating }}</p>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </div> 
                <a href="movie/{{ $movie->id }}" class="none">
                    @if($movie->poster === null)
                    <img class="poster-size" src="/img/missingposter/missingposter.png" >
                    <p class="movie-title">{{$movie->title}}</p>
                    @else
                    <img class="poster-size" src="https://image.tmdb.org/t/p/w500{{ $movie->poster }}" >
                    @endif
                </a>
            </div>
        @endforeach            
    </section>
</main>
@include('includes.footer')
</div>
@endsection 