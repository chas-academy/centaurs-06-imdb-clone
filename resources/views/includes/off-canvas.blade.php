@if(Auth::check())
<?php $user = Auth::user(); ?>
@endif

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
        
        @if (!Auth::check())
            
            <div class="small-12 flex-align-fd-c">
                <form data-abide novalidate class="small-12" id="sign-in-f" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <label>
                    <input type="email" name="email" placeholder="Email" required>
                    <span class="form-error">Invalid email.</label>

                    <label>
                    <input type="password" name="password" placeholder="Password" required>
                    <span class="form-error">Invalid password.</span>
                    </label>


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
                <form data-abide novalidate class="small-12" id="sign-up-f" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <label>
                        <input type="text" name="name" placeholder="Name" required>
                        <span class="form-error">Please fill in name.</span>
                    <label>

                    <label>
                        <input type="email" name="email" placeholder="Email" required>
                        <span class="form-error">Invalid email.</span>
                    </label> 

                    <label>
                        <input type="password" name="password" placeholder="Password" required>
                        <span class="form-error">Fill in password.</span>
                    </label>

                    <label>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                        <span class="form-error">Please confirm password.</span>
                    </label>

                    <div class="small-12 btn">
                        <button type="submit" class="submit">Create Account</button>
                    </div>
                </form>
            </div>

            <div id="mobile-btn-wrap" class="mobile-btn-wrap">
                <h2 id="sign-in">Sign In</h2>
                <h2 id="sign-up">Create your account</h2>
            </div>

        @endif

            <!-- Profilepage -->

            @if (Auth::check())

                <div class="small-12 flex-align-fd-c" id="profile-page">
                    <div id="avatar" data-toggler=".visible" data-animate="fade-in fade-out" class"width-100">
                    <img class="avatar" src="/img/avatars/{{ $user->avatar }}" style="width:60px; height:60px; border-radius:50%;">
                    </div>
                    <div id="user-name" data-toggler=".visible">
                        <h2 class="avatar">Hi {{ $user->name }}!</h2>
                    </div>
                        <div class="cont-profile">
                            <h2 id="links" data-toggle="white avatar settings back-settings admin-panel" data-toggler=".visible" data-animate="fade-in fade-out">Profile</h2>
                            <a id="white" data-toggler=".visible" data-animate="fade-in fade-out" href="/watchlist">Watchlist</a>
                            
                        @if(Auth::user()->type === 'admin')
                            <h2 id="admin-panel" class="link-font-size" data-toggle="back-a-settings user-name avatar links white admin-settings" data-toggler=".visible" data-animate="fade-in fade-out">Admin Panel</h2>
                        @endif
                        </div>
                    <div class"width-100">

                        <!-- Admin panel -->
                        @if(Auth::user()->type === 'admin')
                        <div id="admin-settings" data-toggler=".visible" data-animate="fade-in fade-out">
                            <h2 id="mng-user" class="link-font-size" data-toggle="admin-settings back-settings">Manage users</h2>
                            <h2 id="mng-mov" class="link-font-size" data-toggle="admin-settings back-a-movies back-a-settings section-mng-mov">Manage movies</h2>
                            <h2 id="mng-tv" class="link-font-size" data-toggle="admin-settings back-settings">Manage TV shows</h2>
                            <h2 id="mng-rvws" class="link-font-size" data-toggle="admin-settings back-settings">Manage reviews</h2>
                        </div>
                        <!-- Admin panel : manage movies -->
                        <div id="section-mng-mov" class="hidden" data-toggler=".visible" data-animate="fade-in fade-out">
                            <h2 id="mng-user" class="link-font-size" data-toggle="section-mng-mov back-settings api-search-field">Search via API</h2>
                            <h2 id="mng-mov" class="link-font-size" data-toggle="section-mng-mov back-settings">Add new movie</h2>
                            <h2 id="mng-tv" class="link-font-size" data-toggle="section-mng-mov back-settings">Edit movie</h2>
                            <h2 id="mng-rvws" class="link-font-size" data-toggle="section-mng-mov back-settings">Delete movie</h2>
                        </div>
                        <!-- Search for movie in API -->
                        <div id="api-search-field" class="hidden small-12 header-flex-align-sb-c" data-toggler=".visible" data-animate="fade-in fade-out">
                        <form class="small-12 search fast" data-animate="fade-in fade-out" method="GET" action="/search-api">
                            <input type="text" class="search-input" placeholder="Search movie from API..." name="q">
                            <button type="submit"><i class="fa fa-search search-btn" id="search-btn-desktop" aria-hidden="true"></i></button>
                        </form>
                    </div>
                        @endif                
                        <!-- Profile settings -->
                        <div id="settings" data-toggler=".visible" data-animate="fade-in fade-out">
                            <h2 id="chg-mail" class="link-font-size" data-toggle="email-update settings back-email back-settings">Change e-mail</h2>
                            <h2 id="chg-pwd" class="link-font-size" data-toggle="password-update settings back-password back-settings">Change password</h2>
                            <h2 id="add-av" class="link-font-size" data-toggle="add-avatar settings back-avatar back-settings avatar">Add avatar</h2>
                            <h2 id="delete-acc" class="link-font-size" data-toggle="delete-account settings back-delete back-settings">Delete account</h2>
                        </div>
                        <!-- Update email -->
                        <div id="email-update" data-toggler=".visible" data-animate="fade-in fade-out">
                            <form data-abide novalidate action="/email-update/{{ $user->id }}" method="POST">
                                {{ csrf_field() }}
                                <label>
                                <input type="email" name="new-email" placeholder="Enter new email" required></input>
                                <span class="form-error">Must be an email, please try again.</span>
                                <button class="email-btn" type="submit">Confirm</button>
                                </label>
                            </form>
                        </div>
                        <!-- Update password -->
                        <div id="password-update" data-toggler=".visible" data-animate="fade-in fade-out">
                            <form data-abide novalidate action="/password-update/{{ $user->id }}" method="POST">
                                {{ csrf_field() }}
                                <label>
                                    <input type="password" name="current-password" placeholder="Enter current password" required></input>
                                    <span class="form-error">Wrong password, please try again.</span>
                                </label>
 
                                <input type="password" name="new-password" placeholder="Enter new password" required></input>
                                <button class="email-btn" type="submit">Confirm</button>
                            </form>
                        </div>
                        <!-- Delete account -->
                        <div id="delete-account" data-toggler=".visible" data-animate="fade-in fade-out">
                            <h2 id="delete-text">Are you sure?</h2>
                            <a class="email-btn" href="/delete-account/{{ $user->id }}">Confirm</a>
                        </div>
                        <!-- Add profile picture -->
                        <div id="add-avatar" aria-hidden="true" data-toggler=".visible" data-animate="fade-in fade-out">
                            <div id="right">
                                <div class="upload-btn-wrapper">
                                    <button class="butn">Upload a file</button>
                                    <form enctype="multipart/form-data" action="/profile" method="POST">
                                    <input id="input-file" type="file" name="avatar">
                                </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input class="send-pic" type="submit" class="button">
                            </div>
                        </div>
                    </form>                  
                </div>
                <!-- Back buttons for profile settings -->
                <h2 id="back-email" class="back-btn link-font-size" data-toggler=".visible" data-animate="fade-in fade-out" data-toggle="email-update settings back-email back-settings">Back</h2>
                <h2 id="back-password" class="back-btn link-font-size" data-toggler=".visible" data-animate="fade-in fade-out" data-toggle="password-update settings back-password back-settings">Back</h2>
                <h2 id="back-avatar" class="back-btn link-font-size" data-toggler=".visible" data-animate="fade-in fade-out" data-toggle="add-avatar settings back-avatar back-settings avatar">Back</h2>
                <h2 id="back-delete" class="back-btn link-font-size" data-toggler=".visible" data-animate="fade-in fade-out" data-toggle="delete-account settings back-delete back-settings">Back</h2>
                <h2 id="back-settings" class="back-btn link-font-size" data-toggler=".visible" data-animate="fade-in fade-out" data-toggle="settings admin-panel back-settings white avatar">Back</h2>
                <!-- Back buttons for admin settings -->
                <h2 id="back-a-settings" class="back-btn link-font-size" data-toggler=".visible" data-animate="fade-in fade-out" data-toggle="admin-settings back-a-settings links white avatar">Back</h2>
                <h2 id="back-a-movies" class="back-btn link-font-size" data-toggler=".visible" data-animate="fade-in fade-out" data-toggle="admin-settings back-a-movies back-a-settings section-mng-mov">Back</h2>
                    <!-- Sign out button -->
                    <div id="sign-out">
                            <li>
                                <a id="log-out" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </div>
                    </div>

            @endif

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
<!-- ABOUT DEVS -->
<div id="offcanvas-full-members" class="offcanvas-full-members" data-off-canvas data-transition="overlap" data-content-overlay="false">
    <div class="fullscreen-container">
        <!-- Head of About Devs -->
        <div class="small-12 head">
            <h1>Developers</h1>
            <p>Click the name for more information</p>
        </div>
        <!-- The list of Devs -->
        <div class="small-12 list">
            <ul>
                <li><a href="#victor">Victor Ciavarella</a></li>
                <li><a href="#andreas">Andreas Sjölund</a></li>
                <li><a href="#patryk">Patryk Rybaczek</a></li>
                <li><a href="#ida">Ida Englund</a></li>
                <li><a href="#laya">Laya Sadegh</a></li>
                <li><a href="#pontus">Pontus Sarland</a></li>
                <li><a href="#eleonor">Eleonor Bergqvist</a></li>
            </ul>
        </div>
    </div>

    <!-- About the Dev -->
    <div class="small-12 about-container" id="victor">
        <div class="small-12 head">
            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
            <h2>Victor Ciavarella</h2>
            <p>Web Developer</p>
        </div>
        <div class="small-12 info">
            <h2>Favorite Movie</h2>
            <p>Godfather</p>
            <h2>Favorite Quote</h2>
            <p>First make it work, then make it pretty</p>
            <h2>Favorite Short Command</h2>
            <p>CMD + Z</p>
        </div>
        <div class="small-12 git">
            <i class="fa fa-github" aria-hidden="true"></i>
            <a href="https://github.com/Ciavarella">Ciavarella</a>
        </div>
    </div>

    <!-- About the Dev -->
    <div class="small-12 about-container" id="andreas">
        <div class="small-12 head">
            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
            <h2>Andreas Sjölund</h2>
            <p>Web Developer</p>
        </div>
        <div class="small-12 info">
            <h2>Favorite Movie</h2>
            <p>Pulp Fiction</p>
            <h2>Favorite Quote</h2>
            <p>"No man, they got the metric system. They wouldn't know what the fuck a Quarter Pounder is"</p>
            <h2>Favorite Short Command</h2>
            <p>CMD + A DEL</p>
        </div>
        <div class="small-12 git">
            <i class="fa fa-github" aria-hidden="true"></i>
            <a href="https://github.com/Andreas-sjolund-chas">Andreas-sjolund-chas</a>
        </div>
    </div>

    <!-- About the Dev -->
    <div class="small-12 about-container" id="patryk">
        <div class="small-12 head">
            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
            <h2>Patryk Rybaczek</h2>
            <p>Web Developer</p>
        </div>
        <div class="small-12 info">
            <h2>Favorite Movie</h2>
            <p>Menace II Society</p>
            <h2>Favorite Quote</h2>
            <p>"I don't care, let's use jQuery"</p>
            <h2>Favorite Short Command</h2>
            <p>ALT + TAB</p>
        </div>
        <div class="small-12 git">
            <i class="fa fa-github" aria-hidden="true"></i>
            <a href="https://github.com/patryk7rybaczek">patryk7rybaczek</a>
        </div>
    </div>

    <!-- About the Dev -->
    <div class="small-12 about-container" id="ida">
        <div class="small-12 head">
            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
            <h2>Ida Englund</h2>
            <p>Web Developer</p>
        </div>
        <div class="small-12 info">
            <h2>Favorite Movie</h2>
            <p>Remember the titans</p>
            <h2>Favorite Quote</h2>
            <p>"The question is not, can they reason?, nor can they talk? but, can they suffer?"</p>
            <h2>Favorite Short Command</h2>
            <p>CMD + Z</p>
        </div>
        <div class="small-12 git">
            <i class="fa fa-github" aria-hidden="true"></i>
            <a href="https://github.com/idaenglund">idaenglund</a>
        </div>
    </div>

    <!-- About the Dev -->
    <div class="small-12 about-container" id="laya">
        <div class="small-12 head">
            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
            <h2>Laya Sadegh</h2>
            <p>Web Developer</p>
        </div>
        <div class="small-12 info">
            <h2>Favorite Movie</h2>
            <p>Le fabuleux destin d’Amélie Poulain</p>
            <h2>Favorite Quote</h2>
            <p>"Insanity: doing the same thing over and over again and expecting different results."</p>
            <h2>Favorite Short Command</h2>
            <p>CMD + Z</p>
        </div>
        <div class="small-12 git">
            <i class="fa fa-github" aria-hidden="true"></i>
            <a href="https://github.com/lalaya">lalaya</a>
        </div>
    </div>

    <!-- About the Dev -->
    <div class="small-12 about-container" id="pontus">
        <div class="small-12 head">
            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
            <h2>Pontus Sarland</h2>
            <p>Web Developer</p>
        </div>
        <div class="small-12 info">
            <h2>Favorite Movie</h2>
            <p>Inception</p>
            <h2>Favorite Quote</h2>
            <p>"Don't you want to take a leap of faith? Or become an old man, filled with regret, waiting to die alone!"</p>
            <h2>Favorite Short Command</h2>
            <p>CTRL + V</p>
        </div>
        <div class="small-12 git">
            <i class="fa fa-github" aria-hidden="true"></i>
            <a href="https://github.com/PontusSarland88">PontusSarland88</a>
        </div>
    </div>

    <!-- About the Dev -->
    <div class="small-12 about-container" id="eleonor">
        <div class="small-12 head">
            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
            <h2>Eleonor Bergqvist</h2>
            <p>Web Developer</p>
        </div>
        <div class="small-12 info">
            <h2>Favorite Movie</h2>
            <p>Forrest Gump</p>
            <h2>Favorite Quote</h2>
            <p>"Life isn't about finding yourself. Life is about creating yourself"</p>
            <h2>Favorite Short Command</h2>
            <p>CMD + S</p>
        </div>
        <div class="small-12 git">
            <i class="fa fa-github" aria-hidden="true"></i>
            <a href="https://github.com/eleonorbergvist">eleonorbergvist</a>
        </div>
    </div>
    <div class="mobile-btn-quit" data-close>
        <i class="fa fa-times" aria-hidden="true"></i>
    </div>
</div>