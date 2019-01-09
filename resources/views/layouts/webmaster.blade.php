<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	@include('_partials.www.links')
	<title>Mumbai Maheshwari</title>
	@stack('page-style')
</head>
<body>
	<div class="preloader">
		<div class="preloader_image"></div>
	</div>

	<div id="canvas">
		<div id="box_wrapper">

			@include('_partials.www.navbar')
			
			@yield('page-content')
			
			@include('_partials.www.footer')

		</div>
	</div>
	
	@stack('modals')
	@include('_partials.www.scripts')
	@stack('page-script')
</body>
</html>
