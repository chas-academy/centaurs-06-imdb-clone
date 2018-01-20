@if (session()->has('error'))
    <section id="statusMsgError">
     <p>{{session()->get('error')}}</p>
     </section>
 @endif
 
 @if (isset($errors) && count($errors) > 0)
        @foreach($errors->all() as $error)
             <p id="statusMsgError">{!! $error !!}</p>
         @endforeach
 @endif 