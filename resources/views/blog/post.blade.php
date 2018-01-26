
@extends('layouts.master')

@section('content')
	@if($post->image)
		<img src="{{ asset('storage/posts/images/'.$post->image) }}" alt="{{ $post->title }}" class="img-responsive img-rounded">
	@endif
    <h1>{{ $post->title }}</h1>
    <h5>{{ $post->published_at->format('M jS Y g:ia') }}</h5>
    <hr>
    {!! $post->content !!}
    <hr>
    <button class="btn btn-primary" onclick="history.go(-1)">
      « Back
    </button>
@endsection

