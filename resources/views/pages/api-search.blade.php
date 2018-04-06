@extends('layouts.layout') @section('content')
<div class="off-canvas-content" data-off-canvas-content>
    @include('includes.header')
    @include('includes.messages')
    @include('includes.errors')
<main class="row">
    @include('includes.menu-btn')
    <section class="small-12 flex-align-sb-c">
        @if(isset($hits))
            @foreach ($hits['results'] as $key => $movie)
                <div id="clickable" class="movie-poster">
                    <div class="movie-rating">
                        <p class="rating-num">{{ $movie['vote_average'] }}</p>
                        <i class="fa fa-star" aria-hidden="true"></i>
                    </div>
                    <a href="apimovie/add/{{$movie['id']}}" class="none confirm">
                        @if($movie['poster_path'] === null)
                            <img class="poster-size" src="/img/missingposter/missingposter.png" alt="No poster image available" title="No poster image available" />
                            <p class="movie-title">{{$movie['title']}}</p>
                        @else
                            <img class="poster-size" src="<?= config('app.poster_url') . $movie['poster_path']; ?>" alt="Poster image for {{$movie['title']}}" title="{{$movie['title']}}" />
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