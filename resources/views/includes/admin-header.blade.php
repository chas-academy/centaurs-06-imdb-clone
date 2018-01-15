<header id="desk-hide" class="row">
    <div class="small-12 header-flex-align-sb-c">
        <a href="{{ URL::to('/') }}"><img src="{{ asset('img/Logo.svg') }}" alt="IMDb Logo" class="logo"></a>
        @if(Auth::check())
        <div class="avatar">
        <img class="avatar" src="/img/avatars/{{ $user->avatar }}" style="width:50px; height:50px; border-radius:50%;">
        </div>
        @endif
</header>