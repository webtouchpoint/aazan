@if(count($ebooks) > 0)
	<div class="row">
		@foreach($ebooks as $ebook)
			<div class="col-xs-12 col-lg-4">
				<h2>{{ $ebook->title }}	<span class="badge">Ebook</span></h2>
				<p>{{ $ebook->description }}</p>
				<p><a class="btn btn-default" href="{{ asset('storage/ebooks/'.$ebook->filename) }}" role="button">Read more &raquo;</a></p>
			</div><!--/.col-xs-6.col-lg-4-->
		@endforeach
	</div><!--/row-->
@endif