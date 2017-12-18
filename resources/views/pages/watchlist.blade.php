@extends('layouts.layout') @section('content')
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
<main>
	<div class="small-12 flex-align-sb">
		<h2>Watchlist</h2>
	</div>
	<div class="small-12 flex-align-sb-c">
	    <select class="js-example-basic-single js-states form-control" name="states[]" id="id_label_single">
	        <option value="#" selected disabled>Genre</option>
	        <option value="Action">Action</option>
	        <option value="Drama">Comedy</option>
	        <option value="Horror">Crime</option>
	        <option value="Comedy">Horror</option>
	        <option value="Action">Drama</option>
	        <option value="Action">Sci-fi</option>
	        <option value="Action">Family</option>
	    </select>
	</div>
	<div class="small-12 flex-align-sb-c">
		<div class="watch-list-movie">
			@foreach($movies as $movie)
				<img class="movie-poster" src="https://image.tmdb.org/t/p/w500{{$movie->poster}}" alt="">
				<div class="movie-rating">
	                <i class="fa fa-star" aria-hidden="true"></i>
	                <p class="rating-num">{{$movie->imdb_rating}}</p>
	            </div>
				<h3 class="movie-title">{{$movie->title}}</h3>
				<i class="fa fa-times" aria-hidden="true"></i>
			@endforeach
		</div>
		<hr class="watch-list-separator">
	</div>
</main>
@endsection 