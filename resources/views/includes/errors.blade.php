@if (session()->has('error'))
    <p style="color: white; font-weight: bold">{{session()->get('error')}}</p>
@endif

@if (isset($errors) && count($errors) > 0)
    <ul>
        @foreach($errors->all() as $error)
            <li>{!! $error !!}</li>
        @endforeach
    </ul>
@endif