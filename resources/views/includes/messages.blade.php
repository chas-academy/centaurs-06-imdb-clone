@if (session()->has('message'))
    <p style="color: white; font-weight: bold">{!! session()->get('message') !!}</p>
@endif