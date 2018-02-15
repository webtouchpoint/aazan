@if(count($videos) > 0)
	<div class="row">
		@foreach($videos as $video)
			<div class="col-xs-12 col-lg-4">
				<h2>{{ $video->title }} <span class="badge">Video</span></h2>
				<p>{{ $video->description }}</p>
				<p><a class="btn btn-default btn-sm" href="{{ $video->link }}" role="button">Watch Now&raquo;</a></p>
			</div><!--/.col-xs-6.col-lg-4-->
		@endforeach
	</div><!--/row-->
@endif