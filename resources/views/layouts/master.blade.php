<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../../favicon.ico">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
	@include('layouts.nav')
	<div class="container" id="app">
		<div class="row">
			<div class="col-xs-12 col-sm-9">
				@include('flash::message')   
		        @if(isset($vueView))
		            <component is="{{ $vueView }}" inline-template>
		        @endif
		            <div>
		                @yield('content')  
		            </div>
		        @if(isset($vueView))
		            </component>
		        @endif
			</div><!--/.col-xs-12.col-sm-9-->

			@include('layouts.sidebar')
		</div><!--/row-->

		<hr>

		@include('layouts.footer')

	</div><!--/.container-->

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}"></script>
	<script>
		$('#flash-overlay-modal').modal();
		$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
	</script>
</body>
</html>
