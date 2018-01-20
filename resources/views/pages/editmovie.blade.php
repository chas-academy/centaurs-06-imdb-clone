@extends('layouts.layout') 
@section('content')

<div class="outerContentContainer">
    @include('includes.messages')
    @include('includes.errors')
    <div class="innerContentContainer">
        <form class="adminform" action="" method="post" enctype="multipart/form-data">

            <div class="small-12 columns">
                <h1>Edit movie</h1>

                {{ csrf_field() }}

                <label></label>
                <input class="inputfield-grey-placeholder" type="text" name="title" placeholder="Movie title" value="{{ $movie->title }}" required />
                <span class="form-error">Please fill in movie title.</span>

                <label for="uploadPosterAgain" class="button">Upload a new poster</label>
                <input id="uploadPosterAgain" type="file" class="uploadPoster show-for-sr" name="poster" required />

                <div class="posterThumbnailWrapper">
                    <p class="posterThumbnailText">This is your old poster:</p>
                    <img class="posterThumbnailImg" src="{{ App\Http\Models\Movie::getPosterUrl($movie->poster) }}" />
                </div>
                <div class="foundation-bottom-margin">
                    <label></label> 
                    <select class="multi-select js-example-placeholder-multiple js-states form-control select2-full-width" name="genres[]" multiple="multiple" required>
                        @foreach ($genres as $genre)
                            <option value="{{ $genre["id"] }}" @if (in_array($genre["id"], $activeGenreIds)) {{ "selected" }} @endif>{{ $genre["genre_name"] }}</option>
                        @endforeach
                    </select>
                    <span class="form-error">Don't forget to add genre.</span>
                </div>

                <label></label>
                <select class="release-year searchfield-grey-placeholder" name="releaseyear" required>
                    @foreach ($releaseyears as $releaseyear)
                        <option value="{{ $releaseyear }}" @if ($releaseyear === (int) date('Y', $movie->year)) {{ "selected" }} @endif>{{ $releaseyear }}</option>
                  @endforeach
                </select>
                <span class="form-error">Add release year.</span>

                <label></label>
                <input class="inputfield-grey-placeholder" type="number" name="playtimeMins" placeholder="Playtime minutes" value="{{ $movie->playtime }}" required>
                <span class="form-error">Add playtime.</span>

                <label></label>
                <textarea class="inputfield-grey-placeholder" cols="30" rows="10" name="plot" placeholder="Movie plot" required>{{ $movie->plot }}</textarea>
                <span class="form-error">Don't forget to write the movie plot.</span>

                @include('partials.personlist', ['choices' => $actors, 'type' => 'actor', 'initial' => $initialActors])
                @include('partials.personlist', ['choices' => $directors, 'type' => 'director', 'initial' => $initialDirectors])
                @include('partials.personlist', ['choices' => $producers, 'type' => 'producer', 'initial' => $initialProducers])

                <button class="button" type="submit">Update movie</button>
            </div>
        </form>
    </div>
</div>
@endsection 

@section('page-scripts')
<script>
    $(document).ready(function() {
        // Select 2 script foundation
        $('.multi-select').select2({
            placeholder: "Choose Genre",
            theme: "default select2-container--full-width select2-container--large",
        });

        $('.personproducer').select2({
            placeholder: "Choose an existing producer", 
            theme: "default select2-container--with-add-button select2-container--large",
        });

        $('.persondirector').select2({
            placeholder: "Choose an existing director", 
            theme: "default select2-container--with-add-button select2-container--large",
        });

        $('.personactor').select2({
            placeholder: "Choose an existing actor", 
            theme: "default select2-container--with-add-button select2-container--large",
        });
    });
</script>

@endsection 