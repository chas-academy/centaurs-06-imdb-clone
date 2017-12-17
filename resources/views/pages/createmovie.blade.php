@extends('layouts.layout') 
@section('content')
<body>
    <h1 style="color:white">Lägg till en film test</h1>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="" method="post">
        <?php echo csrf_field(); ?>
        <input type="text" name="title">
        
        <input type="text" name="plot">

        <input type="text" name="playtime">

        <input type="text" name="poster">

        @include('partials.personlist', ['persons' => $actors, 'personType' => 'actor'])
        @include('partials.personlist', ['persons' => $directors, 'personType' => 'director'])
        @include('partials.personlist', ['persons' => $producers, 'personType' => 'producer'])

        <button class="button" type="submit" value="BOBBY!">Submit</button>
    </form>
    
</body>

@endsection 