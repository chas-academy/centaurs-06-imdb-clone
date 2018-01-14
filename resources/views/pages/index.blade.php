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
        @foreach ($movies as $movie)
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
</main>
@include('includes.footer')
</div>
@endsection 

@section('page-scripts')


@endsection