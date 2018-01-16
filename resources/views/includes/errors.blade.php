@if (session()->has('errors') && count($errors) > 0)
    <section id="statusMsgError">
    <ul>
        @foreach($errors->all() as $error)
            <li>{!! $error !!}</li>
        @endforeach
    </ul>
    </section>
@endif