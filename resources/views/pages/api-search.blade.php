@extends('layouts.layout') @section('content')
<div class="off-canvas-content" data-off-canvas-content>
    @include('includes.header')
<main class="row">
    @include('includes.menu-btn')
    
    @if (isset($message['error']))
    <section class="small-12" id="statusMsg">
        <p style="color: white">{{$message['error'] or ''}}</p>
    </section> 
    @endif

    <section class="small-12 flex-align-sb-c">
        @if(isset($hits))
            @foreach ($hits['results'] as $key => $movie)
                <div id="clickable" class="movie-poster">
                    <div class="movie-rating">
                        <p class="rating-num">{{ $movie['vote_average'] }}</p>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <!-- TO DO: SEND THE SELECTED MOVIE TO MODEL SO THAT THE MOVIE IS ADDED TO THE DATABASE -->
                    <a href="apimovie/add/{{$movie['id']}}" class="none confirm">
                        @if($movie['poster_path'] === null)
                        <img class="poster-size" src="/img/missingposter/missingposter.png" >
                        <p class="movie-title">{{$movie['title']}}</p>
                        @else
                        <img class="poster-size" src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" >
                        @endif
                    </a>

                </div>
            @endforeach
        @endif
        </select>
</main>
@include('includes.footer')
</div>
@endsection 

@section('page-scripts')


@endsection