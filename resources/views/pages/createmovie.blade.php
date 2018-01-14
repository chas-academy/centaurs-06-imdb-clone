@extends('layouts.admin') 
@section('content')

<form class="adminform" action="" method="post" enctype="multipart/form-data">
    <div class="small-12 columns">
    <h1>Create movie</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <?php echo csrf_field(); ?>

    <input type="text" name="title" placeholder="Movie title">

    <label for="uploadPoster" class="button">Upload poster</label>
    <input type="file" name="poster" id="uploadPoster" class="show-for-sr" required/>

    <label> 
        <select multiple class="multi-select" name="genre">
        @foreach ($genres as $genre)
            <option value="{{ $genre["id"] }}">{{ $genre["genre_name"] }}</option>
        @endforeach
        </select>
    </label> 
    
        <!-- <select class="js-example-basic-single" name="releaseyear"> -->
    <label>
    <select multiple class="release-year" name="genre">
        @foreach ($releaseyears as $releaseyear)
            <option value="{{ $releaseyear }}">{{ $releaseyear }}</option>
        @endforeach
        </select>
    </label>

    <label>
        <input type="number" name="playtimeMins" placeholder="Playtime minutes">
    </label>

    <label>
        <textarea cols="30" rows="10" placeholder="Movie plot"></textarea>
    </label>

        @include('partials.personlist', ['persons' => $actors, 'personType' => 'actor'])
        @include('partials.personlist', ['persons' => $directors, 'personType' => 'director'])
        @include('partials.personlist', ['persons' => $producers, 'personType' => 'producer'])
        
        <button class="button" type="submit" value="BOBBY!">Create Movie</button>
    
    </div>
</form>
    
@endsection 

@section('page-scripts')

<script>

$(document).ready(function() {
    // Select 2 script foundation
    $('.multi-select').select2({
        placeholder: "Choose Genre"
    });

    $('.release-year').select2({
        placeholder: "Release Year"
    }); 
});

</script>

@endsection