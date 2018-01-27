<nav class="navbar navbar-fixed-top navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ route('ebooks.index') }}">
				<strong>{{ config('app.name') }}</strong> - <small>Administration</small>
			</a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<!-- Left Side Of Navbar -->
			<ul class="nav navbar-nav">
				<li><a href="{{ url('/') }}" target="_blank">Go to website</a></li>
				<li class="{{ set_active('admin/ebooks') }} {{ set_active('admin/ebooks/*') }}"><a href="{{ route('ebooks.index') }}">EBooks</a></li>
				<li class="{{ set_active('admin/posts') }} {{ set_active('admin/posts/*') }}"><a href="{{ route('posts.index') }}">Posts</a></li>
				<li class="{{ set_active('admin/videos') }} {{ set_active('admin/videos/*') }}"><a href="{{ route('videos.index') }}">Videos</a></li>

				<li class="{{ set_active('admin/tags') }} {{ set_active('admin/tags/*') }}"><a href="{{ route('tags.index') }}">Tags</a></li>
			</ul><!-- ./ Left Side Of Navbar -->

			<!-- Right Side Of Navbar -->
	        <ul class="nav navbar-nav navbar-right">
	            <!-- Authentication Links -->
	            @auth
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