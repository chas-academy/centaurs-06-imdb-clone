@if (session()->has('message'))
    <section id="statusMsg">
    <p>{!! session()->get('message') !!}</p>
    </section>
@endif