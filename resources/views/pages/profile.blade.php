
<!-- This page need some serious styling and maybe include it into another page? -->

<img src="/img/avatars/{{ $user->avatar }}" style="width:50px; height:50px; border-radius:50%;">
<h2>Hello dear {{ $user->name }}</h2>
<form enctype="multipart/form-data" action="/profile" method="POST">
    <label>Update Profile Picture</label>
    <input type="file" name="avatar">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" class="button">
</form>
    <li>
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>