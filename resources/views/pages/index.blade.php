@extends('layouts.layout') @section('content')

<div id="offcanvas-full-screen" class="offcanvas-full-screen" data-off-canvas="off-canvas-content" data-transition="overlap" data-content-overlay="false">
    <div class="offcanvas-full-screen-inner">
        <!-- Content off Mobile-menu -->
        <div id="menu" class="row menu">
            <div class="small-12 flex-align-c-c">
                <img src="{{ asset('img/IMDB_Logo_2016.svg.png') }}" alt="IMDb Logo" class="logo">
            </div>            
            <!-- Sign in -->
            <div class="small-12 flex-align-fd-c">
                <form class="small-12" id="sign-in-f" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <input type="text" name="email" placeholder="Email">
                    <input type="password" name="password" placeholder="Password">
                    <div class="small-12 btn">
                        <button type="submit" class="submit">Sign in</button>
                    </div>
                    <!-- Forgot password -->
                    <div class="col-md-8 col-md-offset-4">
                        <p id="forgot-pwd" data-toggle="password-form">Forgot Your Password?</p>
                    </div>
                </form>
                <!-- Reset password link by email -->
                <form id="password-form" class="small-12" method="POST" action="{{ route('password.email') }}" data-toggler=".visible" data-animate="fade-in fade-out">
                    {{ csrf_field() }}    
                    <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                    <div class="small-12 btn reset-pwd-btn">
                        <button type="submit" class="reset-pwd">Send Password Reset Link</button>        
                    </div>               
                </form>
                <!-- Register new user -->
                <form class="small-12" id="sign-up-f" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <input type="text" name="name" placeholder="Name">
                    <input type="text" name="email" placeholder="Email">
                    <input type="password" name="password" placeholder="Password">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password">
                    <div class="small-12 btn">
                        <button type="submit" class="submit">Create Account</button>
                    </div>
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
<!-- Content for offcanvas members -->
<div id="offcanvas-full-members" class="offcanvas-full-members" data-off-canvas data-transition="overlap" data-content-overlay="false">
    <div class="offcanvas-full-screen-inner">
        <button class="offcanvas-full-screen-close" aria-label="Close menu" type="button" data-close>
            <span aria-hidden="true">&times;</span>
        </button>
        <h1 class="developers">Developers</h1>
        <p class="click-info">Click the name for more information</p>
        <div class="member-container">
            <a href="#victor">
                <div class="offcanvas-full-screen-menu member-row">
                    <h2 class="members">Victor Ciavarella</h2>
                </div>
            </a>
            <a href="#andreas">
                <div class="offcanvas-full-screen-menu member-row">
                    <h2 class="members">Andreas Sjölund</h2>
                </div>
            </a>
            <a href="#patryk">
                <div class="offcanvas-full-screen-menu member-row">
                    <h2 class="members">Patryk Rybaczek</h2>
                </div>
            </a>
            <a href="#ida">
                <div class="offcanvas-full-screen-menu member-row">
                    <h2 class="members">Ida Englund</h2>
                </div>
            </a>
            <a href="#laya">
                <div class="offcanvas-full-screen-menu member-row">
                    <h2 class="members">Laya Sadegh</h2>
                </div>
            </a>
            <a href="#pontus">
                <div class="offcanvas-full-screen-menu member-row">
                    <h2 class="members">Pontus Sarland</h2>
                </div>
            </a>
            <a href="#eleonor">
                <div class="offcanvas-full-screen-menu member-row">
                    <h2 class="members">Eleonor Bergqvist</h2>
                </div>
            </a>
        </div>
    </div>
    <!-- Each personal page -->
    <div class="row personal-container" id="victor">
        <div class="small-12">
            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
            <h2 class="personal-info">Victor Ciavarella</h2>
            <p class="p-text">Webdeveloper</p>
            <div class="info">
                <h6 class="personal-info">BEST MOVIE OF ALL TIME:</h6>
                <p class="p-text">Godfather</p>
                <h6 class="personal-info">FAVORITE QUOTE:</h6>
                <p class="p-text">"First make it work, then make it pretty"</p>
                <h6 class="personal-info">BEST SHORT COMMAND:</h6>
                <p class="p-text">CMD + Z</p>
            </div>
            <div class="github-cont">
                <i id="github" class="fa fa-github" aria-hidden="true"></i>
                <a href="https://github.com/Ciavarella" class="personal-info pad-bottom">Ciavarella</a>
                <hr class="line"></hr>
            </div>
        </div>
    </div>
    <!-- Another personal page -->
    <div class="row personal-container" id="andreas">
        <div class="small-12">
            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
            <h6 class="personal-info">Andreas Sjölund</h6> 
            <p class="p-text">Webdeveloper</p>          
            <div class="info">
                <h6 class="personal-info">BEST MOVIE OF ALL TIME:</h6>
                <p class="p-text">Pulp Fiction</p>   
                <h6 class="personal-info">FAVORITE QUOTE:</h6>   
                <p class="p-text">"No man, they got the metric system. They wouldn't know what the fuck a Quarter Pounder is"</p>  
                <h6 class="personal-info">BEST SHORT COMMAND:</h6>   
                <p class="p-text">CMD + A DEL</p>    
            </div>
            <div class="github-cont">
                <i id="github" class="fa fa-github" aria-hidden="true"></i>
                <a href="https://github.com/Andreas-sjolund-chas" class="personal-info pad-bottom">Andreas-sjolund-chas</a>
                <hr class="line"></hr>
            </div>
        </div>
    </div>
        <!-- Another personal page -->
    <div class="row personal-container" id="ida">
        <div class="small-12">
            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
            <h2 class="personal-info">Ida Englund</h2> 
            <p class="p-text">Webdeveloper</p>          
            <div class="info">
                <h6 class="personal-info">BEST MOVIE OF ALL TIME:</h6>
                <p class="p-text">Remember the titans</p>   
                <h6 class="personal-info">FAVORITE QUOTE:</h6>   
                <p class="p-text">"The question is not, can they reason?, nor can they talk? but, can they suffer?"</p>
                <h6 class="personal-info">BEST SHORT COMMAND:</h6>   
                <p class="p-text">CMD + Z</p>    
            </div>
            <div class="github-cont">
                <i id="github" class="fa fa-github" aria-hidden="true"></i>
                <a href="https://github.com/idaenglund" class="personal-info pad-bottom">idaenglund</a>
                <hr class="line"></hr>
            </div>
        </div>
    </div>
    <!-- Another personal page -->
    <div class="row personal-container" id="patryk">
        <div class="small-12">
            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
            <h2 class="personal-info">Patryk Rybaczek</h2> 
            <p class="p-text">Webdeveloper</p>          
            <div class="info">
                <h6 class="personal-info">BEST MOVIE OF ALL TIME:</h6>
                <p class="p-text">In Time</p>   
                <h6 class="personal-info">FAVORITE QUOTE:</h6>   
                <p class="p-text">"I don't care, let's use Jquery"</p>  
                <h6 class="personal-info">BEST SHORT COMMAND:</h6>   
                <p class="p-text">CMD + C</p>    
            </div>
            <div class="github-cont">
                <i id="github" class="fa fa-github" aria-hidden="true"></i>
                <a href="https://github.com/patryk7rybaczek" class="personal-info pad-bottom">patryk7rybaczek</a>
                <hr class="line"></hr>
            </div>
        </div>
    </div>
    <!-- Another personal page -->
    <div class="row personal-container" id="laya">
        <div class="small-12">
            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
            <h2 class="personal-info">Laya Sadegh</h2> 
            <p class="p-text">Webdeveloper</p>          
            <div class="info">
                <h6 class="personal-info">BEST MOVIE OF ALL TIME:</h6>
                <p class="p-text">Le fabuleux destin d’Amélie Poulain</p>   
                <h6 class="personal-info">FAVORITE QUOTE:</h6>   
                <p class="p-text">"Insanity: doing the same thing over and over again and expecting different results."</p>  
                <h6 class="personal-info">BEST SHORT COMMAND:</h6>   
                <p class="p-text">Ctrl + Z</p>    
            </div>
            <div class="github-cont">
                <i id="github" class="fa fa-github" aria-hidden="true"></i>
                <a href="https://github.com/lalaya" class="personal-info pad-bottom">lalaya</a>
                <hr class="line"></hr>
            </div>
        </div>
    </div>
    <!-- Another personal page -->
    <div class="row personal-container" id="pontus">
        <div class="small-12">
            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
            <h2 class="personal-info">Pontus Sarland</h2> 
            <p class="p-text">Webdeveloper</p>          
            <div class="info">
                <h6 class="personal-info">BEST MOVIE OF ALL TIME:</h6>
                <p class="p-text">Inception</p>   
                <h6 class="personal-info">FAVORITE QUOTE:</h6>   
                <p class="p-text">"Don't you want to take a leap of faith? Or become an old man, filled with regret, waiting to die alone!"</p>  
                <h6 class="personal-info">BEST SHORT COMMAND:</h6>   
                <p class="p-text">Ctrl + V</p>    
            </div>
            <div class="github-cont">
                <i id="github" class="fa fa-github" aria-hidden="true"></i>
                <a href="https://github.com/PontusSarland88" class="personal-info pad-bottom">PontusSarland88</a>
                <hr class="line"></hr>
            </div>
        </div>
    </div>
    <!-- Another personal page -->
    <div class="row personal-container" id="eleonor">
        <div class="small-12">
            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
            <h2 class="personal-info">Eleonor Bergqvist</h2> 
            <p class="p-text">Webdeveloper</p>          
            <div class="info">
                <h6 class="personal-info">BEST MOVIE OF ALL TIME:</h6>
                <p class="p-text">Forrest Gump</p>   
                <h6 class="personal-info">FAVORITE QUOTE:</h6>   
                <p class="p-text">"Life isn't about finding yourself. Life is about creating yourself"</p>  
                <h6 class="personal-info">BEST SHORT COMMAND:</h6>   
                <p class="p-text">CMD + S</p>    
            </div>
            <div class="github-cont">
                <i id="github" class="fa fa-github" aria-hidden="true"></i>
                <a href="https://github.com/eleonorbergqvist" class="personal-info pad-bottom">eleonorbergqvist</a>
            </div>
        </div>
    </div>
     <!-- Button to close off-canvas -->
    <div id="mobile-btn-quit" class="mobile-btn-quit" data-close>
        <i class="fa fa-times" aria-hidden="true"></i>
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

            <?php foreach($genres as $genre): ?>
                <option value="<?php echo $genre->genre_name ?>"><?php echo $genre->genre_name ?></option>
            <?php endforeach; ?>   
        </select>

        <select class="js-example-basic-single js-states form-control" name="states[]" id="id_label_single">
            <option value="#" selected disabled>Sorting By</option>
            <option value="Action">Top 15 movies</option>
            <option value="Drama">Release date</option>
            <option value="Horror">Top rated all time</option>
        </select>
    </div>
</header>

<main class="row">
    <div id="mobile-btn-open" class="menu-btn">
        <i class="fa fa-cog" aria-hidden="true" data-toggle="offcanvas-full-screen"></i>
    </div>

    <section class="small-12 flex-align-sb-c">
        <?php foreach($movies as $movie): ?>
            <a href="movie/<?php echo $movie->id ?>" class="none">
                <div class="small-movie-info">
                    <div class="movie-rating">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <p class="rating-num"><?php echo $movie->imdb_rating ?></p>
                    </div>

                    <img class="poster-size" src="https://image.tmdb.org/t/p/w500<?php echo $movie->poster ?>" >
                    <div class="movie-title-container">
                        <h3 class="movie-title"><?php echo $movie->title ?></h3>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
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

<!-- Footer starts here, not sure to use it -->
    <footer class="row footer-cont" data-toggle="offcanvas-full-members">
        <div class="small-12 footer">
            <p>Curious about us?</p>
            <div class="off-canvas-cont" data-off-canvas-content>
                <i class="fa fa-users" aria-hidden="true"></i>
            </div>
        </div>
    </footer>
</div>
@endsection 