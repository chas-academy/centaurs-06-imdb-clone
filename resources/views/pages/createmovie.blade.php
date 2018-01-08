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
    <form action="" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <input type="text" name="title" placeholder="Movie title">
        <input type="file" name="poster" placeholder="Browse for a poster image">
        <select class="js-example-basic-single" name="genre">
          @foreach ($genres as $genre)
            <option value="{{ $genre["id"] }}">{{ $genre["genre_name"] }}</option>
          @endforeach
        </select>

        <select class="js-example-basic-single" name="releaseyear">
          @foreach ($releaseyears as $releaseyear)
            <option value="{{ $releaseyear }}">{{ $releaseyear }}</option>
          @endforeach
        </select>

        <input type="text" name="playtimeMins" placeholder="Minutes">

        <input type="text" name="plot" placeholder="Movie plot">

        

        @include('partials.personlist', ['persons' => $actors, 'personType' => 'actor'])
        @include('partials.personlist', ['persons' => $directors, 'personType' => 'director'])
        @include('partials.personlist', ['persons' => $producers, 'personType' => 'producer'])

        <button class="button" type="submit" value="BOBBY!">Submit</button>
    </form>
    
</body>

@endsection 