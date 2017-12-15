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
    <form action="" method="post">
        <?php echo csrf_field(); ?>
        <input type="text" name="title">
        
        <input type="text" name="plot">

        <input type="text" name="playtime">

        <input type="text" name="poster">

        <div class="js-actor-list">
            <h3 style="color: white;">ACTORS</h3>

            <div>
                <lable style="color: white;">EXISTING ACTOR</lable>
                <select class="js-example-basic-single js-existing-actor-chooser" name="state">
                  @foreach ($actors as $actor)
                    <option value="{{ $actor["id"] }}">{{ $actor["name"] }}</option>
                  @endforeach
                </select>
                <button class="button secondary js-existing-actor-add">Add</button>
            <div>

            <div>
                <lable style="color: white;">NEW ACTOR</lable>
                <input type="text" name="new_actor">
                <button class="button secondary">Add</button>
            <div>
        </div>

        <div>
          <ul class="js-my-actors-list">
          </ul>
        </div> 

        <button class="button" type="submit" value="BOBBY!">Submit</button>
    </form>
    
        
    
</body>

@endsection 