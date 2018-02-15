<nav class="navbar navbar-static-top navbar-inverse">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">
				<!-- <strong>{{ config('app.name') }}</strong> -->
				 <img src="{{ asset('/images/brand.png') }}" height="30" alt="Aazan">
			</a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<!-- Left Side Of Navbar -->
			<ul class="nav navbar-nav">
				<li class="{{ set_active('/') }}"><a href="/">Home</a></li>
				<li class="{{ set_active('ebooks') }}"><a href="{{ route('pages.ebooks') }}">Ebooks</a></li>
				<li class="{{ set_active('blog') }} {{ set_active('blog/*') }}"><a href="{{ route('blog.index') }}">Blog</a></li>
				<li class="{{ set_active('videos') }}"><a href="{{ route('pages.videos') }}">Videos</a></li>
				<li class="{{ set_active('about') }}"><a href="{{ route('pages.about') }}">About</a></li>
				<li class="{{ set_active('contact') }}"><a href="{{ route('pages.contact') }}">Contact</a></li>
			</ul><!-- ./ Left Side Of Navbar -->

			<!-- Right Side Of Navbar -->
	        <ul class="nav navbar-nav navbar-right">
	            <!-- Authentication Links -->
	            @guest
	                <li class="{{ set_active('login') }}"><a href="{{ route('login') }}">Login</a></li>
	                <li class="{{ set_active('register') }}"><a href="{{ route('register') }}">Register</a></li>
	            @else
	                <li class="dropdown">
	                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
	                        {{ Auth::user()->name }} <span class="caret"></span>
	                    </a>

	                    <ul class="dropdown-menu">
	                        <li>
	                            <a href="{{ route('logout') }}"
	                                onclick="event.preventDefault();
	                                         document.getElementById('logout-form').submit();">
	                                Logout
	                            </a>

	                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                                {{ csrf_field() }}
	                            </form>
	                        </li>
	                    </ul>
	                </li>
	            @endguest
	        </ul><!-- ./ Right Side Of Navbar -->
		</div><!-- /.nav-collapse -->
	</div><!-- /.container -->
</nav><!-- /.navbar -->