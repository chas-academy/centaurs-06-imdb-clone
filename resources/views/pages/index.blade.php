@extends('layouts.layout') @section('content')

<div id="offcanvas-full-screen" class="offcanvas-full-screen" data-off-canvas="off-canvas-content" data-transition="overlap" data-content-overlay="false">
    <div class="offcanvas-full-screen-inner">
        <!-- Content off Mobile-menu -->
        <div id="menu" class="row menu">
            <div class="small-12 flex-align-c-c">
                <img src="{{ asset('img/IMDB_Logo_2016.svg.png') }}" alt="IMDb Logo" class="logo">
            </div>            
        <!-- SIGN IN FORM -->
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
                        <a id="forgot-pwd" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    </div>
                </form>
        <!-- REGISTER FORM -->
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
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    <h2 class="members">Victor Ciavarella</h2>
                </div>
            </a>
            <a href="#andreas">
                <div class="offcanvas-full-screen-menu member-row">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    <h2 class="members">Andreas Sjölund</h2>
                </div>
            </a>
            <a href="#patryk">
                <div class="offcanvas-full-screen-menu member-row">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    <h2 class="members">Patryk Rybaczek</h2>
                </div>
            </a>
            <a href="#ida">
                <div class="offcanvas-full-screen-menu member-row">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    <h2 class="members">Ida Englund</h2>
                </div>
            </a>
            <a href="#laya">
                <div class="offcanvas-full-screen-menu member-row">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    <h2 class="members">Laya Sadegh</h2>
                </div>
            </a>
            <a href="#pontus">
                <div class="offcanvas-full-screen-menu member-row">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    <h2 class="members">Pontus Sarland</h2>
                </div>
            </a>
            <a href="#eleonor">
                <div class="offcanvas-full-screen-menu member-row">
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
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
            <p class="personal-info">Webdeveloper</p>
            <div class="info">
                <h2 class="personal-info">BEST MOVIE OF ALL TIME:</h2>
                <p class="personal-info">Godfather</p>
                <h2 class="personal-info">FAV QUOTE:</h2>
                <p class="personal-info">"First make it work, then make it pretty"</p>
                <h2 class="personal-info">FAV SHORT COMMAND:</h2>
                <p class="personal-info">CMD + Z</p>
            </div>
            <p class="personal-info pad-bottom">github.com/Ciavarella</p>
        </div>
    </div>
    <!-- Another personal page -->
    <div class="row personal-container" id="andreas">
        <div class="small-12">
            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
            <h2 class="personal-info">Andreas Sjölund</h2> 
            <p class="personal-info">Webdeveloper</p>          
            <div class="info">
                <h2 class="personal-info">BEST MOVIE OF ALL TIME:</h2>
                <p class="personal-info">Pulp Fiction</p>   
                <h2 class="personal-info">FAV QUOTE:</h2>   
                <p class="personal-info">"No man, they got the metric system. They wouldn't know what the fuck a Quarter Pounder is"</p>  
                <h2 class="personal-info">FAV SHORT COMMAND:</h2>   
                <p class="personal-info">CMD + A DEL</p>    
            </div>
            <p class="personal-info pad-bottom">github.com/andreas</p>
        </div>
    </div>

        <!-- Another personal page -->
    <div class="row personal-container" id="ida">
        <div class="small-12">
            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
            <h2 class="personal-info">Ida Englund</h2> 
            <p class="personal-info">Webdeveloper</p>          
            <div class="info">
                <h2 class="personal-info">BEST MOVIE OF ALL TIME:</h2>
                <p class="personal-info">Remember the titans</p>   
                <h2 class="personal-info">FAV QUOTE:</h2>   
                <p class="personal-info">"The question is not, can they reason?, nor can they talk? but, can they suffer?"</p>
                <h2 class="personal-info">FAV SHORT COMMAND:</h2>   
                <p class="personal-info">CMD + Z</p>    
            </div>
            <p class="personal-info pad-bottom">github.com/Ida</p>
        </div>
    </div>

    <div class="row personal-container" id="patryk">
        <div class="small-12">
            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
            <h2 class="personal-info">Patryk Rybaczek</h2> 
            <p class="personal-info">Webdeveloper</p>          
            <div class="info">
                <h2 class="personal-info">BEST MOVIE OF ALL TIME:</h2>
                <p class="personal-info">In Time</p>   
                <h2 class="personal-info">FAV QUOTE:</h2>   
                <p class="personal-info">"I don't care, let's use Jquery"</p>  
                <h2 class="personal-info">FAV SHORT COMMAND:</h2>   
                <p class="personal-info">CMD + C</p>    
            </div>
            <p class="personal-info pad-bottom">github.com/Patryk</p>
        </div>
    </div>

    <div class="row personal-container" id="laya">
        <div class="small-12">
            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
            <h2 class="personal-info">Laya Sadegh</h2> 
            <p class="personal-info">Webdeveloper</p>          
            <div class="info">
                <h2 class="personal-info">BEST MOVIE OF ALL TIME:</h2>
                <p class="personal-info">Le fabuleux destin d’Amélie Poulain</p>   
                <h2 class="personal-info">FAV QUOTE:</h2>   
                <p class="personal-info">"Insanity: doing the same thing over and over again and expecting different results."</p>  
                <h2 class="personal-info">FAV SHORT COMMAND:</h2>   
                <p class="personal-info">Ctrl + Z</p>    
            </div>
            <p class="personal-info pad-bottom">github.com/Laya</p>
        </div>
    </div>

    <div class="row personal-container" id="pontus">
        <div class="small-12">
            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
            <h2 class="personal-info">Pontus Sarland</h2> 
            <p class="personal-info">Webdeveloper</p>          
            <div class="info">
                <h2 class="personal-info">BEST MOVIE OF ALL TIME:</h2>
                <p class="personal-info">Inception</p>   
                <h2 class="personal-info">FAV QUOTE:</h2>   
                <p class="personal-info">"Don't you want to take a leap of faith? Or become an old man, filled with regret, waiting to die alone!"</p>  
                <h2 class="personal-info">FAV SHORT COMMAND:</h2>   
                <p class="personal-info">Ctrl + V</p>    
            </div>
            <p class="personal-info pad-bottom">github.com/Pontus</p>
        </div>
    </div>

    <div class="row personal-container" id="eleonor">
        <div class="small-12">
            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
            <h2 class="personal-info">Eleonor Bergqvist</h2> 
            <p class="personal-info">Webdeveloper</p>          
            <div class="info">
                <h2 class="personal-info">BEST MOVIE OF ALL TIME:</h2>
                <p class="personal-info">Forrest Gump</p>   
                <h2 class="personal-info">FAV QUOTE:</h2>   
                <p class="personal-info">"Life isn't about finding yourself. Life is about creating yourself"</p>  
                <h2 class="personal-info">FAV SHORT COMMAND:</h2>   
                <p class="personal-info">CMD + S</p>    
            </div>
            <p class="personal-info pad-bottom">github.com/Eleonor</p>
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
</main>

<!-- Footer starts here, not sure to use it -->
<footer class="row footer-cont">
    <div class="small-12 footer">
        <p>Chas Academy - Centaurs</p>
        <div class="off-canvas-cont" data-off-canvas-content>
            <button data-toggle="offcanvas-full-members">
                <i class="fa fa-users" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</footer>
</div>
@endsection 