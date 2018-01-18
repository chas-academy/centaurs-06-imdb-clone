@extends('layouts.layout') 
@section('content')

<div id="outerContentContainer">
    @include('includes.messages')
    @include('includes.errors')
    <div id="innerContentContainer">

        <form data-abide novalidate class="adminform" action="" method="post" enctype="multipart/form-data">            
            <div class="small-12 columns">
            <h1>Add TV show</h1>

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
  
                </select>
                <span class="form-error">Don't forget to add genre.</span>
            </label> 
            
            <label>
                <select class="release-year" name="releaseyear" required>
          
                <span class="form-error">Add release year.</span>
            </label>

            <label>
                <select class="tvshow-seasons" name="tvshow-seasons" required>
           
                </select>
            </label>

            <label>
                <select class="tvshow-seasons" name="tvshow-seasons" required>
            
                </select>
            </label>


 
            <label>
                <textarea cols="30" rows="10" name="plot" placeholder="Add TV show plot"></textarea>
                <span class="form-error">
                Don't forget to write the TV show plot.
                </span>

            </label>


                
                <button class="button" type="submit" value="submit">Create TV show</button>
            
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