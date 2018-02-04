
@extends('layouts.master')

@section('content')
	@if($post->image)
		<img src="{{ asset('storage/posts/images/'.$post->image) }}" alt="{{ $post->title }}" class="img-responsive">
	@endif
    <h1>{{ $post->title }}</h1>
    <h5>{{ $post->published_at->format('M jS Y g:ia') }}</h5>
    <hr>
    {!! $post->content !!}
    <hr>
    <div class="tags-wrapper">       
        <ul class="list-inline">
            @foreach($post->tags as $tag)
                <li>
                    <a href="{{ url('posts/tags/'.$tag->slug) }}">
                        {{ $tag->name}}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="back-button-wrapper">
       <button class="btn btn-default" onclick="history.go(-1)">
          « Back
        </button> 
    </div>
@endsection

