
@extends('layouts.master')

@section('content')
   <h1>{{ config('blog.title') }}</h1>
    <h5>Page {{ $posts->currentPage() }} of {{ $posts->lastPage() }}</h5>
    <hr>

      @forelse ($posts as $post)
        <div class="media">
          @if($post->image)
             <div class="media-left">
                <a href="#">
                  <img src="{{ asset('storage/posts/images/'.$post->image) }}" alt="{{ $post->title }}" width="274px" height="173px">
                </a>
              </div>
            @endif
          <div class="media-body">
            <h4 class="media-heading">
             <a href="/blog/{{ $post->slug }}">{{ $post->title }}</a>
             <em>({{ $post->published_at->format('M jS Y g:ia') }})</em>
           </h4>
           {!! str_limit($post->content, 250) !!}
          </div>
        </div>

          @empty
            <h4>No posts found.</h4>
          @endforelse
    <hr>
    {!! $posts->render() !!}
@endsection