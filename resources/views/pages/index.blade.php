@extends('layouts.layout') @section('content')
<div id="offcanvas-full-screen" class="offcanvas-full-screen" data-off-canvas="off-canvas-content" data-transition="overlap" data-content-overlay="false">
    <div class="offcanvas-full-screen-inner">
        <!-- Content off Mobile-menu -->
        <div id="menu" class="row menu">
            <div class="small-12 flex-align-c-c">
                <img src="{{ asset('img/IMDB_Logo_2016.svg.png') }}" alt="IMDb Logo" class="logo">
            </div>
            <div class="small-12 flex-align-fd-c">
                <form class="small-12" id="sign-in-f">
                    <input type="text" name="username" placeholder="Username">
                    <input type="password" name="password" placeholder="Password">
                    <input type="password" name="password" placeholder="Confirm Password">
                    <button type="submit">Sign in</button>
                </form>
                <form class="small-12" id="sign-up-f">
                    <input type="text" name="username" placeholder="Username">
                    <input type="text" name="email" placeholder="Email">
                    <input type="password" name="password" placeholder="Password">
                    <input type="password" name="password" placeholder="Confirm Password">
                    <button type="submit">Create Account</button>
                </form>
                <div id="mobile-btn-wrap" class="mobile-btn-wrap">
                    <h2 id="sign-in">Sign In</h2>
                    <h2 id="sign-up">Create your account</h2>
                </div>
            </div>
            <div id="mobile-btn-back" class="mobile-btn-back">
                <i class="fa fa-undo" aria-hidden="true"></i>
            </div>
        </div>
        <div id="mobile-btn-quit" class="mobile-btn-quit" data-close>
            <i class="fa fa-times" aria-hidden="true"></i>
        </div>
    </div>
</div>
<div class="off-canvas-content" data-off-canvas-content>
<header class="row">
    <div class="small-12 flex-align-sb-c">
        <img src="{{ asset('img/IMDB_Logo_2016.svg.png') }}" alt="IMDb Logo" class="logo">
        <i class="fa fa-search search-btn" id="search-btn" aria-hidden="true" data-toggle="search search-btn search-exit-btn" data-toggler=".hidden"></i>
        <i class="fa fa-times search-exit-btn" id="search-exit-btn" aria-hidden="true" data-toggle="search search-btn search-exit-btn" data-toggler=".visible"></i>
    </div>
    <form class="small-12 flex-align-sb-c fast" id="search" data-toggler=".visible" data-animate="fade-in fade-out">
        <input type="text" class="search-input" placeholder="Find Movies, Tv Shows and more...">
    </form>
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
    <select class="js-example-basic-single js-states form-control" name="states[]" id="id_label_single">
        <option value="#" selected disabled>Sorting By</option>
        <option value="Action">Top 15 movies</option>
        <option value="Drama">Most popular</option>
        <option value="Horror">Top rated all time</option>
    </select>
    </div>
</header>

<main class="row">
    <div id="mobile-btn-open" class="menu-btn">
        <i class="fa fa-cog" aria-hidden="true" data-toggle="offcanvas-full-screen"></i>
    </div>

               <!-- Section with three small movieposters -->
    <section class="small-12 flex-align-sb-c">
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
    </section>
                <!-- Section with three small movieposters -->


                <!-- Section with one big poster -->
    <section class="small-12 flex-align-c-c">
        <div class="big-movie-info">
            <div class="movie-rating">
                <i class="fa fa-star" aria-hidden="true"></i>
                <p class="rating-num">9.1</p>
            </div>
            <img src="http://via.placeholder.com/300x450">
            <h3 class="movie-title">Movie Title</h3>
        </div>
    </section>
                <!-- Section with one big poster -->

                <!-- Section with three small movieposters -->
    <section class="small-12 flex-align-sb-c">
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
    </section>
            <!-- Section with three small movieposters -->

            <!-- Section with one big poster -->
    <section class="small-12 flex-align-c-c">
        <div class="big-movie-info">
            <div class="movie-rating">
                <i class="fa fa-star" aria-hidden="true"></i>
                <p class="rating-num">9.1</p>
            </div>
            <img src="http://via.placeholder.com/300x450">
            <h3 class="movie-title">Movie Title</h3>
        </div>
    </section>
            <!-- Section with one big poster -->

            <!-- Section with three small movieposters -->
    <section class="small-12 flex-align-sb-c">
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
    </section>
            <!-- Section with three small movieposters -->


            <!-- Section with one big poster -->
    <section class="small-12 flex-align-c-c">
        <div class="big-movie-info">
            <div class="movie-rating">
                <i class="fa fa-star" aria-hidden="true"></i>
                <p class="rating-num">9.1</p>
            </div>
            <img src="http://via.placeholder.com/300x450">
            <h3 class="movie-title">Movie Title</h3>
        </div>
    </section>
            <!-- Section with one big poster -->

            <!-- Section with three small movieposters -->
    <section class="small-12 flex-align-sb-c">
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
    </section>
        <!-- Section with three small movieposters -->

</main>
</div>
@endsection 