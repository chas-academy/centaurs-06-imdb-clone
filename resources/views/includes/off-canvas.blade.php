@if(Auth::check())
    <?php $user = Auth::user(); ?>
@endif

<!-- USER MENU/SETTINGS -->
<div id="offcanvas-full-screen" class="offcanvas-full-screen" data-off-canvas="off-canvas-content" data-transition="overlap" data-content-overlay="false" data-reveal>
    <div class="offcanvas-full-screen-inner">
    <div class="small-12 flex-align-c-c">
        <img src="{{ asset('img/Logo.svg') }}" alt="Logo" class="logo hidden">
    </div>

    <!-- Only shows on desktop -->
    <header id="mobile-hide" class="row">
        <div class="small-12 header-flex-align-sb-c">
            <a href="{{ URL::to('/') }}">
                <img src="{{ asset('img/Logo.svg') }}" alt="IMDb Logo" class="logo">
            </a>
            <i class="fa fa-search search-btn" id="search-btn-desktop" aria-hidden="true" data-toggle="search-desktop search-btn-desktop search-exit-btn-desktop"
                data-toggler=".hidden"></i>
            <i class="fa fa-times search-exit-btn" id="search-exit-btn-desktop" aria-hidden="true" data-toggle="search-desktop search-btn-desktop search-exit-btn-desktop"
                data-toggler=".visible"></i>
        </div>
        <div id="search-desktop" class="small-12 header-flex-align-sb-c" data-toggler=".visible">
            <form class="small-12 search fast" data-animate="fade-in fade-out" method="GET" action="/search">
                <input type="text" class="search-input" placeholder="Find Movies, Tv Shows and more..." name="q">
                <button type="submit">
                    <i class="fa fa-search search-btn" id="search-btn-desktop" aria-hidden="true"></i>
                </button>
            </form>
        </div>
        <div class="small-12 header-flex-align-sb-c">
            <select id="sortByGenreDesktop" class="js-example-basic-single js-states form-control" name="states[]" id="id_label_single">
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

    <ul class="vertical menu navigation" data-drilldown>
        @if(!Auth::check())
            <!-- Sign in -->
            <li>
                <a id="sign-in" href="#">Sign In</a>
                <ul class="menu vertical nested">
                    <li>
                        <form data-abide novalidate class="small-12" id="sign-in-f" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <label>
                                <input type="email" name="email" placeholder="Email" required>
                                <span class="form-error">Invalid email.</span>
                            </label>

                            <label>
                                <input type="password" name="password" placeholder="Password" required>
                                <span class="form-error">Invalid password.</span>
                            </label>

                            <div class="small-12 btn">
                                <button type="submit" class="submit">Sign in</button>
                            </div>
                        </form>
                    </li>
                    <li>
                        <a id="forgot-pwd" href="#">Forgot your password?</a>
                        <ul class="menu vertical nested">
                            <li>
                                <!-- Forgot password -->
                                <div class="col-md-8 col-md-offset-4">
                                    @if (!Auth::check())
                                        <div class="small-12 flex-align-fd-c">

                                            <!-- Reset password link by email -->
                                            <form id="password-form" class="small-12" method="POST" action="{{ route('password.email') }}" data-toggler=".visible" data-animate="fade-in fade-out">
                                                {{ csrf_field() }}
                                                <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
                                                <div class="small-12 btn reset-pwd-btn">
                                                    <button type="submit" class="reset-pwd">Send password reset link</button>
                                                </div>
                                            </form>

                                        </div>

                                    @endif
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <!-- Register new user -->
            <li>
                <a id="sign-up" href="#">Create your account</a>
                <ul class="menu vertical nested">
                    <li>
                        <form data-abide novalidate class="small-12" id="sign-up-f" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
                            <label>
                                <input type="text" name="name" placeholder="Name" required>
                                <span class="form-error">Please fill in name.</span>
                            </label>

                            <label>
                                <input type="email" name="email" placeholder="Email" required>
                                <span class="form-error">Invalid email.</span>
                            </label>

                            <label>
                                <input type="password" name="password" placeholder="Password" required>
                                <span class="form-error">Fill in password, must be atleast 6 characters long.</span>
                            </label>

                            <label>
                                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                                <span class="form-error">Please confirm password.</span>
                            </label>

                            <div class="small-12 btn">
                                <button type="submit" class="submit">Create Account</button>
                            </div>
                        </form>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    Curious about us?
                </a>
                <ul class="menu vertical nested">
                <li>
                    <!-- ABOUT DEVS -->
                    <div class="fullscreen-container">
                        <!-- Head of About Devs -->
                        <div class="small-12 head">
                            <h3>Developers</h3>
                            <p>Click the name for more information</p>
                        </div>
                        <!-- The list of Devs -->
                        <li>
                            <a href="#victor">Victor Ciavarella</a>
                            <ul class="menu vertical nested developer">
                                <li>
                                    <!-- About the Dev -->
                                    <div class="small-12 about-container" id="victor">
                                        <div class="small-12 head">
                                            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
                                            <h2 class="personal-info">Victor Ciavarella</h2>
                                            <p>Web Developer</p>
                                        </div>
                                        <div class="small-12 info">
                                            <h2 "personal-info">Favorite Movie</h2>
                                            <p>Godfather</p>
                                            <h2 "personal-info">Favorite Quote</h2>
                                            <p>First make it work, then make it pretty</p>
                                            <h2 "personal-info">Favorite Short Command</h2>
                                            <p>CMD + Z</p>
                                        </div>
                                        <div class="small-12 git">
                                            <i class="fa fa-github" aria-hidden="true"></i>
                                            <a href="https://github.com/Ciavarella">Ciavarella</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#andreas">Andreas Sjölund</a>
                            <ul class="menu vertical nested developer">
                                <li>
                                    <!-- About the Dev -->
                                    <div class="small-12 about-container" id="andreas">
                                        <div class="small-12 head">
                                            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
                                            <h2 "personal-info">Andreas Sjölund</h2>
                                            <p>Web Developer</p>
                                        </div>
                                        <div class="small-12 info">
                                            <h2 "personal-info">Favorite Movie</h2>
                                            <p>Pulp Fiction</p>
                                            <h2 "personal-info">Favorite Quote</h2>
                                            <p>"No man, they got the metric system. They wouldn't know what the fuck a Quarter Pounder is"</p>
                                            <h2 "personal-info">Favorite Short Command</h2>
                                            <p>CMD + A DEL</p>
                                        </div>
                                        <div class="small-12 git">
                                            <i class="fa fa-github" aria-hidden="true"></i>
                                            <a href="https://github.com/Andreas-sjolund-chas">Andreas-sjolund-chas</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#patryk">Patryk Rybaczek</a>
                            <ul class="menu vertical nested developer">
                                <li>
                                    <!-- About the Dev -->
                                    <div class="small-12 about-container" id="patryk">
                                        <div class="small-12 head">
                                            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
                                            <h2 "personal-info">Patryk Rybaczek</h2>
                                            <p>Web Developer</p>
                                        </div>
                                        <div class="small-12 info">
                                            <h2 "personal-info">Favorite Movie</h2>
                                            <p>Menace II Society</p>
                                            <h2 "personal-info">Favorite Quote</h2>
                                            <p>"I don't care, let's use jQuery"</p>
                                            <h2 "personal-info">Favorite Short Command</h2>
                                            <p>ALT + TAB</p>
                                        </div>
                                        <div class="small-12 git">
                                            <i class="fa fa-github" aria-hidden="true"></i>
                                            <a href="https://github.com/patryk7rybaczek">patryk7rybaczek</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#ida">Ida Englund</a>
                            <ul class="menu vertical nested developer">
                                <li>
                                    <!-- About the Dev -->
                                    <div class="small-12 about-container" id="ida">
                                        <div class="small-12 head">
                                            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
                                            <h2 "personal-info">Ida Englund</h2>
                                            <p>Web Developer</p>
                                        </div>
                                        <div class="small-12 info">
                                            <h2 "personal-info">Favorite Movie</h2>
                                            <p>Remember the titans</p>
                                            <h2 "personal-info">Favorite Quote</h2>
                                            <p>"The question is not, can they reason?, nor can they talk? but, can they suffer?"</p>
                                            <h2 "personal-info">Favorite Short Command</h2>
                                            <p>CMD + Z</p>
                                        </div>
                                        <div class="small-12 git">
                                            <i class="fa fa-github" aria-hidden="true"></i>
                                            <a href="https://github.com/idaenglund">idaenglund</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#laya">Laya Sadegh</a>
                            <ul class="menu vertical nested developer">
                                <li>
                                    <!-- About the Dev -->
                                    <div class="small-12 about-container" id="laya">
                                        <div class="small-12 head">
                                            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
                                            <h2 "personal-info">Laya Sadegh</h2>
                                            <p>Web Developer</p>
                                        </div>
                                        <div class="small-12 info">
                                            <h2 "personal-info">Favorite Movie</h2>
                                            <p>Le fabuleux destin d’Amélie Poulain</p>
                                            <h2 "personal-info">Favorite Quote</h2>
                                            <p>"Insanity: doing the same thing over and over again and expecting different results."</p>
                                            <h2 "personal-info">Favorite Short Command</h2>
                                            <p>CMD + Z</p>
                                        </div>
                                        <div class="small-12 git">
                                            <i class="fa fa-github" aria-hidden="true"></i>
                                            <a href="https://github.com/lalaya">lalaya</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#pontus">Pontus Sarland</a>
                            <ul class="menu vertical nested developer">
                                <li>
                                    <!-- About the Dev -->
                                    <div class="small-12 about-container" id="pontus">
                                        <div class="small-12 head">
                                            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
                                            <h2 "personal-info">Pontus Sarland</h2>
                                            <p>Web Developer</p>
                                        </div>
                                        <div class="small-12 info">
                                            <h2 "personal-info">Favorite Movie</h2>
                                            <p>Inception</p>
                                            <h2 "personal-info">Favorite Quote</h2>
                                            <p>"Don't you want to take a leap of faith? Or become an old man, filled with regret, waiting to die alone!"</p>
                                            <h2 "personal-info">Favorite Short Command</h2>
                                            <p>CTRL + V</p>
                                        </div>
                                        <div class="small-12 git">
                                            <i class="fa fa-github" aria-hidden="true"></i>
                                            <a href="https://github.com/PontusSarland88">PontusSarland88</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#eleonor">Eleonor Bergqvist</a>
                            <ul class="menu vertical nested developer">
                                <li>
                                    <!-- About the Dev -->
                                    <div class="small-12 about-container" id="eleonor">
                                        <div class="small-12 head">
                                            <i class="fa fa-user-circle-o personal" aria-hidden="true"></i>
                                            <h2 "personal-info">Eleonor Bergqvist</h2>
                                            <p>Web Developer</p>
                                        </div>
                                        <div class="small-12 info">
                                            <h2 "personal-info">Favorite Movie</h2>
                                            <p>Forrest Gump</p>
                                            <h2 "personal-info">Favorite Quote</h2>
                                            <p>"Life isn't about finding yourself. Life is about creating yourself"</p>
                                            <h2 "personal-info">Favorite Short Command</h2>
                                            <p>CMD + S</p>
                                        </div>
                                        <div class="small-12 git">
                                            <i class="fa fa-github" aria-hidden="true"></i>
                                            <a href="https://github.com/eleonorbergvist">eleonorbergvist</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </div>
                </li>
                </ul>
            </li>
        @endif
        <!-- Profilepage -->
        @if (Auth::check())
        <li>
            <div class="small-12" id="profile-page">
                <div id="avatar">
                    <img class="avatar" src="/img/avatars/{{ $user->avatar }}" style="width:60px; height:60px; border-radius:50%;">
                    <h2 id="user-name" class="avatar">Hi {{ $user->name }}!</h2>
                </div>
                <li id="watchlist">
                    <a class="white" href="/watchlist">Watchlist</a>
                </li>
                <li>
                    <a class="white" id="sign-in" href="#">Profile</a>
                    <!-- Profile settings -->
                    <ul class="menu vertical nested">
                        <li>
                            <a id="chg-mail">Change e-mail</a>
                            <ul class="menu vertical nested">
                                <li>
                                    <!-- Update email -->
                                    <div id="email-update">
                                        <h5>Update your account email</h5>
                                        <p>Input the new desired email you want associated with your account below</p>
                                        <form data-abide novalidate action="/email-update/{{ $user->id }}" method="POST">
                                            {{ csrf_field() }}
                                            <label>
                                                <input type="email" name="new-email" placeholder="Enter new email" required></input>
                                                <span class="form-error">Must be an email, please try again.</span>
                                            </label>
                                            <button class="button" type="submit">Confirm</button>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a id="chg-pwd">Change password</a>
                            <ul class="menu vertical nested">
                                <li>
                                    <!-- Update password -->
                                    <div id="password-update" data-toggler=".visible" data-animate="fade-in fade-out">
                                        <h5>Update your account password</h5>
                                        <p>Input the new desired password you want associated with your account below</p>
                                        <form data-abide novalidate action="/password-update/{{ $user->id }}" method="POST">
                                            {{ csrf_field() }}
                                            <label>
                                                <input type="password" name="current-password" placeholder="Enter current password" required></input>
                                                <span class="form-error">Wrong password, please try again.</span>
                                            </label>
                                            <label>
                                                <input type="password" name="new-password" placeholder="Enter new password" required></input>

                                            </label>
                                            <button class="email-btn button" type="submit">Confirm</button>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a id="add-av">Add avatar</a>
                            <ul class="menu vertical nested">
                                <li>
                                    <!-- Add profile picture -->
                                    <div id="add-avatar" aria-hidden="true" data-toggler=".visible" data-animate="fade-in fade-out">
                                        <h5>Upload an avatar</h5>
                                        <p id="delete-text">Here you can upload an avatar for your account.</p>
                                        <div class="upload-btn-wrapper">
                                            <form enctype="multipart/form-data" action="/profile" method="POST">
                                                Upload a file
                                                <input class="button" type="file" name="avatar"></input>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input class="send-pic button" type="submit" class="button">
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a id="delete-acc">Delete account</a>
                            <ul class="menu vertical nested">
                                <li>
                                    <!-- Delete account -->
                                    <div id="delete-account" data-toggler=".visible" data-animate="fade-in fade-out">
                                        <h5>Permanently delete your account</h5>
                                        <p id="delete-text">Are you sure? This action is irreversible.</p>
                                        <form>
                                            <a class="alert button" href="/delete-account/{{ $user->id }}">Delete account</a>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                @if(Auth::user()->type === 'admin')
                    <li>
                        <a class="white" id="admin-panel">Admin Panel</a>
                            <ul class="menu vertical nested">
                            <!-- Admin panel -->
                            @if(Auth::user()->type === 'admin')
                                    <!-- TODO Implement this
                                    <li>
                                        <a href="#" id="mng-user">Manage users</a>
                                        <ul class="menu vertical nested">
                                            <li>
                                            </li>
                                        </ul>
                                    </li>
                                    -->
                                    <li>
                                        <a href="#" id="mng-mov">Manage movies</a>
                                        <ul class="menu vertical nested">
                                            <!-- Admin panel : manage movies -->
                                            <li>
                                                <a href="#" id="mng-user">Search via API</a>
                                                <ul class="menu vertical nested">
                                                <li>
                                                    <!-- Search for movie in API -->
                                                    <div id="api-search-field" class="small-12 header-flex-align-sb-c" data-toggler=".visible" data-animate="fade-in fade-out">
                                                    <form class="small-12 search fast" data-animate="fade-in fade-out" method="GET" action="/search-api">
                                                        <input type="text" class="search-input" placeholder="Search movie from API..." name="q">
                                                        <button type="submit"><i class="fa fa-search search-btn" id="search-btn-desktop" aria-hidden="true"></i></button>
                                                    </form>
                                                </li>
                                            </ul>
                                            </li>
                                            <li>
                                                <a href="/createmovie" id="mng-mov">Add new movie</a>
                                            </li>
                                            <li>
                                                <a href="#" id="mng-tv">Edit movie</a>
                                            </li>
                                            <li>
                                                <a href="#" id="mng-rvws">Delete movie</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#" id="mng-tv">Manage TV shows</a>
                                        <ul class="menu vertical nested">
                                            <li>
                                                <!-- Search for tvshow in API -->
                                                <div id="api-tv-search-field" class="small-12 header-flex-align-sb-c" data-toggler=".visible" data-animate="fade-in fade-out">
                                                    <form class="small-12 search fast" data-animate="fade-in fade-out" method="GET" action="/search-tv-api">
                                                        <input type="text" class="search-input" placeholder="Search tvshow from API..." name="q">
                                                        <button type="submit">
                                                            <i class="fa fa-search search-btn" id="search-btn-desktop" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="{{ route('managereviews') }}" id="mng-rvws">Manage reviews</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('manageusers') }}" id="mng-users">Manage users</a>
                                    </li>
                            @endif
                            </ul>
                    </li>
                @endif
                <li>
                    <a class="white button" id="log-out" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </div>
        </li>
        @endif
    </ul>

    <!-- shows on desktop -->
    <footer id="mobile-hide" class="row footer-mobile">
        <div class="small-12 footer">
            <p>Centaurs Movies © 2018</p>
        </div>
    </footer>

    <div id="mobile-btn-quit" class="mobile-btn-quit" data-close>
        <i class="fa fa-times" aria-hidden="true"></i>
    </div>
</div>