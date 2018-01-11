@extends('layouts.layout') 
@section('content')
<body>
    <h1 style="color:white">Editera en film test</h1>
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
        <input type="text" name="title" placeholder="Movie title" value="{{ $movie->title }}">
        <input type="file" name="poster" placeholder="Browse for a poster image">
        <select class="js-example-basic-single" name="genre">
            @foreach ($dbgenres as $dbgenre)
                <option value="{{ $dbgenre["id"] }}" @if ($dbgenre["id"] === $genre->id) {{"selected"}} @endif>{{ $dbgenre["genre_name"] }}</option>
          @endforeach
        </select>


        <select class="js-example-basic-single" name="releaseyear">
            @foreach ($releaseyears as $releaseyear)
                <option value="{{ $releaseyear }}" @if ($releaseyear === (int) date('Y', $movie->year)) {{"selected"}} @endif>{{ $releaseyear }}</option>
          @endforeach
        </select>

        <input type="text" name="playtimeMins" placeholder="Minutes" value="{{ $movie->playtime }}">

        <input type="text" name="plot" placeholder="Movie plot" value="{{ $movie->plot }}">

        <button class="button" type="submit" value="BOBBY!">Submit</button>
    </form>
    
</body>

@endsection 