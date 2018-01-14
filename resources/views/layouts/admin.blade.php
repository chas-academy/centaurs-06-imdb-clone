<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
   @include('../includes.head')
</head>
	<body>
    <?php if(Auth::check()) {
        $user = Auth::user();
    } ?>

    <div id="outerContentContainer">
        <div id="innerContentContainer">
            @yield('content')
        </div>
    </div>

	@include('../includes.off-canvas')

    @include('../includes.scripts')
    
    @yield('page-scripts')
    </body>
</html>
