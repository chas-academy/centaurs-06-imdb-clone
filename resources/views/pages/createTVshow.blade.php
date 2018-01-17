@extends('layouts.layout') 
@section('content')

<div id="outerContentContainer">
    @include('includes.messages')
    @include('includes.errors')
    <div id="innerContentContainer">

        <form data-abide novalidate class="adminform" action="" method="post" enctype="multipart/form-data">            
            <div class="small-12 columns">
            <h1>Create movie</h1>

              <?php echo csrf_field(); ?> 

            <label>
                <input type="text" name="title" placeholder="TV show title" required>
                <span class="form-error">Please fill in Tv Show title.</span>
            </label>

            <label for="uploadPoster" class="button">Upload poster</label>
                <input type="file" name="poster" id="uploadPoster" class="show-for-sr" required/>
                <span class="form-error">Please add TV show poster.</span>
            </label>

            <label> 
                <select multiple class="multi-select" name="genre" required>
                @foreach ($genres as $genre)
                    <option value="{{ $genre["id"] }}">{{ $genre["genre_name"] }}</option>
                @endforeach
                </select>
                <span class="form-error">Don't forget to add genre.</span>
            </label> 
            
            <label>
                <select class="release-year" name="releaseyear" required>
                @foreach ($releaseyears as $releaseyear)
                    <option value="{{ $releaseyear }}">{{ $releaseyear }}</option>
                @endforeach
                </select>
                <span class="form-error">Add release year.</span>
            </label>

            <label>
                <input type="number" name="playtimeMins" placeholder="Playtime minutes" required>
                <span class="form-error">Add playtime.</span>
            </label>
 
            <label>
                <textarea cols="30" rows="10" name="plot" placeholder="Movie plot"></textarea>
                <span class="form-error">
                Don't forget to write the TV show plot.
                </span>

            </label>

                @include('partials.personlist', ['persons' => $actors, 'personType' => 'actor'])
                @include('partials.personlist', ['persons' => $directors, 'personType' => 'director'])
                @include('partials.personlist', ['persons' => $producers, 'personType' => 'producer'])
                
                <button class="button" type="submit" value="submit">Create TV</button>
            
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