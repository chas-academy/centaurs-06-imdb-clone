@extends('layouts.layout') 
@section('content')

<div id="outerContentContainer">
    @include('includes.messages')
    @include('includes.errors')
    <div id="innerContentContainer">

        <div class="small-12 columns">
        <h1>Edit Movie</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <input type="text" name="title" placeholder="Movie title" value="{{ $movie->title }}">
            <input type="file" name="poster" placeholder="Browse for a poster image">
            <div>
                <p>Din gamla filmposter:</p>
                <img style="width: 50px; height: 50px;" src="{{ asset('storage/posters/'.$movie->poster) }}" />
            </div>
            <select class="js-example-basic-single" name="genre">
                @foreach ($genres as $genre)
                    <option value="{{ $genre["id"] }}" @if ($genre["id"] === $activeGenre->id) {{ "selected" }} @endif>{{ $genre["genre_name"] }}</option>
            @endforeach
            </select>


            <select class="js-example-basic-single" name="releaseyear">
                @foreach ($releaseyears as $releaseyear)
                    <option value="{{ $releaseyear }}" @if ($releaseyear === (int) date('Y', $movie->year)) {{ "selected" }} @endif>{{ $releaseyear }}</option>
            @endforeach
            </select>

            <input type="text" name="playtimeMins" placeholder="Minutes" value="{{ $movie->playtime }}">

            <input type="text" name="plot" placeholder="Movie plot" value="{{ $movie->plot }}">

            @include('partials.personlist', ['choices' => $actors, 'type' => 'actor', 'initial' => $initialActors])
            @include('partials.personlist', ['choices' => $directors, 'type' => 'director', 'initial' => $initialDirectors])
            @include('partials.personlist', ['choices' => $producers, 'type' => 'producer', 'initial' => $initialProducers])

            <button class="button" type="submit" value="submit">Submit</button>
        </form>

@endsection 