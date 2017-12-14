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


        <input type="text" name="actor[]" value="1">
        <input type="text" name="actor[]" value="2">
        <input type="text" name="actor[]" value="3">

        <input type="text" name="new_actor[]" value="Tom Waits1">
        <input type="text" name="new_actor[]" value="Frank Zappa1">
        <input type="text" name="new_actor[]" value="Bobby1">

        <button class="button" type="submit" value="BOBBY!">Submit</button>
    </form>
    <div>

    </div>
</body>

@endsection 