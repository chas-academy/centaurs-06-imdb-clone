<!-- USER MENU/SETTINGS -->
<div id="offcanvas-full-screen" class="offcanvas-full-screen" data-off-canvas="off-canvas-content" data-transition="overlap" data-content-overlay="false">
    <div class="offcanvas-full-screen-inner">
        <!-- Content off Mobile-menu -->
        <div id="menu" class="row menu">
            <div class="small-12 flex-align-c-c">
                <img src="{{ asset('img/Logo.svg') }}" alt="IMDb Logo" class="logo hidden">
            </div>
            <!-- Only shows on desktop -->
            <header id="mobile-hide" class="row">
                <div class="small-12 header-flex-align-sb-c">
                    <a href="{{ URL::to('/') }}"><img src="{{ asset('img/Logo.svg') }}" alt="IMDb Logo" class="logo"></a>
                    <i class="fa fa-search search-btn" id="search-btn-desktop" aria-hidden="true" data-toggle="search-desktop search-btn-desktop search-exit-btn-desktop" data-toggler=".hidden"></i>
                    <i class="fa fa-times search-exit-btn" id="search-exit-btn-desktop" aria-hidden="true" data-toggle="search-desktop search-btn-desktop search-exit-btn-desktop" data-toggler=".visible"></i>
                </div>
                <div id="search-desktop" class="small-12 header-flex-align-sb-c" data-toggler=".visible">
                    <form class="small-12 search fast" data-animate="fade-in fade-out" method="GET" action="/search">
                        <input type="text" class="search-input" placeholder="Find Movies, Tv Shows and more..." name="q">
                        <button type="submit"><i class="fa fa-search search-btn" id="search-btn-desktop" aria-hidden="true"></i></button>
                    </form> 
                </div>
                <div class="small-12 header-flex-align-sb-c">
                    <select id ="sortByGenreDesktop" class="js-example-basic-single js-states form-control" name="states[]" id="id_label_single">
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
                    <select id="sortBySpecDesktop" class="js-example-basic-single js-states form-control" name="states[]" id="id_label_single">
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
            <!-- Sign in -->
        
        <?php if (!Auth::check()): ?>
            
            <div class="small-12 flex-align-fd-c">
                
                <!-- Reset password link by email -->
                
                <!-- Register new user -->
                
            </div>

            <div id="mobile-btn-wrap" class="mobile-btn-wrap">
                <h2 id="sign-in">Sign In</h2>
                <h2 id="sign-up">Create your account</h2>
            </div>

        <?php endif; ?>

            <!-- Profilepage -->

            <?php if (Auth::check()): ?>

                <div class="small-12 flex-align-fd-c" id="profile-page">
                    <div id="avatar" data-toggler=".visible" data-animate="fade-in fade-out" class"width-100">
                    <img class="avatar" src="/img/avatars/{{ $user->avatar }}" style="width:60px; height:60px; border-radius:50%;">
                    </div>
                    <h2 class="avatar">Hi {{ $user->name }}!</h2>
                        <div class="cont-profile">
                            @php
                                $user = Auth::user()->type;

                                if($user == "admin")
                                {
                                    echo '<a class="white" data-toggler="visible" data-animate="fade-in fade-out" href="/">Back to movies</a>'; 
                                }
                            @endphp
                            <a id="manage-users" class="admin-btn white">Manage users</a>
                            <a id="manage-movies" class="admin-btn white">Manage movies</a>
                            <a id="manage-tvshows" class="admin-btn white">Manage Tv shows</a>
                            <a id="manage-reviews" class="admin-btn white">Manage reviews</a>
                        </div>
                </div>
                <div id="manage-users-panel" class="small-12 flex-align-fd-c hide">
                    <h2>Manage users</h2>
                    <form action="" method="">
                        <input type="text" name="search-user"> 
                        <button type="submit"><i class="fa fa-search search-btn" id="search-btn" aria-hidden="true"></i></button>
                    </form>
                </div>
                <div id="manage-movies-panel" class="small-12 flex-align-fd-c hide">
                    <h2>Manage movies</h2>
                    <a href="" class="white">Find movie</a>
                    <a href="" class="white">Add movie</a>
                    <a href="" class="white">Edit movie</a>
                    <a href="" class="white">Delete movie</a>
                </div>
                <div id="manage-tvshows-panel" class="small-12 flex-align-fd-c hide">
                    <h2>Manage TV shows</h2>
                    <a href="" class="white">Find TV Shows</a>
                    <a href="" class="white">Add TV shows</a>
                    <a href="" class="white">Edit TV shows</a>
                    <a href="" class="white">Delete TV shows</a>
                </div>
                <div id="manage-reviews-panel" class="small-12 flex-align-fd-c hide">
                    <h2>Manage TV shows</h2>
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
                </div>
                <!-- Back buttons for profile settings -->
                    <!-- Sign out button -->
                    <div id="sign-out">
                            <a id="log-out" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>

            <?php endif; ?>

            <!-- shows on desktop -->
            <footer id="mobile-hide" class="row footer-mobile">
                <div class="small-12 footer">
                    <button data-toggle="offcanvas-full-members">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </button>
                    <p>Curious about us?</p>    
                </div>
            </footer>

        <div id="mobile-btn-back" class="mobile-btn-back">
            <i class="fa fa-undo" aria-hidden="true"></i>
        </div>
        </div>
        <div id="mobile-btn-quit" class="mobile-btn-quit" data-close>
            <i class="fa fa-times" aria-hidden="true"></i>
        </div>
    </div>
</div>
