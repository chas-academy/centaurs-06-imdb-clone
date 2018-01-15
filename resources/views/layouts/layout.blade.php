<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
   @include('../includes.head')
</head>
	<body>
    <?php if(Auth::check()) {
        $user = Auth::user();
    } ?>

    @yield('content')

	@includeWhen((Request::url() === '/adminpanel'), '../includes.admin-offcanvas');
	@includeWhen(!(Request::url() === '/adminpanel'), '../includes.off-canvas');

    @include('../includes.scripts')
    </body>
</html>
