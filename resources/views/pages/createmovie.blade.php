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
        <select multiple class="multi-select" name="genre" placeholder="choose genre">
        @foreach ($genres as $genre)
            <option value="{{ $genre["id"] }}">{{ $genre["genre_name"] }}</option>
        @endforeach
        </select>
        </label> 

       

       <!-- <div class="grid-0 grid-padding-5">
        <fieldset>
        <legend class="checkbox">Genre</legend>
                <input class="checkbox" type="checkbox"><label class="checkbox" for="checkbox1">Action</label>
                <input class="checkbox" type="checkbox"><label class="checkbox" for="checkbox2">Adventure</label>
                <input class="checkbox" type="checkbox"><label class="checkbox" for="checkbox3">Animation</label>
                <input class="checkbox" type="checkbox"><label class="checkbox" for="checkbox4">Comedy</label>
                <input class="checkbox" type="checkbox"><label class="checkbox" for="checkbox5">Crime</label>
                <input class="checkbox" type="checkbox"><label class="checkbox" for="checkbox6">Documentary</label>
                <input class="checkbox" type="checkbox"><label class="checkbox" for="checkbox7">Drama</label>
                <input class="checkbox" type="checkbox"><label class="checkbox" for="checkbox8">Family</label>
                <input class="checkbox" type="checkbox"><label class="checkbox" for="checkbox9">Fantasy</label>
                <input class="checkbox" type="checkbox"><label class="checkbox" for="checkbox10">History</label>
                <input class="checkbox" type="checkbox"><label class="checkbox" for="checkbox11">Horror</label>
                <input class="checkbox" type="checkbox"><label class="checkbox" for="checkbox12">Music</label>
                <input class="checkbox" type="checkbox"><label class="checkbox" for="checkbox13">Mystery</label>
                <input class="checkbox" type="checkbox"><label class="checkbox" for="checkbox14">Romance</label>
                <input class="checkbox" type="checkbox"><label class="checkbox" for="checkbox15">Science Fiction</label>
                <input class="checkbox" type="checkbox"><label class="checkbox" for="checkbox16">TV movie</label>
                <input class="checkbox" type="checkbox"><label class="checkbox" for="checkbox17">Thriller</label>
                <input class="checkbox" type="checkbox"><label class="checkbox" for="checkbox18">War</label>
                <input class="checkbox" type="checkbox"><label class="checkbox" for="checkbox18">Western</label>
        </fieldset>
        </div>
-->
    
        <!-- <select class="js-example-basic-single" name="releaseyear"> -->
        <label> Select Year
        <select>
        @foreach ($releaseyears as $releaseyear)
            <option value="{{ $releaseyear }}">{{ $releaseyear }}</option>
        @endforeach
        </select>
        </label>

        <label>
        <input type="number" name="playtimeMins" placeholder="Playtime minutes">
        </label>

        <label>
        <textarea cols="30" rows="10" placeholder="Movie plot">
        </textarea>
        </label>

        @include('partials.personlist', ['persons' => $actors, 'personType' => 'actor'])
        @include('partials.personlist', ['persons' => $directors, 'personType' => 'director'])
        @include('partials.personlist', ['persons' => $producers, 'personType' => 'producer'])
        
        <button class="button" type="submit" value="BOBBY!">Submit</button>
    
    </div>
</form>
    
@endsection 

@section('page-scripts')

<script>

$(document).ready(function() {
    // Select 2 script foundation
    $('.multi-select').select2();
});

</script>

@endsection