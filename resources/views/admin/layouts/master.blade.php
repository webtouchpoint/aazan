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
	<link href="{{ asset('libs/datatable/datatable.min.css') }}" rel="stylesheet">
	<link href="{{ asset('libs/select2/select2.min.css') }}" rel="stylesheet">
	<link href="{{ asset('libs/trix/trix.css') }}" rel="stylesheet">

	@yield('styles')
</head>
<body style="padding-top: 70px;">
	@include('admin.layouts.nav')
	<div class="container-fluid" id="app">
		<div class="row">
			<div class="col-md-12">
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
		</div><!--/row-->

	</div><!--/.container-->

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('libs/datatable/datatable.min.js') }}"></script>
	<script src="{{ asset('libs/select2/select2.min.js') }}"></script>
	<script>
		$('#flash-overlay-modal').modal();
		$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
	</script>
	@yield('scripts')
</body>
</html>
