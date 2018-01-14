@extends('layouts.layout') 
@section('content')
<body style="margin-left: 20%; color: white;">
    <h1>Lägg till en film test</h1>
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

        

        @include('partials.personlist', ['choices' => $actors, 'type' => 'actor'])
        @include('partials.personlist', ['choices' => $directors, 'type' => 'director'])
        @include('partials.personlist', ['choices' => $producers, 'type' => 'producer'])

        <button class="button" type="submit">Submit</button>
    </form>
    
</body>

@endsection 