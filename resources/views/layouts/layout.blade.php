<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
   @include('../includes.head')
</head>
	<body>
    

    @yield('content')

	@include('../includes.off-canvas')

    @include('../includes.scripts')
    
    @yield('page-scripts')
    </body>
</html>
