@if(count($posts) > 0)
	<div id="postCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->

		<ol class="carousel-indicators">
			@foreach($posts as $post)
				@if($post->image)
					<li data-target="#postCarousel" data-slide-to="{{ $loop->index }}" class="{{ $loop->last ? 'active' : '' }}"></li>
				@endif
			@endforeach
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner">
			@foreach($posts as $post)          
				@if($post->image)
					<div class="item{{ $loop->last ? ' active' : '' }}">
					 	<a href="/blog/{{ $post->slug }}">
							<img src="{{ asset('storage/posts/images/'.$post->image) }}" alt="{{ $post->title }}">      
							<div class="carousel-caption">
								<h3>{{ $post->title }}</h3>
								<p>{{ $post->teaser }}</p>
							</div>
						</a>
					</div>
	            @endif
			@endforeach
		</div>

		<!-- Left and right controls -->
		<a class="left carousel-control" href="#postCarousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#postCarousel" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
@endif