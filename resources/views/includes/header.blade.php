@if(Auth::check())
<?php $user = Auth::user(); ?>
@endif

<header id="desk-hide" class="row">
    <div class="small-12 header-flex-align-sb-c">
        <a href="{{ URL::to('/') }}"><img src="{{ asset('img/Logo.svg') }}" alt="IMDb Logo" class="logo"></a>
        @if (Auth::check())
        <div class="avatar">
        <img class="avatar" src="/img/avatars/{{  $user->avatar  }}" style="width:50px; height:50px; border-radius:50%;">
        </div>
        @endif
        <i class="fa fa-search search-btn" id="search-btn" aria-hidden="true" data-toggle="search search-btn search-exit-btn" data-toggler=".hidden"></i>
        <i class="fa fa-times search-exit-btn" id="search-exit-btn" aria-hidden="true" data-toggle="search search-btn search-exit-btn" data-toggler=".visible"></i>
    </div>
    <div id="search" class="small-12 header-flex-align-sb-c" data-toggler=".visible">
        <form class="small-12 search fast" data-animate="fade-in fade-out" method="GET" action="/search">
            <input type="text" class="search-input" placeholder="Find Movies, Tv Shows and more..." name="q">
            <button type="submit"><i class="fa fa-search search-btn" id="search-btn" aria-hidden="true"></i></button>
        </form> 
    </div>
    
    <div class="small-12 header-flex-align-sb-c">
        <select id ="sortByGenreSelect" class="js-example-basic-single js-states form-control" name="states[]" id="id_label_single">
            <option value="#" selected disabled>Genre</option>
            <option value="Action">Action</option>
            <option value="Adventure">Adventure</option>
            <option value="Animation">Animation</option>
            <option value="Comedy">Comedy</option>
            <option value="Crime">Crime</option>
            <option value="Documentary">Documentary</option>
            <option value="Drama">Drama</option>
            <option value="Family">Family</option>
            <option value="Fantasy">Fantasy</option>
            <option value="History">History</option>
            <option value="Horror">Horror</option>
            <option value="Music">Music</option>
            <option value="Mystery">Mystery</option>
            <option value="Romance">Romance</option>
            <option value="Science Fiction">Science Fiction</option>
            <option value="TV Movie">TV Movie</option>
            <option value="Thriller">Thriller</option>
            <option value="War">War</option>
            <option value="Western">Western</option>
        </select>
        <select id="sortBySpecSorting" class="js-example-basic-single js-states form-control" name="states[]" id="id_label_single">
            <option value="#" selected disabled>Sort By</option>
            <option value="top15">Top 15 movies</option>
            <option value="topAllTime">Top rated of all time</option>
            <option value="topScore">Highest rated movies</option>
            <option value="lowImdb">Lowest rated movies</option>
            <option value="a-z">From A To Z</option>
            <option value="z-a">From Z To A</option>
            <option value="releaseNew">Relase date (Newest first)</option>
            <option value="releaseOld">Relase date (Oldest first)</option>
            <option value="topChas">Top rating (Chas-score)</option>
        </select>
    </div>
</header>