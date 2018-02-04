<div class="col-xs-12 col-sm-3">
    @if ($AllNews->count())
 	  <div class="sidebar-module">
        <h3>News</h3>
        <ol class="list-unstyled">
            @foreach($AllNews as $news)
            <li>
              <a href="{{ asset('storage/news/'.$news->filename) }}" target="_blank">
                  {{ $news->title}}
                  @if($loop->first)
                     <img src="{{ asset('images/new.gif') }}" width="31" height="12"> 
                   @endif
                </a>
            </li>
            @endforeach
            <li>
                <a href="{{ route('pages.news') }}">
                  all news...
                </a>
            </li>
        </ol>
    </div>
    @endif

	 <div class="sidebar-module sidebar-module-inset">
      <h4>About</h4>
      <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
    </div>

	@if ($tags->count())
		<div class="sidebar-module">
		    <h3>Tags</h3>
		    
			<ol class="list-unstyled">
				@foreach($tags as $tag)
					<li>
						<a href="{{ url('posts/tags/'.$tag->slug) }}">
							{{ $tag->name}}
						</a>
					</li>
				@endforeach
			</ol>
	    </div>
	@endif

    <div class="sidebar-module">
      <h4>Elsewhere</h4>
      <ol class="list-unstyled">
        <li><a href="#">GitHub</a></li>
        <li><a href="#">Twitter</a></li>
        <li><a href="#">Facebook</a></li>
      </ol>
    </div>
</div><!--/.sidebar-offcanvas-->      
