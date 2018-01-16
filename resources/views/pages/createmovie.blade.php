@extends('layouts.layout') 
@section('content')

<div id="outerContentContainer">
    <div id="innerContentContainer">

        <form data-abide novalidate class="adminform" action="" method="post" enctype="multipart/form-data">
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

            <label>
                <input type="text" name="title" placeholder="Movie title" required>
                <span class="form-error">
                Please fill in movie title.
                </span>
            </label>

            <label for="uploadPoster" class="button">Upload poster</label>
                <input type="file" name="poster" id="uploadPoster" class="show-for-sr" required/>
                <span class="form-error">
                Please add movie poster.
                </span>
            </label>

            <label> 
                <select multiple class="multi-select" name="genre" required>
                @foreach ($genres as $genre)
                    <option value="{{ $genre["id"] }}">{{ $genre["genre_name"] }}</option>
                @endforeach
                </select>
                <span class="form-error">
                Don't forget to add genre.
                </span>
            </label> 
            
                <!-- <select class="js-example-basic-single" name="releaseyear"> -->
                <!-- Add placeholder -->
            <label>
                <select class="release-year" name="releaseyear" required>
                @foreach ($releaseyears as $releaseyear)
                    <option value="{{ $releaseyear }}">{{ $releaseyear }}</option>
                @endforeach
                </select>
                <span class="form-error">
                Add release year. 
                </span>
            </label>

            <label>
                <input type="number" name="playtimeMins" placeholder="Playtime minutes" required>
                <span class="form-error">
                Add playtime. 
                </span>
            </label>

            <label>
                <textarea cols="30" rows="10" placeholder="Movie plot"></textarea>
                <!-- <span class="form-error">
                Don't forget to write the movie plot.
                </span> -->
            </label>

                @include('partials.personlist', ['persons' => $actors, 'personType' => 'actor'])
                @include('partials.personlist', ['persons' => $directors, 'personType' => 'director'])
                @include('partials.personlist', ['persons' => $producers, 'personType' => 'producer'])
                
                <button class="button" type="submit" value="submit">Create Movie</button>
            
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
            placeholder: "Choose Genre"
        });
    });
</script>
@endsection