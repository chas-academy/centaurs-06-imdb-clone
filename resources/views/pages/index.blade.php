@extends('layouts.layout') @section('content')
<div class="off-canvas-content" data-off-canvas-content>
    @include('includes.header')
<main class="row">
    @include('includes.menu-btn')
    <section class="small-12">
        @include('includes.messages')
        @include('includes.errors')
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


               <!-- Section with three small movieposters -->
    <!-- <section class="small-12 flex-align-sb-c">
        <div class="small-movie-info">
            <div class="movie-rating">
                <i class="fa fa-star" aria-hidden="true"></i>
                <p class="rating-num">7.7</p>
            </div>
            <div class="row flex-align">
                <div class="small-6 cell">
                    <select name="genre" id="genre" class="sortBtn">
                        <option value="">Genre</option>
                        <option value="">Genre</option>
                        <option value="">Genre</option>
                        <option value="">Genre</option>
                        <i class="fa fa-chevron-down fa-fix"></i>
                    </select>
                </div>
                <div class="small-6 cell">
                    <select name="sortBy" id="sortBy" class="sortBtn">
                        <option value="">Sorted By</option>
                        <option value="">Sorted By</option>
                        <option value="">Sorted By</option>
                    </select>
                    <i class="fa fa-chevron-down"></i>
                </div>
            </div>
            <img src="http://via.placeholder.com/90x150">
            <h3 class="movie-title">Movie Title</h3>
        </div>
        <div class="small-movie-info">
            <div class="movie-rating">
                <i class="fa fa-star" aria-hidden="true"></i>
                <p class="rating-num">6.3</p>
            </div>
            <img src="http://via.placeholder.com/90x150">
            <h3 class="movie-title">Movie Title</h3>
        </div>
    </section> -->
                <!-- Section with three small movieposters -->


                <!-- Section with one big poster -->
    <!-- <section class="small-12 flex-align-c-c">
        <div class="big-movie-info">
            <div class="movie-rating">
                <i class="fa fa-star" aria-hidden="true"></i>
                <p class="rating-num">9.1</p>
            </div>
            <img src="http://via.placeholder.com/300x450">
            <h3 class="movie-title">Movie Title</h3>
        </div>
    </section> -->
                <!-- Section with one big poster -->

                <!-- Section with three small movieposters -->
    <!-- <section class="small-12 flex-align-sb-c">
        <div class="small-movie-info">
            <div class="movie-rating">
                <i class="fa fa-star" aria-hidden="true"></i>
                <p class="rating-num">7.7</p>
            </div>
            <img src="http://via.placeholder.com/90x150">
            <h3 class="movie-title">Movie Title</h3>
        </div>
        <div class="small-movie-info">
            <div class="movie-rating">
                <i class="fa fa-star" aria-hidden="true"></i>
                <p class="rating-num">8.4</p>
            </div>
            <img src="http://via.placeholder.com/90x150">
            <h3 class="movie-title">Movie Title</h3>
        </div>
        <div class="small-movie-info">
            <div class="movie-rating">
                <i class="fa fa-star" aria-hidden="true"></i>
                <p class="rating-num">6.3</p>
            </div>
            <img src="http://via.placeholder.com/90x150">
            <h3 class="movie-title">Movie Title</h3>
        </div>
    </section> -->
            <!-- Section with three small movieposters -->

            <!-- Section with one big poster -->
    <!-- <section class="small-12 flex-align-c-c">
        <div class="big-movie-info">
            <div class="movie-rating">
                <i class="fa fa-star" aria-hidden="true"></i>
                <p class="rating-num">9.1</p>
            </div>
            <img src="http://via.placeholder.com/300x450">
            <h3 class="movie-title">Movie Title</h3>
        </div>
    </section> -->
            <!-- Section with one big poster -->

            <!-- Section with three small movieposters -->
    <!-- <section class="small-12 flex-align-sb-c">
        <div class="small-movie-info">
            <div class="movie-rating">
                <i class="fa fa-star" aria-hidden="true"></i>
                <p class="rating-num">7.7</p>
            </div>
            <img src="http://via.placeholder.com/90x150">
            <h3 class="movie-title">Movie Title</h3>
        </div>
        <div class="small-movie-info">
            <div class="movie-rating">
                <i class="fa fa-star" aria-hidden="true"></i>
                <p class="rating-num">8.4</p>
            </div>
            <img src="http://via.placeholder.com/90x150">
            <h3 class="movie-title">Movie Title</h3>
        </div>
        <div class="small-movie-info">
            <div class="movie-rating">
                <i class="fa fa-star" aria-hidden="true"></i>
                <p class="rating-num">6.3</p>
            </div>
            <img src="http://via.placeholder.com/90x150">
            <h3 class="movie-title">Movie Title</h3>
        </div>
    </section> -->
            <!-- Section with three small movieposters -->


            <!-- Section with one big poster -->
    <!-- <section class="small-12 flex-align-c-c">
        <div class="big-movie-info">
            <div class="movie-rating">
                <i class="fa fa-star" aria-hidden="true"></i>
                <p class="rating-num">9.1</p>
            </div>
            <img src="http://via.placeholder.com/300x450">
            <h3 class="movie-title">Movie Title</h3>
        </div>
    </section> -->
            <!-- Section with one big poster -->

            <!-- Section with three small movieposters -->
    <!-- <section class="small-12 flex-align-sb-c">
        <div class="small-movie-info">
            <div class="movie-rating">
                <i class="fa fa-star" aria-hidden="true"></i>
                <p class="rating-num">7.7</p>
            </div>
            <img src="http://via.placeholder.com/90x150">
            <h3 class="movie-title">Movie Title</h3>
        </div>
        <div class="small-movie-info">
            <div class="movie-rating">
                <i class="fa fa-star" aria-hidden="true"></i>
                <p class="rating-num">8.4</p>
            </div>
            <img src="http://via.placeholder.com/90x150">
            <h3 class="movie-title">Movie Title</h3>
        </div>
        <div class="small-movie-info">
            <div class="movie-rating">
                <i class="fa fa-star" aria-hidden="true"></i>
                <p class="rating-num">6.3</p>
            </div>
            <img src="http://via.placeholder.com/90x150">
            <h3 class="movie-title">Movie Title</h3>
        </div>
    </section> -->
        <!-- Section with three small movieposters -->
</main>
@include('includes.footer')
</div>
@endsection 

@section('page-scripts')


@endsection