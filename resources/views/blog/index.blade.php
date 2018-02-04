
@extends('layouts.master')

@section('content')
   <h1>{{ config('blog.title') }}</h1>
    <h5>Page {{ $posts->currentPage() }} of {{ $posts->lastPage() }}</h5>
    <hr>

      @forelse ($posts as $post)
        <div class="media">
          @if($post->image)
             <div class="media-left">
               <a href="/blog/{{ $post->slug }}">
                  <img src="{{ asset('storage/posts/images/'.$post->image) }}"
                  class="img-media" 
                  alt="{{ $post->title }}">
                </a>
              </div>
            @endif
          <div class="media-body">
            <h4 class="media-heading">
             <a href="/blog/{{ $post->slug }}">{{ $post->title }}</a>
             <em>({{ $post->published_at->format('M jS Y g:ia') }})</em>
           </h4>
           <a href="/blog/{{ $post->slug }}">
              {{ $post->teaser }}
           </a>
          </div>
        </div>

      @empty
        <h4>No posts found.</h4>
      @endforelse

      <hr>
      
      {{-- The Pager --}}
        <ul class="pager">
            @if ($posts->currentPage() > 1)
              <li class="previous">
                <a href="{!! $posts->url($posts->currentPage() - 1) !!}">
                  <i class="fa fa-long-arrow-left fa-lg"></i>
                 Newer Post
                </a>
              </li>
            @endif
            @if ($posts->hasMorePages())
              <li class="next">
                <a href="{!! $posts->nextPageUrl() !!}">
                  Older Post
                  <i class="fa fa-long-arrow-right"></i>
                </a>
              </li>
            @endif
        </ul>
@endsection