@if (session()->has('error'))
    <section id="statusMsgError">
     <p>{{session()->get('error')}}</p>
     </section>
 @endif
 
 @if (isset($errors) && count($errors) > 0)
     <ul>
        @foreach($errors->all() as $error)
             <li id="statusMsgError">{!! $error !!}</li>
         @endforeach
     </ul>
 @endif 