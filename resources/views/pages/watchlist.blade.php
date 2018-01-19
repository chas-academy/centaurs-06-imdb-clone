@extends('layouts.layout') @section('content')
@include('includes.messages')
@include('includes.errors')
<div class="off-canvas-content" data-off-canvas-content>
<header class="row">
    <div class="small-12 header-flex-align-sb-c">
        <a href="{{ URL::to('/') }}"><img src="{{ asset('img/Logo.svg') }}" alt="IMDb Logo" class="logo"></a>
        <i class="fa fa-search search-btn" id="search-btn" aria-hidden="true" data-toggle="search search-btn search-exit-btn" data-toggler=".hidden"></i>
        <i class="fa fa-times search-exit-btn" id="search-exit-btn" aria-hidden="true" data-toggle="search search-btn search-exit-btn" data-toggler=".visible"></i>
    </div>
    <div id="search" class="small-12 header-flex-align-sb-c" data-toggler=".visible">
        <form class="small-12 search fast" data-animate="fade-in fade-out">
            <input type="text" class="search-input" placeholder="Find Movies, Tv Shows and more...">
            <button type="submit"><i class="fa fa-search search-btn" id="search-btn" aria-hidden="true"></i></button>
        </form> 
    </div>
    <div class="small-12 header-flex-align-c-c">
		<h1>Watchlist</h1>
    </div>
    <div class="small-12 header-flex-align-c-c">
        <select class="js-example-basic-single js-states form-control genreSorting" name="states[]" id="id_label_single">
            <option value="#" selected disabled>Genre</option>
            @foreach($genres as $genre)
                <option value="{{ $genre->genre_name }}">@php echo $genre->genre_name @endphp</option>
            @endforeach
        </select>
    </div>
</header>
	<main class="row">
    	@include('includes.menu-btn')
	    @foreach($movies as $movie)
	    	<div class="small-12 watchlist-movie">
	            <div class="small-12 flex-align-c-c">
	                <a href="movie/{{ $movie->id }}" class="none">
						<img class="poster-size" src="{{ App\Http\Models\Movie::getPosterUrl($movie->poster) }}" >
						@if($movie->poster === null)
							<p class="movie-title">{{$movie->title}}</p>
						@endif
					</a>		
	            </div>
	            <div class="small-12 flex-align-c-c">
			        <i class="fa fa-star" aria-hidden="true"></i>
			        <p class="rating-num">{{ $movie->imdb_rating }}</p>
	            </div> 
	            <div class="small-12 flex-align-c-c">
	            	<p class="title">{{ $movie->title }}</p>
	            </div>
	            <div class="small-12 flex-align-c-c">
	            	<a href="/watchlist/delete/movie/{{ $movie->id }}"><i class="fa fa-close"></i></a>
	            </div>
	    	</div>
	    @endforeach
		@foreach($tvshows as $tvshow)
	    	<div class="small-12 watchlist-movie">
	            <div class="small-12 flex-align-c-c">
	                <a href="tv-show/{{ $tvshow->id }}" class="none">
	                    <img class="poster-size" src="https://image.tmdb.org/t/p/w500{{ $tvshow->poster }}" >
	                </a>
	            </div>
	            <div class="small-12 flex-align-c-c">
			        <i class="fa fa-star" aria-hidden="true"></i>
			        <p class="rating-num">{{ $tvshow->imdb_rating }}</p>
	            </div> 
	            <div class="small-12 flex-align-c-c">
	            	<p class="title">{{ $tvshow->title }}</p>
	            </div>
	            <div class="small-12 flex-align-c-c">
	            	<a href="/watchlist/delete/tvshow/{{ $tvshow->id }}"><i class="fa fa-close"></i></a>
	            </div>
	    	</div>
	    @endforeach
   	</main>
	@include('includes.footer')
</div>

@endsection 