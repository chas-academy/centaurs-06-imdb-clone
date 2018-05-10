@extends('layouts.layout') @section('content')
<div class="off-canvas-content" data-off-canvas-content>
    @include('includes.header')
    @include('includes.messages')
    @include('includes.errors')
<main class="row">
    @include('includes.menu-btn')
    <section class="small-12">
    </section>
        <div class="small-12 tv-shows">
            <a id="movies-link" href="/">Movies</a>
            <a id="tvshows-link" href="/tv-shows">Tv-Shows</a>
        </div>
    <section class="small-12 flex-align-sb-c">
        @forelse ($tvshows as $tvshow)
            <div class="movie-poster">
                <div class="movie-rating delete-btn-cont">
                    @if(Auth::check())
                        @if(Auth::user()->type === 'admin')
                        <a href="/tv-show/{{ $tvshow->id }}/delete"><i class="fa fa-trash delete-review delete-btn" aria-hidden="true"></i></a>
                        @endif
                    @endif
                    <p class="rating-num">{{ $tvshow->imdb_rating }}</p>
                    <i class="fa fa-star" aria-hidden="true"></i>
                </div>
                <a href="tv-show/{{ $tvshow->id }}" class="none">
                    <img class="poster-size" src="{{ App\Http\Models\Movie::getPosterUrl($tvshow->poster) }}" >
                    @if($tvshow->poster === null)
                        <p class="movie-title">{{$tvshow->title}}</p>
                    @endif
                </a>
            </div>
        @empty
            <h4>Could not find any shows matching current criteria.</h4>
        @endforelse
    </section>
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